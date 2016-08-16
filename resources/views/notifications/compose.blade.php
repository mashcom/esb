@extends('layouts.main')

@section('content')
<form class="" action="{{url('/notifications')}}" method="post">
<div class="col-md-8 col-lg-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Compose New Message</h3>
              </div><!-- /.panel-header -->
              <div class="panel-body">
                @if (Session::get('message'))
                  <div class="alert alert-success">
                    <strong>Success!</strong> {{Session::get('message')}}
                  </div>
                @endif

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
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                  <label for="">To:</label>
                  <select class="form-control" name="to_user">
                    @foreach($users as $u)
                      <option value="{{$u->id}}">{{$u->name}} (MINE #: {{$u->employee_id}})</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Subject:</label>
                  <input class="form-control" placeholder="Subject:" name="subject">
                </div>
                <div class="form-group">
                  <textarea rows="10" name="message" class="form-control" placeholder="Type your message here"></textarea>
                </div>

              </div><!-- /.panel-body -->
              <div class="panel-footer">

                  <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>


              </div><!-- /.panel-footer -->
            </div><!-- /. panel -->
              <br/><br/><br/><br/>
          </div>
          </form>


@endsection
