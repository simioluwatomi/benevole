@extends('master')

@push('styles')
    <style>
        .section-title {
            font-size: 2rem;
        }
    </style>
@endpush

@section('content')

    <section>

        <the-home-page-carousel></the-home-page-carousel>

    </section>

    <section class="slice slice-lg mb-5">
        <div class="mb-5 text-center">
            <h3 class="section-title">Latest Volunteer Opportunities</h3>
            <hr>
        </div>

        <div class="row pb-6">

            @foreach($opportunities as $opportunity)

                <opportunity-component
                    :opportunity="{{ $opportunity }}"
                    :category="{{ $opportunity->category }}"
                    v-bind:status="false"
                >
                </opportunity-component>

            @endforeach

        </div>

        <div class="text-center">
            <a href="{{ route('opportunity.index') }}" class="text-uppercase text-decoration-none">
                All Opportunities
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="icon icon-md align-bottom ml-1">
                    <polyline points="13 17 18 12 13 7"></polyline>
                    <polyline points="6 17 11 12 6 7"></polyline>
                </svg>
            </a>
        </div>

    </section>

    <section class="slice slice-lg mt-5">
        <div class="mb-5 text-center">
            <h3 class="section-title">Categories</h3>
            <hr>
        </div>

        <div class="row">

            @foreach($categories as $category)

                <category-component :category="{{ $category }}">
                </category-component>

            @endforeach

        </div>

    </section>


@endsection
