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

		$submissions = Submission::with('user')
		->whereBetween('date',[$request->from_date,$request->to_date])
		->where('department_id',$request->department_id)
		->where('section_id',$request->team_id)
		->get();

		return view('reports.index',['submissions'=>$submissions,'departments'=>$departments,'teams'=>$teams]);


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
