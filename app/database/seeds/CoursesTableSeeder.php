<?php

class CoursesTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('courses')->delete();
        //insert some dummy records
        DB::table('courses')->insert(array(
            array('id'=>'1','name'=>'WebGl','matter'=>'Infographie','id_class'=>'1'),
            array('id'=>'2','name'=>'DevWeb','matter'=>'developpement systeme','id_class'=>'1'),
            array('id'=>'3','name'=>'DevMobile','matter'=>'developpement systeme','id_class'=>'2'),
            array('id'=>'4','name'=>'Traitement d\'image','matter'=>'Infographie','id_class'=>'3'),
            array('id'=>'5','name'=>'Traitement d\'image','matter'=>'Infographie','id_class'=>'4'),
        ));
    }

}

?>