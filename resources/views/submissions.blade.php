@extends('layouts.main')
@section('content')

 <div class="col-md-12">
            <h2>Submitted Forms</h2>

            <div class="input-group margin col-lg-6">
                    <input type="text" class="form-control" placeholder="Search here!">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="button">Search</button>
                    </span>
            </div>
          </br>
          <table class="table table-striped table table-bordered">
            <thead>
              <tr>
                <th style="width:15%">Employee #</th>
                <th>Fullname</th>
                <th>Submitted</th>
                <th>Status</th>
                <th>Task</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($submissions as $submission)
              <tr>
                <td><a href="submissions/user/{{$submission->user->id}}" title="view employee profile">{{$submission->user->employee_id}}</a></td>
                <td>{{$submission->user->name}}</td>
                <td>{{$submission->created_at}}</td>
                <td><span class="label label-success">{{$submission->status}}</span></td>
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
                        <li><a href="#" class="text-success"><i class="fa fa-tick"></i> Approve</a></li>
                        <li><a href="#" class="text-danger">Disapprove</a></li>
                      </ul>

                    </div></td>
              </tr>

              @endforeach


            </tbody>
          </table>
        </div>
@endsection
