<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('permissions')->delete();
        //insert some dummy records
        DB::table('permissions')->insert(array(
            array('id_user'=>'1','id_rights'=>'0','id_class'=>'2'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'1'),
            //array('id_user'=>'2','id_rights'=>'5','id_class'=>'2'),
            //array('id_user'=>'3','id_rights'=>'0','id_class'=>'2'),
            //array('id_user'=>'1','id_rights'=>'15','id_class'=>'2'),
            //array('id_user'=>'1','id_rights'=>'5','id_class'=>'3'),
            //array('id_user'=>'1','id_rights'=>'7','id_class'=>'4'),
        ));
    }

}

?>