<?php

class ClassesTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('classes')->delete();
        //insert some dummy records
        DB::table('classes')->insert(array(
            array('id'=>'1','name'=>'dlm2_a','domain'=>'Math','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'public'),
            array('id'=>'2','name'=>'dlm3_b','domain'=>'Kilian','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'public'),
            array('id'=>'3','name'=>'iee3_a','domain'=>'Sport','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'public'),
            array('id'=>'4','name'=>'dlm3_a','domain'=>'Infographics','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'private'),
        ));
    }

}

?>