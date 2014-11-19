<?php

class SchoolsTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('schools')->delete();
        //insert some dummy records
        DB::table('schools')->insert(array(
            array('id_location' => '3','name'=>'HE-Arc'),
            array('id_location' => '86','name'=>'League School'),
            array('id_location' => '2','name'=>'Kilian Academy'),
        ));
    }

}

?>