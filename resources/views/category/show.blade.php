@extends('master')

@section('content')

    <category-detail-component
        :category="{{ $category }}"
        :opportunities='@json($opportunities)'
        :previous-url="`{{ url()->previous() }}`"
    ></category-detail-component>

    <div class="float-right my-5">

        {{ $opportunities->links() }}

    </div>

@endsection
