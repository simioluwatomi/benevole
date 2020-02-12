@extends('master')

@section('content')

    <div class="container">

        <div class="page-header d-flex flex-row justify-content-between">
            <h1 class="page-title">
                All Volunteer Opportunities
            </h1>

        </div>

        <hr>

        <div class="row">

            @each('components.opportunity', $opportunities, 'opportunity')

        </div>

        <div class="float-right my-5">

            {{ $opportunities->links() }}

        </div>

    </div>

@endsection
