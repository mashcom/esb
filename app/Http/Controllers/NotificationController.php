<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Notification;
use App\User;
use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($folder="inbox")
	{
		$column ="user_id";
		if($folder =="sent"){
			$column = "sender_id";
		}
		$notifications = Notification::where($column,Auth::user()->id)->orderBy('created_at','DESC')->get();
		$inbox_count = $notifications->count();
		$sent_count = $notifications->count();
		return view('notifications.index',['notifications'=>$notifications,'inbox_count'=>$inbox_count,"sent_count"=>$sent_count,"folder"=>$folder]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
        'to_user' => 'required',
        'message' => 'required'
    ]);

		$notification = new Notification();
		$notification->user_id = $request->to_user;
		$notification->sender_id = Auth::user()->id;
		$notification->subject = $request->subject;
		$notification->message = $request->message;
		$notification->category= "sent";


		if($notification->save()){
			return back()->with('message','Message sent successfully');
		}
		return back()->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$notification = Notification::with("sender")->where("id",$id)->first();

		return view('notifications.show',["notification"=>$notification]);
	}


	public function compose()
	{
		$users = User::all();
		return view('notifications.compose',['users'=>$users]);
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
