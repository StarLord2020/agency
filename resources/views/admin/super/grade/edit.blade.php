@extends('admin.super.layouts.admin')

@section('form')
        <edit-grade :teachers-classrooms="{{json_encode($dataForSelect)}}" :grade="{{json_encode($grade)}}"></edit-grade>
@endsection
<style></style>
