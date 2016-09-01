@extends('layouts.main')
@section('content')


  <div class="col-lg-12">
    <h2 class="text-center">Submitted Forms</h2>
  </div>

  <div class="col-lg-3 col-sm-3 placeholder text-center">
    <center>
              <img class="img-circle"  src="../default.png"/>
                <h4>MM57EY8</h4>
              <h5 class="text-muted">Wilson Temani</h5>
              <h5 class="text-muted">Geology Dept.</h5>
    </center>
  </div>


  <div class="col-md-9">

          <table class="table table-striped table table-bordered">
            <thead>
              <tr>
                <th>Date</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>5 hours ago</td>
                 <td><span class="label label-success">Approved</span></td>
                <td>
                  <a href="" class="btn btn-default btn-xs">View</a>
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

              <tr>                <td>2 days ago</td>
                 <td><span class="label label-danger">Disapproved</span></td>
                <td>
  <a href="" class="btn btn-default btn-xs">View</a>
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

            </tbody>
          </table>
        </div>
@endsection
