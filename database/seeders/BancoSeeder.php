<?php

namespace Database\Seeders;

use App\Models\Banco;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BancoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banco::firstOrCreate([
            'nombre'        => 'BCP',
        ]);
        Banco::firstOrCreate([
            'nombre'        => 'INTERBANK',
        ]);
        Banco::firstOrCreate([
            'nombre'        => 'BBVA',
        ]);
    }
}
