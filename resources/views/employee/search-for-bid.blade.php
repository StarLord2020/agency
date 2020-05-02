@extends('employee.layouts.employee')

@section('content')
    <search-for-bid :bids="{{json_encode($myBids)}}" :specialty="{{json_encode($specialty)}}"></search-for-bid>
    @endsection

<style></style>
