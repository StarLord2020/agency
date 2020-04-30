@extends('manager.layouts.manager')

@section('content')
    <manager-index-bids :bids="{{json_encode($myBids)}}"></manager-index-bids>
    @endsection
<style></style>
