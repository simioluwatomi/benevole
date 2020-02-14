@extends('master')

@section('content')

    <opportunity-detail-component
        :opportunity="{{ $volunteerOpportunity }}"
        :previous-url="`{{ url()->previous() }}`"
    ></opportunity-detail-component>

@endsection
