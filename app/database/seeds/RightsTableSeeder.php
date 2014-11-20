<?php

class RightsTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('rights')->delete();
        //insert some dummy records
        DB::table('rights')->insert(array(
            array('id'=>'1','code'=>'4','name'=>'read'),
            array('id'=>'2','code'=>'2','name'=>'edition'),
            array('id'=>'3','code'=>'1','name'=>'creation/suppression'),
            array('id'=>'4','code'=>'8','name'=>'owner'),
        ));
    }

}

?>