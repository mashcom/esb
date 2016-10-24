<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

use Illuminate\Http\Request;

use App\Submission;
use App\Department;
use App\Team;

class ReportController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$departments = Department::all();
		$teams = Team::all();
		$submissions = Submission::with('user')->get();
		return view('reports.index',['submissions'=>$submissions,'departments'=>$departments,'teams'=>$teams]);
	}

	public function filter(Request $request){

		$this->validate($request, [
				'from_date' => 'date|before:tomorrow',
				'to_date' => 'date|after:from_date'
    	]);
		$departments = Department::all();
		$teams = Team::all();

		$filter_dept = $request->department_id;
		$filter_section = $request->team_id;

		$filter_dept_name = "All";

		$dept_condition = "!=";
		if($filter_dept !="all"){
			$dept_condition = "=";
			$filter_dept_name = Department::find($filter_dept)->name;
		}

		$section_condition= "!=";
		$filter_section_name = "All";
		if($filter_section !="all"){
			$section_condition=  "=";
			$filter_section_name = Team::find($filter_section)->name;
		}

		$filter_status = $request->status;
		$status_condition = "!=";
		$filter_status_name = "All";
		if($filter_status !="all"){
			$status_condition = "=";
			$filter_status_name = ucfirst($filter_status);

		}



		if(empty($request->from_date)){
			$filter_from_label = "No date";
			$filter_to_label = "No date";
			$submissions = Submission::with('user')
			->where('department_id',$dept_condition,$request->department_id)
			->where('section_id',$section_condition,$request->team_id)
			->where('status',$status_condition,$request->status)
			->get();
		}
		else{
				$filter_from_label = $request->from_date;
				$last_date = $request->to_date;
				$filter_to_label = $last_date;
				if(empty($request->to_date)){
						$filter_to_label = "Now";
					$last_date = \Carbon\Carbon::now();
				}
				$submissions = Submission::with('user')
				->whereBetween('date',[$request->from_date,$last_date])
				->where('department_id',$dept_condition,$request->department_id)
				->where('section_id',$section_condition,$request->team_id)
				->where('status',$status_condition,$request->status)
				->get();
		}
		$filter_output = ["dept"=>$filter_dept_name,"team"=>$filter_section_name,"from_date"=>$filter_from_label,"to_date"=>$filter_to_label,"status_label"=>$filter_status_name];

		return view('reports.index',['filter'=>$filter_output,'submissions'=>$submissions,'departments'=>$departments,'teams'=>$teams]);


	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
