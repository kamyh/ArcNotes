<?php

class AssocClassCourseTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('assocclasscourse')->delete();
        //insert some dummy records
        DB::table('assocclasscourse')->insert(array(
            array('id_course'=>'1','id_class'=>'1'),
            array('id_course'=>'2','id_class'=>'3'),
            array('id_course'=>'3','id_class'=>'2'),
            array('id_course'=>'4','id_class'=>'1'),
            array('id_course'=>'5','id_class'=>'4'),
        ));
    }

}

?>