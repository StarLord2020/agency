@extends('manager.layouts.manager')

@section('content')
    <edit-specialty :specialty="{{json_encode($specialty)}}"></edit-specialty>
@endsection
<style></style>
