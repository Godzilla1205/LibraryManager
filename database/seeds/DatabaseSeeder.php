<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
        'name'=>'truonglv',
        'email'=>'godzilla1205@Gmail.com',
        'password'=>bcrypt('matkhau')
        ]);
    }
}
