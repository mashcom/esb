@extends('layouts.main')

@section('content')


  <div class="col-lg-12">
    <h1 class="text-bold text-center text-primary">Report</h1>
  </div>

  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-filter"></i> Filter</h3>
      </div>
      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <strong>Whoops!</strong> There were some problems with your input. No filter was used<br><br>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="panel-body">
        <form class="form" action="{{url('reports/custom/filter')}}" method="post">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group col-lg-2">
            <label>Department</label>
            <select type="text" class="form-control" name="department_id">
                <option value="all">All Departments</option>
              @foreach ($departments as $dept)
                <option value="{{$dept->id}}">{{$dept->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-lg-2">
            <label>Section/Team</label>
            <select type="text" class="form-control" name="team_id">
                <option value="all">All Teams</option>
              @foreach ($teams as $t)
                <option value="{{$t->id}}">{{$t->name}}</option>
              @endforeach
            </select>
          </div>


          <div class="form-group col-lg-2">
            <label>From</label>
            <input type="date" class="form-control" name="from_date" value="">
          </div>

          <div class="form-group col-lg-2">
            <label>To</label>
            <input type="date" class="form-control" name="to_date" value="">
          </div>

          <div class="form-group col-lg-2 pull-right">
            <label></label>
            <input type="submit" name="show_all" value="Apply Filter" class="btn btn-primary  pull-right">

          </div>

          </form>
      </div>

      @if(isset($filter))
      <div class="panel-footer">
          Filter: <i>
            <i class="fa fa-building-o"></i> Department: <b>{{$filter['dept']}}</b>
            <i class="fa fa-users"></i> Team: <b>{{$filter['team']}}</b>
            <i class="fa fa-calendar"></i> Between <b>{{$filter['from_date']}}</b>
            and <b>{{$filter['to_date']}}</b>
          </i>
      </div>
      @endif

    </div>
  </div>

  @if($submissions->count()!=0)
  <div class=" col-lg-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Submission Chart</h3>
      </div>
      <div class="panel-body"  id="chart-box" >


      </div>
    </div>
  </div>
  <div class=" col-lg-4">

    <div class="row">
    <div class="col-sm-6 col-lg-6">
     <div class="panel panel-default">
       <div class="panel-heading">
         <h3 class="panel-title text-center">All Submissions</h3>
       </div>
       <div class="panel-body">
         <h1 class="text-center"> {{count($submissions)}}</h1>

       </div>
     </div>
    </div>
    <div class="col-sm-6 col-lg-6">
     <div class="panel panel-default">
       <div class="panel-heading">
         <h3 class="panel-title text-center">Pending</h3>
       </div>
       <div class="panel-body">
         <h1 class="text-center"> {{$submissions->where('status','pending')->count()}}</h1>
         <input type="hidden" id="pending-count" value="{{$submissions->where('status','pending')->count()}}">
       </div>
     </div>
    </div>
    <div class="col-sm-12 col-lg-12">
     <div class="panel panel-success">
       <div class="panel-heading">
         <h3 class="panel-title text-center">Approved</h3>
       </div>
       <div class="panel-body">
         <h1 class="text-center"> {{$submissions->where('status','approved')->count()}}</h1>
         <input type="hidden" id="approved-count" value="{{$submissions->where('status','approved')->count()}}">


       </div>
     </div>
    </div><!-- /.col-sm-4 -->

    <div class="col-sm-12 col-lg-12">
     <div class="panel panel-danger">
       <div class="panel-heading">
         <h3 class="panel-title text-center">Disapproved</h3>
       </div>
       <div class="panel-body">
         <h1 class="text-center"> {{$submissions->where('status','disapproved')->count()}}</h1>
         <input type="hidden" id="disapproved-count" value="{{$submissions->where('status','disapproved')->count()}}">

       </div>
     </div>
    </div><!-- /.col-sm-4 -->


    </div>

  </div>

<div class="col-lg-12">

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Submissions</h3>
    </div>
    <div class="panel-body">

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
              <a href="/submissions/{{$submission->id}}" class="btn btn-default btn-xs">View</a>
            </td>
          </tr>

          @endforeach


        </tbody>
      </table>

    </div>
  </div>
</div>
  @else
  <center>
    <img src="{{url('/filled_filter-144.png')}}" alt="" />
    <h4>No records found.</h4>
  </center>
  @endif


  <script type="text/javascript" src="{{ asset('/js/jQuery-2.1.4.min.js') }}"></script>
  <script type="text/javascript">
  $(function () {

  var approved = $("#approved-count").val();
  var disapproved = $("#disapproved-count").val();
  var pending = $("#pending-count").val();

  c = [
      ["Approved", parseInt(approved)],
      ["Disapproved", parseInt(disapproved)],
      ["Pending",parseInt(pending)]
    ];

  console.log(c);

  $("#chart-box").highcharts({
      chart: {
          type: "pie",
          options2d: {
              enabled: true,
              alpha: 45,
              beta: 0,
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: true
          }
      },
      title: {text: ""},
      tooltip: {pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>"},
      plotOptions: {
          pie: {
              allowPointSelect: true,
              cursor: "pointer",
              depth: 35,
              dataLabels: {enabled: true, format: "{point.name}"},
              showInLegend: true
          }
      },

      exporting: {enabled: false},
      series: [{type: "pie", name: "Submissions", data: c}]
  })
});


  </script>
@endsection
