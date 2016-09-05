@extends('layouts.main')

@section('content')
<div class="col-lg-8 col-lg-offset-2">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><a href="{{url('notifications')}}" class="btn btn-default btn-md">Back</a> ReadNotification</h3>

                </div><!-- /.panel-header -->
                <div class="panel-body no-padding">
                  <div class="mailbox-read-info">
                    <h4>Subject: {{$notification->subject}}</h4>
                    <h5>From:
                      @if($notification->sender_id==0)
                      System Notification
                    @else
                    {{$notification->sender->name}}  (MINE #: {{$notification->sender->employee_id}})

                    @endif
                      <span class="mailbox-read-time pull-right">{{$notification->created_at}}</span>
                    </h5>
                  </div><!-- /.mailbox-read-info -->

                  <div class="mailbox-read-message">
                    <p>Hello {{Auth::user()->name}}</p>
                    {{$notification->message}}
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->


              </div><!-- /. box -->
            </div>
@endsection
