@extends('admin.super.layouts.admin')

@section('form')
        <edit-subject :subject="{{json_encode($subject)}}"></edit-subject>
@endsection
<style></style>
