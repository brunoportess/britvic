<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datetime = Carbon::now();
        DB::table('usuarios')->insert([
            ['nome' => 'Bruno Assis', 'cpf' => '985.658.998-98', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['nome' => 'Julia Alves', 'cpf' => '415.523.698-99', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['nome' => 'Marina Souza', 'cpf' => '587.965.125-99', 'created_at' => $datetime, 'updated_at' => $datetime]
        ]);
    }
}
