@extends('employee.layouts.employee')

@section('content')
    <send-resume :resumes="{{json_encode($resumes)}}" :bid="{{json_encode($bid_id)}}"></send-resume>
@endsection

<style></style>

