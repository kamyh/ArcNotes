<?php

class SchoolsTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('schools')->delete();
        //insert some dummy records
        DB::table('schools')->insert(array(
            array('id'=>'1','id_location' => '5000','name'=>'HE-Arc'),
            array('id'=>'2','id_location' => '5086','name'=>'League School'),
            array('id'=>'3','id_location' => '5002','name'=>'Kilian Academy'),
        ));
    }

}

?>