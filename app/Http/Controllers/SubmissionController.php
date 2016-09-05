<?php namespace App\Http\Controllers;

use Storage;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SubmissionBehaviour;

use Illuminate\Http\Request;

Use Carbon\Carbon;

use App\User;
use App\Submission;
use App\Team;
use App\Department;
use App\Behaviour;

define('VALUES_FILE','values.txt');

class SubmissionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
			$submissions = Submission::with('user')->get();
			return view('submissions',['submissions'=>$submissions]);
	}


	public function search(Request $request){

		$query = $request->query;
		
		$submissions = Submission::with('user')
		->where('task','like',$query)
		->orWhere('observation','like',$query)
		->orWhere('comment','like',$query)
		->get();

		return view('submissions',['submissions'=>$submissions]);
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$departments = Department::all();
		$teams = Team::all();
		$behaviours = Behaviour::all();
		$values = explode(',',Storage::get(VALUES_FILE));

		$init_data = ['departments'=>$departments,'teams'=>$teams,"behaviours"=>$behaviours,"values"=>$values];
		return view('submissions/create',$init_data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//take the values and process them
		$values ="";
		for($i=0;$i<=20;$i++){
			if(isset($request["values_$i"])){
				$comma = ",";
				if(empty($values)){
					$comma = "";
				}
				$values .= $comma.$request["values_$i"];
			}
		}

		$this->validate($request, [
        'department_id' => 'required',
        'section_id' => 'required',
				'date' => 'required|date|before:tomorrow',
				'start_time' => 'required',
				'end_time' => 'required',
				'observation' => 'required',
				'comment' => 'required',
				'task' => 'required',
    ]);

		$Sub = new Submission();
		$Sub->user_id = Auth::user()->id;
		$Sub->department_id = $request->department_id;
		$Sub->section_id = $request->section_id;
		$Sub->date = $request->date;
		$Sub->time = $request->start_time;
		$Sub->end_time = $request->end_time;
		$Sub->values = $request->values;
		$Sub->task = $request->task;
		$Sub->observation = $request->observation;
		$Sub->comment = $request->comment;
		$Sub->values = $values;
		$Sub->duration = $request->end_time;

		if($Sub->save()){

			$u = User::find(Auth::user()->id);
			$u->last_submission = \Carbon\Carbon::now();
			$u->save();

			//save the behaviours
			for($i=1;$i<=13;$i++){
				$behaviour = $request["behaviour_$i"];
				if(!empty($behaviour)){
					$SubmissionBehaviour = new SubmissionBehaviour();
					$SubmissionBehaviour->submission_id = $Sub->id;
					$SubmissionBehaviour->behaviour_id = $i;
					$SubmissionBehaviour->is_safe = $behaviour;
					$SubmissionBehaviour->save();
				}
			}
			return redirect('submissions/'.$Sub->id);
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

		$submission = Submission::with('user','sub_dept','sub_section','user.dept','behaviours','behaviours.behaviour')->find($id);

		if($submission->user->is_admin !=1 && $submission->user_id !=Auth::user()->id){
			redirect('/unathorised');
		}
		return view('view_sub',['submission'=>$submission]);
	}

	public function approval($action,$id){
		$submission = Submission::find($id);
		$submission->status = $action;

		if($submission->save()){
			return back()->with('approval_success');
		}
		return back()->with('approval_failed');
	}

	public function employeeSubs($user_id){

		$submissions = Submission::where('user_id',$user_id)->orderBy('created_at','DESC')->get();
		$count_approved = Submission::where('user_id',$user_id)->where('status','approved')->count();
		$count_disapproved = Submission::where('user_id',$user_id)->where('status','disapproved')->count();
		$count_pending = Submission::where('user_id',$user_id)->where('status','pending')->count();
		$user_info = User::find($user_id);

		if($user_info->last_submission ==NULL){
				$last_submission = "Not Available";
		}else{
			$last_submission = static::makeAgo(static::convertDatetime($user_info->last_submission));
		}

		if($submissions->count()==0){
			return redirect('/get/started');
		}

		return view('submissions/employee_subs',
		[
			'submissions'=>$submissions,
			'user_info'=>$user_info,
			'count_approved'=>$count_approved,
			'count_disapproved'=>$count_disapproved,
			'count_pending'=>$count_pending,
			'last_submission'=>$last_submission
		]);
	}

	public static function convertDatetime($str) {
			list($date, $time) = explode(' ', $str);
			list($year, $month, $day) = explode('-', $date);
			list($hour, $minute, $second) = explode(':', $time);
			$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
			return $timestamp;
	}

	public static function makeAgo($timestamp) {
			return \Carbon\Carbon::createFromTimestampUTC($timestamp)->diffForHumans();
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
