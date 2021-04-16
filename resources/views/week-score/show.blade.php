@extends('layouts.default')

@section('content')
    @livewire('week-scores', ['weekId' => $week->id])
@endsection
