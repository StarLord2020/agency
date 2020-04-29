@extends('admin.teacher.layouts.teacher')
@section('nav')
    @include('admin.teacher.head-teacher.layouts.blocks.nav.index')
@endsection
@section('form')
    <div id="app">
        <create-timetable :teachers-and-subjects="{{json_encode($teachersAndThemSubjects)}}"></create-timetable>
    </div>
@endsection
<script>
    window.routes = {
        'admin.teacher.head-teacher.timetable.store' : '{{ route('admin.teacher.head-teacher.timetable.store') }}',
        'admin.super.classroom.create' : '{{ route('admin.super.classroom.create') }}',
    }
</script>
