@extends('admin.super.layouts.admin')

@section('form')
    <edit-classroom :classroom="{{json_encode($classroom)}}"></edit-classroom>
@endsection
<style></style>


