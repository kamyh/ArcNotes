<?php

class CoursesTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('courses')->delete();
        //insert some dummy records
        DB::table('courses')->insert(array(
            array('id'=>'1','name'=>'WebGl','matter'=>'Infographie'),
            array('id'=>'2','name'=>'DevWeb','matter'=>'developpement systeme'),
            array('id'=>'3','name'=>'DevMobile','matter'=>'developpement systeme'),
            array('id'=>'4','name'=>'Traitement d\'image','matter'=>'Infographie'),
            array('id'=>'5','name'=>'Traitement d\'image','matter'=>'Infographie'),
        ));
    }

}

?>