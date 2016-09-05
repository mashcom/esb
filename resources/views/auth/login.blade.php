@extends('layouts.auth')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
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

				<form class="form-signin" role="form" method="POST" action="{{ url('/auth/login') }}">
			        
			        <input type="hidden" name="_token" value="{{ csrf_token() }}">

			       
			        <label for="inputEmail" class="sr-only">username</label>
			        <input type="text" id="inputEmail" class="form-control" name="email" placeholder="Username" autofocus="" value="{{ old('email') }}">
			        
			        <label for="inputPassword" class="sr-only">Password</label>
			        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password">
			        
			        <div class="checkbox">
			          <label>
			            <input type="checkbox" value="remember-me" name="remember"> Remember me
			          </label>
			        </div>
			        
			        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      				<a class="btn btn-lg btn-default text-bold bold btn-block" href="{{ url('/auth/register') }}">Create Account</a>
      				<a class="btn btn-link " href="{{ url('/password/email') }}"><b>Forgot Your Password?</b></a>

						
      		</form>
		</div>
	</div>
</div>

@endsection
