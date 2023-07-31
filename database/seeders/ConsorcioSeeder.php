<?php

namespace Database\Seeders;

use App\Models\Consorcio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsorcioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Consorcio::firstorCreate([
            'ruc' => '12345678901',
            'razonsocial' => 'OCORURO',
            'cuentacorriente' => 'CUENTA-001',
            'obra_id' => 1,
            'monto' => 1000.00,
            'created_at' => now(),
            'updated_at' => now(),            
        ]);
    }
}
