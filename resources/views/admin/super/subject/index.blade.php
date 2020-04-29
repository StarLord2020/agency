@extends('admin.super.layouts.admin')

@section('table')
        <index-subject :subjects="{{json_encode($subjects)}}"></index-subject>
@endsection
<style></style>
