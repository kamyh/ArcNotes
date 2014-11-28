<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('CantonsTableSeeder');
        $this->call('CitiesTableSeeder');
        $this->call('SchoolsTableSeeder');
        $this->call('ClassesTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('RightsTableSeeder');
        $this->call('CoursesTableSeeder');
        $this->call('BaseNotesTableSeeder');
        $this->call('ManuscritTableSeeder');
	}

}
