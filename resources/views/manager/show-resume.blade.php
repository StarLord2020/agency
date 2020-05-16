@extends('manager.layouts.manager')

@section('content')
    <show-resume :resume="{{json_encode($resume)}}"></show-resume>
@endsection
<style></style>
