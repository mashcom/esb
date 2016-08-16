<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model {


	public function user(){
		return $this->hasOne('App\User','id','user_id');
	}

	public function sub_dept()
	{
		return $this->hasOne('App\Department','id','department_id');
	}

	public function behaviours()
	{
		 return $this->hasMany('App\SubmissionBehaviour');
	}

	public function sub_section()
	{
		return $this->hasOne('App\Team','id','section_id');
	}

}
