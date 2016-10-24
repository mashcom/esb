@extends('layouts.main')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
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



					<form class="form-horizontal" role="form" method="POST" action="{{ url('/users') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">


						<div class="form-group">
							<label class="col-md-4 control-label">Employee ID</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="employee_id" value="{{ old('employee_id') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Department</label>
							<div class="col-md-6">
								<select class="form-control" name="department">
									@foreach($departments as $department)
										<option value={{$department->id}}>{{$department->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">User Role</label>
							<div class="col-md-6">
								<select class="form-control" name="is_admin">

										<option value=0>Employee</option>
										<option value=1>SHE Officer</option>
										<option value=2>Administrator</option>
									
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
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
