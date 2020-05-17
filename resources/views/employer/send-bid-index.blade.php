@extends('employer.layouts.employer')

@section('content')
    <send-bid-index :answers="{{json_encode($answers)}}"></send-bid-index>
@endsection

<style></style>
