@extends('manager.layouts.manager')

@section('content')
    <index-specialties :specialties="{{json_encode($specialties)}}"></index-specialties>
@endsection
<style></style>
