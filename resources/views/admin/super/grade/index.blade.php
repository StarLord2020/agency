@extends('admin.super.layouts.admin')

@section('table')
        <index-grade :grades="{{json_encode($grades)}}"></index-grade>
@endsection
<style></style>
