@extends('admin.super.layouts.admin')

@section('table')
        <index-classroom :classrooms="{{json_encode($classrooms)}}"></index-classroom>
@endsection
<style></style>

