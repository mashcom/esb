<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$status = ["pending","approved","disapproved"];
		$category = ["inbox","sent"];
for ($i=0; $i <150 ; $i++) {
	/*
				DB::table('notifications')->insert([
            'user_id' =>rand(1,10),
						"sender_id"=>rand(1,50),
						"message"=>str_random(100),
            'category' => $category[rand(0,1)],
        ]);

				DB::table('users')->insert([
						'name' => str_random(10),
						"department_id"=>rand(1,3),
						"employee_id"=>"MM".rand(1000,100000),
						'email' => str_random(10).'@gmail.com',
						'password' => bcrypt('PASSWORD'),
				]);

*/
				DB::table('submissions')->insert([
		            'user_id' => rand(1,10),
		            'department_id' => rand(1,3),
		            'section_id' => rand(1,3),
								"task"=>"When testing, it is common to need to insert a few records into your database before executing your test. Instead of manually specifying the value of each column when you create this test data, Laravel allows you to define a default set of attributes for each of your Eloquent models using factories. To get started, take a look at the database/factories/ModelFactory.php file in your application. Out of the box, this file ",
								"comment"=>"When testing, it is common to need to insert a few records into your database before executing your test. Instead of manually specifying the value of each column when you create this test data, Laravel allows you to define a default set of attributes for each of your Eloquent models using factories. To get started, take a look at the database/factories/ModelFactory.php file in your application. Out of the box, this file ",
								"observation"=>"When testing, it is common to need to insert a few records into your database before executing your test. Instead of manually specifying the value of each column when you create this test data, Laravel allows you to define a default set of attributes for each of your Eloquent models using factories. To get started, take a look at the database/factories/ModelFactory.php file in your application. Out of the box, this file ",
								"duration"=>rand(1,100),
								"status"=>$status[rand(0,2)],
								"time"=>rand(9,12).":".rand(10,59),
								"date"=>Carbon::now()->subDay(rand(3,6)),
								"created_at"=>Carbon::now()->subDay(rand(3,6))
		        ]);
				}

	}
}
