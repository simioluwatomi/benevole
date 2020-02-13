@extends('master')

@section('content')

    <div class="container">

        <div class="page-header d-flex flex-row justify-content-between">
            <h1 class="page-title">
                Opportunity Details
            </h1>

            <div class="page-options btn-list">

                <a href="{{ url()->previous() }}" class="btn btn-danger d-none d-md-inline-block">
                    <i class="fe fe-arrow-left mr-2"></i>
                    Back
                </a>

                <a href="#" class="btn btn-primary">
                    <i class="fe fe-send mr-2"></i>
                    Apply Now
                </a>

            </div>

        </div>

        <hr>

        <div class="row">

            <div class="col-md-12">

                <div class="card">


                    <div class="card-status bg-blue"></div>

                    <div class="card-body">

                        <!-- Dropdown -->
                        <div class="dropdown float-right">
                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                <i class="fe fe-share-2"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">
                                    <i class="fe fe-facebook mr-2"></i>
                                    Facebook
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fe fe-twitter mr-2"></i>
                                    Twitter
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fe fe-linkedin mr-2"></i>
                                    LinkedIn
                                </a>
                            </div>
                        </div>

                        <h1 class="text-center pt-8 display-4">
                            {{ $volunteerOpportunity->title }}
                        </h1>

                        <div class="d-flex justify-content-around flex-wrap mb-4">

                            <h4>
                                <i class="fe fe-activity px-1 text-primary"></i>
                                {{ $volunteerOpportunity->min_hours_per_week }} - {{ $volunteerOpportunity->max_hours_per_week }} Hours/Week
                            </h4>

                            <h4>
                                <i class="fe fe-watch px-1 text-primary"></i>
                                {{ $volunteerOpportunity->duration }} Months
                            </h4>

                            <h4>
                                <i class="fe fe-clock px-1 text-primary"></i>
                                {{ $volunteerOpportunity->created_at->diffForHumans() }}
                            </h4>

                        </div>

                        <h3 class="text-center font-weight-normal">
                            {{ $volunteerOpportunity->category->title }}
                        </h3>

                        <hr>
                        <section class="p-5">
                            <h3>
                                Description
                            </h3>
                            <p class="lead leading-loose font-weight-normal">
                                {{ $volunteerOpportunity->description }}
                            </p>
                        </section>

                        <section class="p-5">
                            <h3>
                                Requirements
                            </h3>
                            <ul>
                                @foreach ($volunteerOpportunity->requirements as $requirement)
                                    <li class="lead leading-loose font-weight-normal">
                                        {{ $requirement }}
                                    </li>
                                @endforeach
                            </ul>
                        </section>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
