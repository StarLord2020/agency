@extends('employer.layouts.employer')

@section('content')
<watch-resume :resume="{{json_encode($resume)}}"></watch-resume>
@endsection

<style></style>
