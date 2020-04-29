@extends('admin.super.layouts.admin')
@section('form')
    <create-grade :classrooms-and-teachers="{{json_encode($dataFromSelect)}}"></create-grade>
@endsection
<style></style>

