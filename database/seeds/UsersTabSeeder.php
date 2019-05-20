<?php

use Illuminate\Database\Seeder;

class UsersTabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Обмен с 1С',
            'email' => 's_user@gmail.com',
            'password' => Hash::make('s_user'),
        ]);
    }
}
