@extends('employee.layouts.employee')

@section('content')
    <watch-bid :bid = "{{json_encode($bid)}}"></watch-bid>
@endsection

<style></style>
