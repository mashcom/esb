@extends('layouts.main')
@section('content')

 <div class="col-md-12">
            <h2>Submitted Forms</h2>
            <!--
        <form method="post" action="{{ url('submissions/list/search') }}">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="input-group margin col-lg-6">
           
                    <input type="text" class="form-control" name="query" placeholder="Search here!">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">Search</button>
                    </span>

            </div>
             </form>-->
          </br>
          <table class="table table-striped table table-bordered">
            <thead>
              <tr>
                <th style="width:10%">Employee #</th>
                <th style="width:15%">Fullname</th>
                <th style="width:15%">Submitted</th>
                <th>Status</th>
                <th>Task</th>
                <th style="width:15%"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($submissions as $submission)
              <tr>
                <td><a href="/submissions/single/user/{{$submission->user->id}}" title="view employee profile">{{$submission->user->employee_id}}</a></td>
                <td>{{$submission->user->name}}</td>
                <td>{{$submission->created_at}}</td>
                <td class="h5">
                  @if($submission->status =="approved")
                    <span class="label label-success text-uppercase"><i class="fa fa-tick"></i>
                  @elseif($submission->status =="disapproved")
                    <span class="label label-danger text-uppercase"><i class="fa fa-times"></i>
                  @else
                    <span class="label label-default text-uppercase"><i class="fa fa-refresh"></i>
                  @endif
                  {{$submission->status}}
                  </span>
                </td>
                <td>{{$submission->task}}</td>
                <td>
                  <a href="submissions/{{$submission->id}}" class="btn btn-default btn-xs">View</a>
                  <div class="btn-group">
                      <button type="button" class="btn btn-default btn-xs">Action</button>
                      <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>

                      <ul class="dropdown-menu" role="menu">
                        <li><a href="submissions/approved/{{$submission->id}}" class="text-success"><i class="fa fa-tick"></i> Approve</a></li>
                        <li><a href="submissions/disapproved/{{$submission->id}}" class="text-danger">Disapprove</a></li>
                      </ul>

                    </div></td>
              </tr>

              @endforeach


            </tbody>
          </table>
        </div>
@endsection
