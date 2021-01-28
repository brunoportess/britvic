<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datetime = Carbon::now();
        DB::table('users')->insert([
            ['name' => 'Usuario 1', 'email' => 'usuario1@usuario1.com', 'password' => Hash::make('123@Teste'), 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Usuario 2', 'email' => 'usuario2@usuario2.com', 'password' => Hash::make('123@Teste'), 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Usuario 3', 'email' => 'usuario3@usuario3.com', 'password' => Hash::make('123@Teste'), 'created_at' => $datetime, 'updated_at' => $datetime]
        ]);
    }
}
