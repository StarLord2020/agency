@extends('employee.layouts.employee')

@section('content')
    <employee-resume :resumes="{{json_encode($resumes)}}"></employee-resume>
@endsection

<style></style>
