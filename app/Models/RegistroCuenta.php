<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroCuenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'obra',
        'tipo',
        'medioentrega',
        'nro_operacion',
        'nrocomprobante',
        'tiene_igv',
        'banco_id',
        'ruc_dni',
        'usuario_id',
        'monto',
        'detraccion',
        'moneda',
        'saldo',
        'uso',
        'observacion',
        'concepto',
        'fecha_hora',
        'estado',
        'origen',
    ];
    public static function obtenersaldo($obra)
    {
        $registroCuenta = RegistroCuenta::where('obra', $obra)->orderBy('id', 'desc')->first();
        if ($registroCuenta) {
            return $registroCuenta->saldo;
        }else{
            return 0;
        }
    }
}
