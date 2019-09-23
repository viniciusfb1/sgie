<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Carla Freitas',
                'email' => 'carla.freitas@teste.com',
                'password' => bcrypt('123456'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Pedro Silva',
                'email' => 'pedro.silva@teste.com',
                'password' => bcrypt('123456'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()

            ]
        );
    }
}
