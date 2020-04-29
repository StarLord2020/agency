@extends('student.layouts.student')

@section("content")
        <index-timetable-student :grades="{{json_encode($grades)}}"></index-timetable-student>
@endsection
<style></style>
