@extends('layouts.main')
@section('content')

<div class="error-page text-center">
            <div class="error-content">
            	<h1><i class="fa fa-cloud text-muted" style="font-size:5em"></i></h1>
              <h1>No submissions</h1>
              <p>
                No submisions found for this current user

              </p>
              @if(Auth::user()->is_admin==2)
              	<a href="{{url('/submissions/create/new')}}" class="btn btn-primary">New Submission</a>
              @endif	
            </div>
          </div>

@endsection
