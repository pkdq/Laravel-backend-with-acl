<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->truncate();

        DB::table('users')->insert([
            [
                'first_name' => 'Pranab',
                'last_name' => 'Kalita',
                'email' => 'pranab@mailinator.com',
                'password' => bcrypt('secret'),
            ],
            [
                'first_name' => 'Sima',
                'last_name' => 'Kalita',
                'email' => 'sima@mailinator.com',
                'password' => bcrypt('secret'),
            ]
        ]);
    }
}
