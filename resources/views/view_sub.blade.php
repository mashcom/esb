@extends('layouts.main')
@section('content')



  <div class="col-lg-12">
    <h2 class="text-center">Observation Pact Submission</h2>

  </br>
  </div>
  <div class="col-lg-3 col-sm-3 placeholder text-center">

    <center>
              <img class="img-circle" src="http://localhost/AdminLTE-2.3.0/dist/img/user2-160x160.jpg" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>{{$submission->user->name}}</h4>
              <h5 class="text-muted">{{$submission->user->employee_id}}</h5>
              <h5 class="text-muted">Dept: {{$submission->user->dept->name}}</h5>
    </center>
  </div>


  <div class="col-md-9">

    <div class="col-lg-12 margin">

      <div class="panel">

            <div class="panel-body">
             <h4 class="pull-right">
               @if($submission->status =="approved")
                 <span class="label label-success text-uppercase"><i class="fa fa-tick"></i>
               @elseif($submission->status =="disapproved")
                 <span class="label label-danger text-uppercase"><i class="fa fa-times"></i>
               @else
                 <span class="label label-default text-uppercase"><i class="fa fa-refresh"></i>
               @endif
            {{$submission->status}}</span></h4>
            </div>
          </div>
    </div>

    <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-map-marker"></i> Where it was seen.</h3>
            </div>
            <div class="panel-body">

              <h5>Department: {{$submission->sub_dept->name}}</h5>
              <h5>Section/Team: {{$submission->sub_section->name}}</h5>
              <h5>.</h5>
            </div>
          </div>
        </div>

          <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-clock-o"></i> Observation Timing</h3>
            </div>
            <div class="panel-body">
              <h5>Date: {{$submission->date}}</h5>
              <h5>Time: {{$submission->time}}</h5>
              <h5>Duration: {{$submission->duration}}</h5>
            </div>
          </div>
        </div>


        <div class="col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-leaf"></i> Values</h3>
            </div>
            <div class="panel-body">
              <h4>
                @foreach(explode(',',$submission->values) as $value)
                  <span class="label label-primary">{{$value}}</span>
                @endforeach
              </h4>
            </div>
          </div>
        </div>

        <div class="col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-eye"></i> Observation</h3>
            </div>
            <div class="panel-body">
              {{$submission->observation}}
            </div>
          </div>
        </div>

        <div class="col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-comment-o"></i> Comment</h3>
            </div>
            <div class="panel-body">
              {{$submission->comment}}
            </div>
          </div>
        </div>


        <div class="col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-briefcase"></i> Task being carried out</h3>
            </div>
            <div class="panel-body">
              {{$submission->task}}
            </div>
          </div>
        </div>

        <div class="col-sm-12">

                 <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="col-lg-5">Observable behaviours</th>
                <th class="col-lg-1">Safe/Unsafe</th>
                <th class="col-lg-6">Observation/Comment</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($submission->behaviours as $behaviours)
                <tr>
                  <td>{{$behaviours->behaviour->description}}</td>
                  <td>
                    <h5>
                      @if($behaviours->is_safe =="unsafe")
                        <span class="label label-danger text-uppercase">
                      @elseif($behaviours->is_safe =="safe")
                        <span class="label label-success text-uppercase">
                      @else
                        <span class="label label-primary text-uppercase">
                      @endif
                      {{($behaviours->is_safe)}}</span>
                    </h5>
                  </td>
                  <td>{{$behaviours->comment}}</td>
                </tr>

              @endforeach

            </tbody>
          </table>
        </div>

  </div>
@endsection
