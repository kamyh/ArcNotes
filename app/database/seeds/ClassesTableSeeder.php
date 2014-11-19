<?php

class ClassesTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('classes')->delete();
        //insert some dummy records
        DB::table('classes')->insert(array(
            array('name'=>'Math_dlm2'),
            array('name'=>'Glandouille'),
            array('name'=>'Sport'),
        ));
    }

}

?>