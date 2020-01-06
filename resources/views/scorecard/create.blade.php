@extends('layouts.master')

@section('title') Add ScoreCard @endsection
@section('content-body')
    <div id="page">
        <create-scorecard user="{{ Auth::user() }}" staff="{{ $staff }}" entire_staff="{{ $entire_staff }}" objectives = "{{ $objectives }}"></create-scorecard>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/scorecard/create.js') }}"></script>

@endsection