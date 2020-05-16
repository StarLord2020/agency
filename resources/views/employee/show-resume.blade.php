@extends('employee.layouts.employee')

@section('content')
    <employee-resume :resumes="{{json_encode($resumes)}}" :offers = "{{json_encode($offers)}}"></employee-resume>
@endsection

<style></style>
