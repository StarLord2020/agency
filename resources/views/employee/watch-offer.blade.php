@extends('employee.layouts.employee')

@section('content')
    <watch-offer :offer = "{{json_encode($offer)}}"></watch-offer>
@endsection

<style></style>
