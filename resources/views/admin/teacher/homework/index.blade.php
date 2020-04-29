@extends('admin.teacher.layouts.teacher')
@section('nav')
    @include('admin.teacher.head-teacher.layouts.blocks.nav.index')
@endsection
@section('form')

    <div id="app">
       <index-homework-teacher :params="{{json_encode($initialParameters)}}" :grades="{{json_encode($grades)}}"></index-homework-teacher>
    </div>
@endsection
