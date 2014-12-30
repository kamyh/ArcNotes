<?php

class ManuscritTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('manuscrits')->delete();
        //insert some dummy records
        DB::table('manuscrits')->insert(array(
            array('id'=>'1','id_basenotes'=>'1','content'=>'content content content content content content ','title'=>'Title'),
            array('id'=>'2','id_basenotes'=>'2','content'=>'content content content content content content ','title'=>'Title'),
            array('id'=>'3','id_basenotes'=>'3','content'=>'content content content content content content ','title'=>'Title'),
            array('id'=>'4','id_basenotes'=>'4','content'=>'content content content content content content ','title'=>'Title'),
            array('id'=>'5','id_basenotes'=>'5','content'=>'content content content content content content ','title'=>'Title'),
            array('id'=>'6','id_basenotes'=>'6','content'=>'content content content content content content ','title'=>'Title'),
            array('id'=>'7','id_basenotes'=>'7','content'=>'content content content content content content ','title'=>'Title'),
        ));
    }

}

?>