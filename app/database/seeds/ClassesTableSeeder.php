<?php

class ClassesTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('classes')->delete();
        //insert some dummy records
        DB::table('classes')->insert(array(
            array('id'=>'1','name'=>'dlm2_a','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'public'),
            array('id'=>'2','name'=>'dlm3_b','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'public'),
            array('id'=>'3','name'=>'iee3_a','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'public'),
            array('id'=>'4','name'=>'dlm3_a','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'private'),
            array('id'=>'5','name'=>'dlm1_a','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'private'),
            array('id'=>'6','name'=>'dlm1_b','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'public'),
            array('id'=>'7','name'=>'dlm1_c','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'public'),
            array('id'=>'8','name'=>'master_1','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>'private'),
        ));
    }

}

?>