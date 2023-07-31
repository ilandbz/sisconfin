<?php

namespace Database\Seeders;

use App\Models\Uso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usos = [
            'CEMENTO',
            'MOTONIVELADORA',
            'PLANILLA',
            'PENSION',
            'CUARTOS',
            'PLANILLA',
            'EXCAVADORA',
            'MIXER',
            'CISTERNA',
            'PETROLEO',
            'PETROLEO',
            'PETROLEO',
            'CEMENTO',
            'PLANILLA',
            'CARGADOR FRONTAL',
            'RETROEXCAVADORA',
            'RETROEXCAVADORA',
            'VOLQUETE',
            'CEMENTO',
            'CEMENTO',
            'VARIOS',
            'CAMIONETA',
            'EXCAVADORA',
            'PETROLEO',
            'PLANILLA',
            'CEMENTO',
            'EPP',
            'FERRETERIA',
            'GASOLINA',
            'FERRETERIA',
            'AGREGADOS',
            'PLASTICO',
            'UTILES',
            'DEVOLUCION',
            'GASTOS VARIOS',
        ];

        foreach ($usos as $uso) {
            Uso::firstOrCreate([
                'nombre' => $uso,
            ]);
        }
    }
}
