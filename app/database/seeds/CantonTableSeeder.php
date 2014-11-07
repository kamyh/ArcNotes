<?php

class CantonsTableSeeder extends Seeder {
 
       public function run()
       {
         //delete users table records
         DB::table('cantons')->delete();
         //insert some dummy records
         DB::table('cantons')->insert(array(
            array('id'=>'1','name'=>'TG'),
			array('id'=>'2','name'=>'AG'),
			array('id'=>'3','name'=>'BE'),
			array('id'=>'4','name'=>'ZH'),
			array('id'=>'5','name'=>'SG'),
			array('id'=>'6','name'=>'VD'),
			array('id'=>'7','name'=>'TI'),
			array('id'=>'8','name'=>'LU'),
			array('id'=>'9','name'=>'SO'),
			array('id'=>'10','name'=>'BL'),
			array('id'=>'11','name'=>'VS'),
			array('id'=>'12','name'=>'FR'),
			array('id'=>'13','name'=>'GE'),
			array('id'=>'14','name'=>'JU'),
			array('id'=>'15','name'=>'ZG'),
			array('id'=>'16','name'=>'GR'),
			array('id'=>'17','name'=>'OW'),
			array('id'=>'18','name'=>'SZ'),
			array('id'=>'19','name'=>'SH'),
			array('id'=>'20','name'=>'UR'),
			array('id'=>'21','name'=>'AI'),
			array('id'=>'22','name'=>'NE'),
			array('id'=>'23','name'=>'BS'),
			array('id'=>'24','name'=>'NW'),
			array('id'=>'25','name'=>'GL'),
			array('id'=>'26','name'=>'AR'),
          ));
       }
 
}

?>