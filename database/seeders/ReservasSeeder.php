<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservasSeeder extends Seeder
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
            ['veiculo_id' => 1, 'usuario_id' => 1, 'data_inicio' => '2021-01-20', 'data_fim' => '2021-01-23', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['veiculo_id' => 2, 'usuario_id' => 1, 'data_inicio' => '2021-01-25', 'data_fim' => '2021-01-29', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['veiculo_id' => 3, 'usuario_id' => 2, 'data_inicio' => '2021-01-20', 'data_fim' => '2021-01-23', 'created_at' => $datetime, 'updated_at' => $datetime]
        ]);
    }
}
