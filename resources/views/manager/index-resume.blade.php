@extends('manager.layouts.manager')

@section('content')
    <index-resumes :resumes="{{json_encode($myResumes)}}"></index-resumes>
@endsection
<style></style>
