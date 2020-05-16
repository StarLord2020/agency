@extends('employer.layouts.employer')

@section('content')
    <search-for-resumes :resumes="{{json_encode($resumes)}}" :specialty="{{json_encode($specialties)}}"></search-for-resumes>
@endsection

<style></style>
