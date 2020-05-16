@extends('employer.layouts.employer')

@section("content")
    <index-bids :bids="{{json_encode($myBids ?? '')}}"></index-bids>
@endsection

<style></style>
