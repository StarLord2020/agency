@extends('employee.layouts.employee')

@section('content')
    <edit-resume :specialty = "{{json_encode($specialty)}}" :old-resume = "{{json_encode($resume)}}"></edit-resume>
@endsection

<style></style>
