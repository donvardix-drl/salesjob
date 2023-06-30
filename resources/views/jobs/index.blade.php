<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-S2Q534C3C3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-S2Q534C3C3');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="crisp-website-id" content="{{ config('app.crisp_website_id') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/css/jobs.css', 'resources/js/app.js', 'resources/js/jobs.js'])
</head>
<body class="antialiased">
<section id="section-0" class="section-content">
    <section class="marketing_list_intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>{{ config('app.name', 'Sales Jobs Berlin.com') }}</h1>
                    <p>
                        We have <strong><span id="count_total">{{ count($jobs) }}</span> Jobs</strong> for marketing in Munich<br>
                        Just press <strong>'Apply Now'</strong> or <strong>'Not for me'</strong>
                    </p>
                    <ul class="marketing_list_links">
                        <li><a id="jobs_list" href="">All Jobs</a></li>
                        <li><a id="apply_later_list" href=""><span id="count_apply_later">0</span> Jobs in Apply Later List</a></li>
                        <li><a id="not_for_me_list" href=""><span id="count_not_for_me">0</span> Not for me list</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</section>
<section id="section-1" class="section-content">
    <section class="jobs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="job_heading_button">
                        <h2>All Jobs</h2>
                        <button type="button" id="apply_now_all_jobs" class="btn btn-dark btn-lg hidden">
                            Apply to all Jobs at once
                        </button>
                    </div>
                    <div class="jobs_list">
                        @foreach($jobs as $job)
                            <div class="job_item" data-id="{{ $job->id }}">
                                <div class="job_item_header">
                                    <div class="job_header_title">
                                        <h4>{{ $job->title }}<small class="mt-3">{{ $job->company }}</small></h4>
                                    </div>
                                    <div class="job_header_buttons">
                                        <button class="btn btn-outline-dark apply_later">Apply Later</button>
                                        <button class="btn btn-outline-dark not_for_me">Not for me</button>
                                        <button id="apply_now_single_job" class="btn btn-outline-dark apply_now hidden">Apply Now</button>
                                    </div>
                                </div>
                                <div class="job_item_content">
                                    <p>{!! $job->description !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <nav class="mt-4" aria-label="...">
                        <ul class="pagination pagination-sm" data-current="1" data-pagesize="{{ $pagesize }}" data-total="{{ count($jobs) }}"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
