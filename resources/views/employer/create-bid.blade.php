@extends('employer.layouts.employer')

@section('content')
    <create-bid  :specialities="{{json_encode($specialities)}}" :id="{{json_encode($id)}}" ></create-bid>
@endsection

<style></style>
