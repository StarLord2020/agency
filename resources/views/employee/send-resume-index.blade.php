@extends('employee.layouts.employee')

@section('content')
    <send-resume-index :resumes="{{json_encode($resumes)}}"></send-resume-index>
@endsection

<style></style>
