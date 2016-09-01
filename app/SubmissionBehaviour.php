<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmissionBehaviour extends Model {

	public $timestamps = false;

	public function behaviour(){
		return $this->hasOne('App\Behaviour','id','behaviour_id');
	}

}
