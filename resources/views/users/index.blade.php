@extends('layouts.main')
@section('content')


  <div class="col-lg-12">
    <h2 class="text-center">Users</h2>
  </div>


  <div class="col-md-10 col-lg-offset-1">

          <table class="table table-striped table table-bordered">
            <thead>
              <tr>
                <th>Employee ID</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Department</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td><a href="submissions/single/user/{{$user->id}}">{{$user->employee_id}}</a></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->dept->name}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
@endsection
