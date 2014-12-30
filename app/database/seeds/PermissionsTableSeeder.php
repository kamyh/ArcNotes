<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('permissions')->delete();
        //insert some dummy records
        DB::table('permissions')->insert(array(
            array('id_user'=>'1','id_rights'=>'1','id_class'=>'2'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'1'),
            array('id_user'=>'2','id_rights'=>'5','id_class'=>'2'),
            array('id_user'=>'3','id_rights'=>'0','id_class'=>'2'),
            array('id_user'=>'2','id_rights'=>'15','id_class'=>'2'),
            array('id_user'=>'1','id_rights'=>'5','id_class'=>'3'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'4'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'5'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'6'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'7'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'8'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'9'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'10'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'11'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'12'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'13'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'14'),
            array('id_user'=>'1','id_rights'=>'15','id_class'=>'15'),
            array('id_user'=>'4','id_rights'=>'2','id_class'=>'15'),
            array('id_user'=>'5','id_rights'=>'2','id_class'=>'15'),
            array('id_user'=>'4','id_rights'=>'2','id_class'=>'4'),
            array('id_user'=>'5','id_rights'=>'2','id_class'=>'4'),
            array('id_user'=>'4','id_rights'=>'2','id_class'=>'5'),
            array('id_user'=>'5','id_rights'=>'2','id_class'=>'5'),
            array('id_user'=>'4','id_rights'=>'2','id_class'=>'6'),
            array('id_user'=>'5','id_rights'=>'2','id_class'=>'6'),
            array('id_user'=>'4','id_rights'=>'2','id_class'=>'7'),
            array('id_user'=>'5','id_rights'=>'2','id_class'=>'7'),
            array('id_user'=>'4','id_rights'=>'2','id_class'=>'8'),
            array('id_user'=>'5','id_rights'=>'2','id_class'=>'8'),
            array('id_user'=>'4','id_rights'=>'2','id_class'=>'9'),
            array('id_user'=>'5','id_rights'=>'2','id_class'=>'9'),
            array('id_user'=>'4','id_rights'=>'2','id_class'=>'1'),
            array('id_user'=>'5','id_rights'=>'2','id_class'=>'1'),
        ));
    }

}

?>