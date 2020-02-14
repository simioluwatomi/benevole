@extends('master')

@section('content')

    <div class="container">

        <div class="page-header d-flex flex-row justify-content-between">
            <h1 class="page-title">
                {{ $category->title }} Opportunities
            </h1>

            <div class="page-options btn-list">

                <a href="{{ url()->previous() }}" class="btn btn-danger d-none d-md-inline-block">
                    <i class="fe fe-arrow-left mr-2"></i>
                    Back
                </a>

            </div>

        </div>

        <hr>

        <div class="row">

            @foreach($opportunities as $opportunity)

                <opportunity-component
                    :opportunity="{{ $opportunity }}"
                    :category="{{ $category }}"
                    v-bind:header="false"
                >
                </opportunity-component>

            @endforeach

        </div>

        <div class="float-right my-5">

            {{ $opportunities->links() }}

        </div>

    </div>

@endsection
