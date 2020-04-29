@extends('student.layouts.student')

@section("content")
        <index-homework :homeworks="{{json_encode($homeworks)}}" :subject="{{json_encode($subject)}}"></index-homework>
@endsection

<style></style>
