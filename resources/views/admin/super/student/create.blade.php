@extends('admin.super.layouts.admin')

@section('form')
        <create-student :students="{{json_encode($students)}}" :grade="{{json_encode($grade)}}"></create-student>
@endsection
<style></style>
