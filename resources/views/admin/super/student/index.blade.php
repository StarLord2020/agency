
@extends('admin.super.layouts.admin')

@section('table')
        <index-student :students="{{json_encode($students)}}" :grade="{{json_encode($grade)}}"></index-student>
@endsection
<style></style>
