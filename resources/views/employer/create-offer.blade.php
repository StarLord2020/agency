@extends('employer.layouts.employer')

@section('content')
    <create-offer  :specialities="{{json_encode($specialities)}}" :resume="{{json_encode($resume_id)}}" ></create-offer>
@endsection

<style></style>
