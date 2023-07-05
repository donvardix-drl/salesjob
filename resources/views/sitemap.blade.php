<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('jobs') }}</loc>
        <priority>1.00</priority>
    </url>
    @foreach ($jobs as $job)
        <url>
            <loc>{{ route('job.view', $job->jobid) }}</loc>
            <lastmod>{{ $job->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
