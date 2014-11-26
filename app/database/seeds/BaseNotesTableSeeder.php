<?php

class BaseNotesTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('basenotes')->delete();
        //insert some dummy records
        DB::table('basenotes')->insert(array(
            array('id'=>'1','id_author'=>'1','id_cours'=>'1'),
            array('id'=>'2','id_author'=>'1','id_cours'=>'1'),
            array('id'=>'3','id_author'=>'1','id_cours'=>'1'),
            array('id'=>'4','id_author'=>'1','id_cours'=>'1'),
            array('id'=>'5','id_author'=>'1','id_cours'=>'1'),
        ));
    }

}

?>