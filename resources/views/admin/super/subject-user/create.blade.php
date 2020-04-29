@extends('admin.super.layouts.admin')
@section('form')
        <create-subject-user :teachers="{{json_encode($teachers)}}" :subject="{{json_encode($subject)}}"></create-subject-user>
@endsection
<style></style>
