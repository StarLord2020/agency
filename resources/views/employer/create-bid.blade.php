@extends('employer.layouts.employer')

@section('content')
    <create-bid :id="{{json_encode($id)}}" ></create-bid>
@endsection

<style></style>
