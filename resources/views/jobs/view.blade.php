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
    @vite(['resources/css/jobs.css', 'resources/js/app.js', 'resources/js/single-job.js'])
</head>
<body class="antialiased single-job">
<section id="section-0" class="section-content">
    <section class="marketing_list_intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>{{ config('app.name', 'Sales Jobs Berlin.com') }}</h1>
                    <p>
                        You have <strong><span id="count_total">{{ count($jobs) }}</span> Jobs</strong> in your "Apply Later List"<br />
                    </p>
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
                    <div class="jobs_list">
                        <div class="job_item single-job" data-id="{{ $job->id }}">
                            <div class="job_item_header">
                                <div class="job_header_title">
                                    <h4>{{ $job->title }}<small class="mt-3">{{ $job->company }}</small></h4>
                                </div>
                                <div class="job_header_buttons">
                                    <button class="btn btn-outline-dark apply_later">Apply Later</button>
                                    <button class="btn btn-outline-dark not_for_me">Not for me</button>
                                </div>
                            </div>
                            <div class="job_item_content">
                                <p>{!! $job->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<section id="section-2" class="section-content">
    <section class="jobs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="jobs_list">
                        @foreach($jobs as $job)
                            <div class="job_item" data-id="{{ $job->jobid }}">
                                <div class="job_item_header">
                                    <div class="job_header_title">
                                        <h4>{{ $job->title }}<small class="mt-3">{{ $job->company }}</small></h4>
                                    </div>
                                    <div class="job_header_buttons">
                                        <button class="btn btn-outline-dark apply_later">Apply Later</button>
                                        <button class="btn btn-outline-dark not_for_me">Not for me</button>
                                    </div>
                                </div>
                                <div class="job_item_content">
                                    <p>{!! $job->description !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">© 2023 Company</p>

        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About us</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Contact Us</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Sitemap</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Terms & Conditions</a></li>
        </ul>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
