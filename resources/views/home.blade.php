@extends('layouts.main')

@section('content')

Your name is {{Auth::user()->name}}

@endsection
