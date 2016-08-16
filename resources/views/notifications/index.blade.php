@extends('layouts.main')
@section('content')

	 <div class="col-md-12">
	      <h2 class="text-primary">Notifications</h2>
				<br/><br/>
</div>

<div class="row">
			<div class="col-md-3">
				<a href="{{url('notifications/compose/message')}}" class="btn btn-primary btn-block margin-bottom">Compose</a>
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Folders</h3>
					</div>
					<div class="box-body no-padding">
						<ul class="nav nav-pills nav-stacked">
							<li><a href="{{url('notifications/folder/inbox')}}"><i class="fa fa-inbox"></i> Inbox </a></li>
							<li><a href="{{url('notifications/folder/sent')}}"><i class="fa fa-envelope-o"></i> Sent </a></li>
						</ul>
					</div><!-- /.box-body -->
				</div><!-- /. box -->

			</div><!-- /.col -->
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading text-uppercase text-bold">
					{{$folder}}
					</div><!-- /.box-header -->
					<div class="panel-body no-padding">
						<div class="table-responsive mailbox-messages">
							<table class="table table-hover table-striped">
								<tbody>
									@foreach($notifications as $n)
									<tr>
										<td class="mailbox-name"><a href="/notifications/{{$n->id}}">{{$n->sender->name}}</a></td>
										<td class="mailbox-subject">{{substr($n->message,0,40)}}</td>
										<td class="mailbox-date">{{$n->created_at}}</td>
									</tr>
									@endforeach
								</tbody>
							</table><!-- /.table -->
						</div><!-- /.mail-box-messages -->
					</div><!-- /.box-body -->
				</div><!-- /. box -->
			</div><!-- /.col -->
		</div>



	 </div>



@endsection
