@extends('employee.layouts.employee')

@section('content')
    <offers-list :offers="{{json_encode($offers)}}"></offers-list>
@endsection

<style></style>
