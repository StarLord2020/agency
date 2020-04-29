@extends('admin.teacher.layouts.teacher')
@section('nav')
    @include('admin.teacher.head-teacher.layouts.blocks.nav.index')
@endsection
@section('form')

    <div id="app">
{{--        <index-homework-teacher  :grades="{{json_encode($grades)}}"></index-homework-teacher>--}}
      <edit-homework :homework="{{json_encode($homework)}}" ></edit-homework>
    </div>
@endsection

