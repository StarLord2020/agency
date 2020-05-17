@extends('manager.layouts.manager')

@section('content')
    <statistic :top-specialty-bids="{{json_encode($topSpecialtyBids)}}"></statistic>
@endsection
<style></style>
