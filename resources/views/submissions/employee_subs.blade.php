@extends('layouts.main')
@section('content')



<div class="col-lg-3 col-sm-3 placeholder text-center">
  <center>
            <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>{{$user_info->employee_id}}</h4>
            <h5 class="text-muted">{{$user_info->name}}</h5>
            <h5 class="text-muted">Dept. {{$user_info->dept->name}}</h5>
  </center>
</div>


 <div class="col-md-9">
   <h2 class="text-primary">User Submission Report</h2>
   <br/><br/><br/>
       <div class="row col-lg-12">
        <h4 class="text-bold"><i class="fa fa-clock-o"></i> Last Submissions: {{$last_submission}}</h4>
      </div>
      
        <div class="row">
       <div class="col-sm-3">
         <div class="panel panel-default">
           <div class="panel-heading">
             <h3 class="panel-title text-center">All Submissions</h3>
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
             <h3 class="panel-title text-center">Pending</h3>
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
             <h3 class="panel-title text-center">Approved</h3>
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
             <h3 class="panel-title text-center">Disapproved</h3>
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
