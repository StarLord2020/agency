@extends('employer.layouts.employer')

@section('content')
    <watch-bid-offer :bid-offer="{{json_encode($bidOffer)}}"></watch-bid-offer>
@endsection

<style></style>
