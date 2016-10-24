<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Department;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users =  User::with('section','dept')->get();
		return view('users.index',['users'=>$users]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$departments = 	Department::all();
		return view('users.create',['departments'=>$departments]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		$this->validate($request, [
        	'department' => 'required',
        	'is_admin' => 'required',
        	'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'employee_id'=>'required|min:4|max:10|unique:users,employee_id',
			'department'=>'required|integer'
    	]);

		$Users = new User();
		$Users->employee_id = $request->employee_id;
		$Users->name = $request->name;
		$Users->email = $request->email;
		$Users->department_id = $request->department;
		$Users->is_admin = $request->is_admin;
		$Users->password = bcrypt($request->password);

		if($Users->save()){
			return back()->with('message','User added successfully');
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
		$user = User::findOrFail($id);
		$departments = 	Department::all();
		return view('users.show',['user'=>$user,'departments'=>$departments]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		
		$Users = User::findOrFail($id);
		$this->validate($request, [
        	'department' => 'required',
        	'is_admin' => 'required',
        	'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users,email,'.$Users->id,
			'employee_id'=>'required|min:4|max:10|unique:users,employee_id,'.$Users->id
    	]);

		
		$Users->employee_id = $request->employee_id;
		$Users->name = $request->name;
		$Users->email = $request->email;
		$Users->department_id = $request->department;
		$Users->is_admin = $request->is_admin;

		if($Users->save()){
			return back()->with('message','User details updated successfully');
		}
		return back()->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		if($user->delete()){
			return back()->with('message','User deleted successfully');
		}
		return back()->with('error','User failed to deleted');
	}

}
