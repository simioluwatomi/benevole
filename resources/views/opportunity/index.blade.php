@extends('master')

@section('content')

    <div class="page-header d-flex flex-row justify-content-between">

        <h1 class="page-title">
            All Volunteer Opportunities
        </h1>

        <div class="page-options btn-list">

            <b-link href="{{ url()->previous() }}" class="btn btn-danger d-none d-md-inline-block">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-md mr-2"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>

                Back

            </b-link>

        </div>

    </div>

    <hr>

    <div class="row">

        @foreach($opportunities as $opportunity)

            <opportunity-component
                :opportunity="{{ $opportunity }}"
                :category="{{ $opportunity->category }}"
                v-bind:status="false"
            >
            </opportunity-component>

        @endforeach

{{--        @each('components.opportunity', $opportunities, 'opportunity')--}}

    </div>

    <div class="float-right my-5">

        {{ $opportunities->links() }}

    </div>

@endsection
