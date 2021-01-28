<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VeiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datetime = Carbon::now();
        DB::table('veiculos')->insert([
            ['marca' => 'Chevrolet', 'modelo' => 'Onix', 'ano' => '2020', 'placa' => 'HAV-9587', 'user_id' => 1, 'created_at' => $datetime, 'updated_at' => $datetime],
            ['marca' => 'Honda', 'modelo' => 'Fit', 'ano' => '2015', 'placa' => 'BAS-1458', 'user_id' => 1, 'created_at' => $datetime, 'updated_at' => $datetime],
            ['marca' => 'Ford', 'modelo' => 'Ka', 'ano' => '2019', 'placa' => 'BFD-6932', 'user_id' => 1, 'created_at' => $datetime, 'updated_at' => $datetime]
        ]);
    }
}
