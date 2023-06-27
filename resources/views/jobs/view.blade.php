<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/css/jobs.css', 'resources/js/app.js', 'resources/js/jobs.js'])
</head>
<body class="antialiased">
<section id="section-1" class="section-content">
    <section class="jobs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="jobs_list">
                        <div class="job_item" data-id="{{ $job->id }}">
                            <div class="job_item_header">
                                <div class="job_header_title">
                                    <h4>{{ $job->title }}<small class="mt-3">{{ $job->company }}</small></h4>
                                </div>
                                <div class="job_header_buttons">
                                    <button class="btn btn-outline-dark apply_now" data-bs-toggle="modal" data-bs-target="#modal-apply-single-job">Apply Now</button>
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
<!-- Modal Apply Single Job -->
<div class="modal fade" id="modal-apply-single-job" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-apply-single-jobLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-apply-single-jobLabel">
                    Confirm Apply Single Job</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are You Sure To Apply The Job?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="modal_btn_apply_now_single_job" href="" class="btn btn-dark">Apply Now</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>