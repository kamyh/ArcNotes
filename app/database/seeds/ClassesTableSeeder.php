<?php

class ClassesTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('classes')->delete();
        //insert some dummy records
        DB::table('classes')->insert(array(
            array('id'=>'1','name'=>'Math_dlm2','domain'=>'Math','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'public'),
            array('id'=>'2','name'=>'Glandouille','domain'=>'Kilian','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'public'),
            array('id'=>'3','name'=>'Sport','domain'=>'Sport','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'public'),
            array('id'=>'4','name'=>'WebGL','domain'=>'Infographics','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'private'),
        ));
    }

}

?>