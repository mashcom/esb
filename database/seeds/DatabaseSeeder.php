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

		$faker = \Faker\Factory::create();
		echo $faker->realText($faker->numberBetween(100,300));
		Model::unguard();
		$status = ["pending","approved","disapproved"];
for ($i=0; $i <150 ; $i++) {
/*

				DB::table('users')->insert([
						'name' => $faker->name,
						"department_id"=>rand(1,3),
						"employee_id"=>"MM".rand(1000,100000).str_random(3),
						'email' => $faker->email,
						'is_admin'=>0,
						'password' => bcrypt('password'),
						'created_at'=>\Carbon\Carbon::now(),
						'updated_at'=>\Carbon\Carbon::now()
				]);
*/

				DB::table('submissions')->insert([
		            'user_id' => rand(1,10),
		            'department_id' => rand(1,3),
		            'section_id' => rand(1,3),
					"task"=>$faker->realText($faker->numberBetween(30,70)),
					"comment"=>$faker->realText($faker->numberBetween(100,300)),
					"observation"=>$faker->realText($faker->numberBetween(100,300)),
					"duration"=>rand(1,100),
					"status"=>$status[rand(0,2)],
					"time"=>rand(9,12).":".rand(10,59),
					"date"=>Carbon::now()->subDay(rand(3,6)),
					"created_at"=>Carbon::now()->subDay(rand(3,6))
		        ]);
			}

	}
}
