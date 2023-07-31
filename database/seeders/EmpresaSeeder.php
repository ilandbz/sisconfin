<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Empresa::firstorCreate([
           'ruc'                => '20603013540',
           'razonsocial'        => 'DICONST JAROME S.C.R.L.',  
           'celular'            => '981831601'
        ]);
    }
}
