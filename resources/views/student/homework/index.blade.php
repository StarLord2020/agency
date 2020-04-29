@extends('student.layouts.student')

@section("content")
        <index-subject-student :subjects="{{json_encode($subjects)}}"></index-subject-student>
@endsection

<style></style>
