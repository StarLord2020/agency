@extends('employer.layouts.employer')

@section('content')
    <bid-offer-list :bid-offers="{{json_encode($bidOffers)}}" ></bid-offer-list>
@endsection

<style></style>
