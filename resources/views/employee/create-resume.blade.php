@extends('employee.layouts.employee')

@section('content')
    <create-resume :specialty="{{json_encode($specialty)}}"></create-resume>
@endsection

<style></style>
