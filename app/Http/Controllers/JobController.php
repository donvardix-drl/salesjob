<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class JobController extends Controller
{
    public function index(): View
    {
        $count = Job::count();
        $jobs = Job::paginate(500);
        return view('jobs.index', compact('count', 'jobs'));
    }

    public function view(Job $job): View
    {
        return view('jobs.view', compact('job'));
    }

    public function import(): View
    {
        return view('jobs.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jobs' => 'required|file|mimes:xml'
        ]);

        Job::truncate();

        $jobsXml = $request->file('jobs');
        $jobsXmlString = file_get_contents($jobsXml->getRealPath());
        $jobs = new \SimpleXMLElement($jobsXmlString);

        $data = [];
        foreach ($jobs as $job) {
            $data[] = [
                'title' => $job->job_title,
                'company' => $job->job_company,
                'short' => $job->job_short,
                'description' => $job->job_description,
            ];
        }
        Job::insert($data);

        return Redirect::route('jobs.import')->with('status', 'jobs-imported');
    }
}
