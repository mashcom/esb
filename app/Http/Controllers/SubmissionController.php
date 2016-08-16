<?php namespace App\Http\Controllers;

use Storage;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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

		if($Sub->save()){

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
		$last_submission = $submissions->first();

		return view('submissions/employee_subs',
		[
			'submissions'=>$submissions,
			'user_info'=>$user_info,
			'count_approved'=>$count_approved,
			'count_disapproved'=>$count_disapproved,
			'count_pending'=>$count_pending,
			'last_submission'=>static::makeAgo(static::convertDatetime($last_submission->created_at)),
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
