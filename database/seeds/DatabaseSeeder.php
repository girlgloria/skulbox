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
        \App\User::create([
            'name' => 'SuperAdmin',
            'phone_no' => '0722000000',
            'user_type' => config('studentbox.user_type.admin'),
            'email' => 'admin@skulbox.co.ke',
            'password' => bcrypt('secret')
        ]);
    }
}
