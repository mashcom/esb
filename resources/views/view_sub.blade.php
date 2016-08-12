@extends('layouts.main')
@section('content')

{{dd($submission->behaviours)}}
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
             <h4 class="pull-right"><span class="label label-success">{{$submission->status}}</span></h4>
            </div>
          </div>
    </div>

    <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Where it was seen.</h3>
            </div>
            <div class="panel-body">

              <h5>Department: {{$submission->sub_dept->name}}</h5>
              <h5>Section/Team: {{$submission->sub_section->name}}</h5>
            </div>
          </div>
        </div>

          <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Observation Timing</h3>
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
              <h3 class="panel-title">Values</h3>
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
              <h3 class="panel-title">Task being carried out</h3>
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
                <th class="col-lg-6">Observation</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Adherence to standard operatingprocedures and SHE standards</td>
                <td><span class="label label-success">SAFE</span></td>
                <td></td>
              </tr>

              <tr>
                <td>Demonstrating hard work within stipulated start and finish time</td>
                <td><span class="label label-danger">UNSAFE</span></td>
                <td></td>
              </tr>
              <tr>
            </tbody>
          </table>
        </div>





  </div>
@endsection
