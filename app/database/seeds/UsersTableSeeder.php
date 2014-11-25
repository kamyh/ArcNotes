<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        //delete users table records
        DB::table('users')->delete();
        //insert some dummy records
        DB::table('users')->insert(array(
            //ALL password are "secretsecret"
            array('id'=>'1','firstname'=>'Roger','lastname'=>'Federer','email'=>'roger.federer@gmail.com','password'=>'$2y$10$StKTvkpkFyW6hsPqmFu/..1KVNwu6Gld0Bnw1yKVwtSW8QsrQoHUa'),
            array('id'=>'2','firstname'=>'Paul','lastname'=>'Rougon','email'=>'paul.rougon@gmail.com','password'=>'$2y$10$StKTvkpkFyW6hsPqmFu/..1KVNwu6Gld0Bnw1yKVwtSW8QsrQoHUa'),
            array('id'=>'3','firstname'=>'Von','lastname'=>'Newmann','email'=>'von.newmann@gmail.com','password'=>'$2y$10$StKTvkpkFyW6hsPqmFu/..1KVNwu6Gld0Bnw1yKVwtSW8QsrQoHUa'),
            array('id'=>'4','firstname'=>'Stephane','lastname'=>'Gobron','email'=>'stephane.gobron@gmail.com','password'=>'$2y$10$StKTvkpkFyW6hsPqmFu/..1KVNwu6Gld0Bnw1yKVwtSW8QsrQoHUa'),
            array('id'=>'5','firstname'=>'Julien','lastname'=>'Gazon','email'=>'julien.gazon@gmail.com','password'=>'$2y$10$StKTvkpkFyW6hsPqmFu/..1KVNwu6Gld0Bnw1yKVwtSW8QsrQoHUa'),

        ));
    }

}

?>