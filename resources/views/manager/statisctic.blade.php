@extends('manager.layouts.manager')

@section('content')
    <statistic :top-specialty-bids="{{json_encode($topSpecialtyBids)}}" :top-specialty-resumes="{{json_encode($topSpecialtiesResumes)}}"></statistic>
@endsection
<style></style>
