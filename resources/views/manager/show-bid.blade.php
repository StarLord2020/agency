@extends('manager.layouts.manager')

@section('content')
    <show-bid :bid="{{json_encode($bid)}}"></show-bid>
@endsection
<style></style>
