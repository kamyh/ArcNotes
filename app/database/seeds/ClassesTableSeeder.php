<?php

class ClassesTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('classes')->delete();
        //insert some dummy records
        DB::table('classes')->insert(array(
            array('name'=>'Math_dlm2','domain'=>'Math','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1'),
            array('name'=>'Glandouille','domain'=>'Kilian','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1'),
            array('name'=>'Sport','domain'=>'Sport','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1'),
        ));
    }

}

?>