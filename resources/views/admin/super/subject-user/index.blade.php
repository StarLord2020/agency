@extends('admin.super.layouts.admin')

@section('table')
       <index-subject-user :teachers="{{json_encode($teachers)}}" :subject="{{json_encode($subject)}}"></index-subject-user>
@endsection
<style></style>
