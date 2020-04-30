@extends('employer.layouts.employer')

@section("content")
{{--    <index-bids :bids="{{json_encode($myBids)}}"></index-bids>--}}
    <edit-bid :bid="{{json_encode($bid)}}"></edit-bid>
@endsection

<style></style>
