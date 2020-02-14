@extends('master')

@section('content')

    <div class="container">

        <section>

            <the-home-page-carousel></the-home-page-carousel>

        </section>


        <section class="slice slice-lg mb-5">
            <div class="mb-5 text-center">
                <h3 class="display-4">Latest Volunteer Opportunities</h3>
                <hr>
            </div>

            <div class="row">

                @foreach($opportunities as $opportunity)

                    <opportunity-component
                        :opportunity="{{ $opportunity }}"
                        :category="{{ $opportunity->category }}"
                        v-bind:status="false"
                    >
                    </opportunity-component>

                @endforeach

            </div>

            <div class="text-center mt-7">
                <a href="{{ route('opportunity.index') }}" class="text-uppercase text-decoration-none">
                    All Opportunities
                    <i class="fe fe-arrow-right"></i>
                </a>
            </div>

        </section>

        <section class="slice slice-lg mt-5">
            <div class="mb-5 text-center">
                <h3 class="display-4">Categories</h3>
                <hr>
            </div>

            <div class="row">

                @foreach($categories as $category)

                    <category-component :category="{{ $category }}">
                    </category-component>

                @endforeach

            </div>

        </section>

    </div>

@endsection
