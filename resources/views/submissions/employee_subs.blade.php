@extends('layouts.main')
@section('content')

@if((Auth::user()->is_admin !=1) && (Auth::user()->id != $user_info->id) )

  You are not authorised to view this record
  {{dd()}}
@endif

<div class="col-lg-2 col-sm-2 placeholder text-center">
  <br>  <br>  <br>  <br>  <br>  <br>  <br>
  <center>
      <img class="img-circle"  src="{{url('default.png')}}" width="150px"/>
              <h4>{{$user_info->employee_id}}</h4>
            <h5 class="text-muted">{{$user_info->name}}</h5>
            <h5 class="text-muted">Dept. {{$user_info->dept->name}}</h5>
  </center>
</div>


 <div class="col-md-10">
   <h2 class="text-primary">
     @if(Auth::user()->id == $user_info->id )
     Your Submissions
     @else
      User Submission Report
     @endif

   </h2>
   <br/><br/><br/>
       <div class="row col-lg-12">
        <h4 class="text-bold"><i class="fa fa-clock-o"></i> Last Submissions: {{$last_submission}}</h4>
      </div>

        <div class="row">
       <div class="col-sm-3">
         <div class="panel panel-default">
           <div class="panel-heading">
             <h3 class="panel-title text-center"><i class="fa fa-archive"></i> All Submissions</h3>
           </div>
           <div class="panel-body">
             <h1 class="text-center"> {{count($submissions)}}</h1>
             <h4><br></h4>
           </div>
         </div>
       </div>
       <div class="col-sm-3">
         <div class="panel panel-default">
           <div class="panel-heading">
             <h3 class="panel-title text-center"><i class="fa fa-clock-o"></i> Pending</h3>
           </div>
           <div class="panel-body">
             <h1 class="text-center"> {{$count_pending}}</h1>
             <h4 class="text-center"> {{(int)(($count_pending / (count($submissions)))*100)}}%</h4>
           </div>
         </div>
       </div>
       <div class="col-sm-3">
         <div class="panel panel-success">
           <div class="panel-heading">
             <h3 class="panel-title text-center"><i class="fa fa-check-square"></i> Approved</h3>
           </div>
           <div class="panel-body">
             <h1 class="text-center"> {{$count_approved}}</h1>
             <h4 class="text-center"> {{(int)(($count_approved / (count($submissions)))*100)}}%</h4>

           </div>
         </div>
       </div><!-- /.col-sm-4 -->

       <div class="col-sm-3">
         <div class="panel panel-danger">
           <div class="panel-heading">
             <h3 class="panel-title text-center"><i class="fa fa-times"></i> Disapproved</h3>
           </div>
           <div class="panel-body">
             <h1 class="text-center"> {{$count_disapproved}}</h1>
             <h4 class="text-center"> {{(int)(($count_disapproved / (count($submissions)))*100)}}%</h4>
           </div>
         </div>
       </div><!-- /.col-sm-4 -->


      </div>
          <table class="table table-striped table table-bordered">
            <thead>
              <tr>

                <th>Task</th>
                <th>Status</th>
                <th style="width:15%">Submitted</th>
                <th style="width:15%"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($submissions as $submission)
              <tr>
                <td>{{$submission->task}}</td>
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
                <td>{{$submission->created_at}}</td>

                <td>
                  <a href="/submissions/id/{{$submission->id}}" class="btn btn-default btn-xs">View</a>
@if(Auth::user()->is_admin ==1)
                  <div class="btn-group">
                      <button type="button" class="btn btn-default btn-xs">Action</button>
                      <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>

                      <ul class="dropdown-menu" role="menu">
                        <li><a href="../../../submissions/approved/<?php echo $submission->id?>" class="text-success"><i class="fa fa-tick"></i> Approve</a></li>
                        <li><a href="../../../submissions/disapproved/<?php echo $submission->id ?>" class="text-danger">Disapprove</a></li>
                      </ul>

                    </div>
                    @endif
                  </td>
              </tr>

              @endforeach


            </tbody>
          </table>
        </div>
@endsection
