<?php

class ClassesTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('classes')->delete();
        //insert some dummy records
        DB::table('classes')->insert(array(
            array('id'=>'1','name'=>'dlm2_a','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'2','name'=>'dlm3_b','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'3','name'=>'iee3_a','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'4','name'=>'dlm3_a','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>0),
            array('id'=>'5','name'=>'dlm1_a','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>0),
            array('id'=>'6','name'=>'dlm1_b','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'7','name'=>'dlm1_c','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'8','name'=>'master_1','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>0),
            array('id'=>'9','name'=>'dlm1_w','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'10','name'=>'class_1','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'11','name'=>'class_2','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'12','name'=>'class_3','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'13','name'=>'class_4','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'14','name'=>'class_5','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'15','name'=>'class_6','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'16','name'=>'class_7','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'17','name'=>'class_8','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'18','name'=>'class_9','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'19','name'=>'class_10','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'20','name'=>'class_11','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),
            array('id'=>'21','name'=>'class_12','created_at'=>'2014-12-11 13:19:46','updated_at'=>'2014-12-11 13:19:46','domain'=>'Informatique','degree'=>'3 dlm-b','scollaryear'=>'2014-2015','id_school'=>'1','visibility'=>1),

        ));
    }

}

?>