<?php

namespace Database\Seeders;

use App\Models\EmpresaConsorcio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaConsorcioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmpresaConsorcio::firstorCreate([
            'empresa_id'     => 1,
            'consorcio_id'   => 1
         ]);
    }
}
