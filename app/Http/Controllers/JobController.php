<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Throwable;

class JobController extends Controller
{
    public function index(): View
    {
        $jobs = Job::get();
        $pagesize = env('JOBS_PER_PAGE', 10);
        return view('jobs.index', compact('jobs', 'pagesize'));
    }

    public function view($jobid): View
    {
        $job = Job::where('jobid', $jobid)->firstOrFail();

        return view('jobs.view', compact('job'));
    }

    public function import(): View
    {
        $options = Option::get(['name', 'value'])->keyBy('name')->toArray();

        return view('jobs.import', compact('options'));
    }

    public function storeImport(Request $request)
    {
        $request->validate([
            'jobs' => 'required|file|mimes:xml'
        ]);

        $jobsXml = $request->file('jobs');
        $jobsXmlString = file_get_contents($jobsXml->getRealPath());

        $this->store($jobsXmlString);

        return Redirect::route('jobs.import')->with('status', 'jobs-imported');
    }

    public function storeOptions(Request $request)
    {
        Option::upsert(
            [
                'name' => 'xml_link',
                'value' => $request->xml_link
            ],
            ['name'],
            ['value']
        );

        return Redirect::route('jobs.import')->with('status', 'options-saved');
    }

    public function cron(): void
    {
        Log::debug('Cron started');
        $xmlLink = Option::where('name', 'xml_link')->first()->value;

        if (empty($xmlLink)) {
            return;
        }

        $jobsXmlString = file_get_contents($xmlLink);
        $this->store($jobsXmlString);
    }

    private function store($jobsXmlString): void
    {
        try {
            $jobs = new \SimpleXMLElement($jobsXmlString);
        } catch (Throwable $e) {
            return;
        }

        Job::truncate();

        foreach ($jobs as $job) {
            if (empty($job->ourjobid)) continue;

            Job::create([
                'jobid' => $job->ourjobid,
                'title' => $job->jobtitle ?? null,
                'company' => $job->job_company ?? null,
                'short' => $job->job_short ?? null,
                'description' => $job->description ?? null,
            ]);
        }
    }
}
