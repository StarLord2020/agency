@extends('employee.layouts.employee')

@section('content')
    <employee-resume :resume="{{json_encode($resume)}}" :offers = "{{json_encode($offers)}}"></employee-resume>
@endsection

<style></style>
