@extends('layouts.main')
@section('content')


  <div class="col-lg-12">
    <h2 class="text-center">Users</h2>
    @if(Auth::user()->is_admin==2)
    <center>
          <a href="{{url('users/create')}}" class="btn btn-primary  btn-md text-bold bold">Create User Account</a>
      
        </center>
            <br/>    <br/>
    @endif
  </div>


  <div class="col-md-10 col-lg-offset-1">
       @if (Session::get('message'))
                  <div class="alert alert-success">
                    <strong>Success!</strong> {{Session::get('message')}}
                  </div>
                @endif


 @if (Session::get('error'))
                  <div class="alert alert-danger">
                    <strong>Success!</strong> {{Session::get('error')}}
                  </div>
                @endif

    
          <table class="table table-striped table table-bordered">
            <thead>
              <tr>
                <th>Employee ID</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Department</th>
                <th>Role</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td><b>{{strtoupper($user->employee_id)}}</b></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{@$user->dept->name}}</td>
                <td>
                  <?php
                    if($user->is_admin==0){
                      echo "<b class='text-success'>Employee</b>";
                    }
                    elseif($user->is_admin==1){
                      echo "<b class='text-info'>SHE Officer</b>";
                    }
                    elseif($user->is_admin==2){
                      echo "<b class='text-danger'>Administrator</b>";
                    }
                  ?>
                </td>
                <?php  
                $delete_url = "users/destroy/".$user->id ;
                $show_url = "users/".$user->id ;
                ?>
                @if(Auth::user()->is_admin ==2)
                <td>
                  <a href="<?php echo $delete_url ?>" class='btn btn-xs btn-danger'>Delete</a>
                  <a href="<?php echo $show_url ?>" class='btn btn-xs btn-default'><b>Edit</b></a>
                </td>
                @endif

                  @if(Auth::user()->is_admin==1)
                <td>
                  <a href="submissions/single/user/{{$user->id}}" class='btn btn-xs btn-default'>View Submissions</a>
                
                </td>
                @endif

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
@endsection
