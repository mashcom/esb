@extends('layouts.main')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading text-bold bold">View/Edit Record</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					 @if (Session::get('message'))
                  <div class="alert alert-success">
                    <strong>Success!</strong> {{Session::get('message')}}
                  </div>
                @endif



					<form class="form-horizontal" role="form" method="POST" action='<?php  echo "/users/update/$user->id" ?>'>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">


						<div class="form-group">
							<label class="col-md-4 control-label">Employee ID</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="employee_id" value="{{ $user->employee_id }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ $user->name }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ $user->email }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Department</label>
							<div class="col-md-6">
								<select class="form-control" name="department">
									@foreach($departments as $department)
									
										<option value={{$department->id}} <?php if($department->id == $user->department_id){ echo "selected"; } ?>>{{$department->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Access Level</label>
							<div class="col-md-6">
								<select class="form-control" name="is_admin">

										<option value=0  <?php if($user->is_admin==0){ echo "selected"; } ?> >Employee</option>
										<option value=1 <?php if($user->is_admin==1){ echo "selected"; } ?>>SHE Officer</option>
										<option value=2 <?php if($user->is_admin==2){ echo "selected"; } ?>>Administrator</option>
									
								</select>
							</div>
						</div>

						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Save Changes
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
