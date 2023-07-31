<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\Consorcio;
use App\Models\Empresa;
use App\Models\Obra;
use App\Models\RegistroCuenta;
use App\Models\Uso;


use Illuminate\Http\Request;

class RegistroCuentaController extends Controller
{

    public function index()
    {
        $data['title'] = 'Registro de Cuentas';
        $data['consorcios'] = Consorcio::get();
        $data['empresas'] = Empresa::get();
        $data['obras'] = Obra::get();
        $data['usos'] = Uso::get();
        $data['bancos'] = Banco::get();
        $data['saldo']=RegistroCuenta::obtenersaldo('Consorcio OCORURO');
        return view('paginas.cuentas.inicio', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!$request->id){
            $request->validate([
                'obra'          => 'required',
                'tipo'          => 'required',
                'medioentrega'  => 'required',
                'tiene_igv'     => 'required|numeric',
                'usuario_id'    => 'required',
                'monto'         => 'required',
                'uso'           => 'required',
                'detraccion'    => 'numeric',
                'observacion'   => 'required',
                'concepto'      => 'required',
                'estado'        => 'required',
                'fecha_hora'    => 'required|date_format:Y-m-d H:i:s'
            ], [
                'required'      => 'El campo es obligatorio.',
                'numeric'       => 'El campo debe ser numérico.',
                'fecha_hora.date_format' => 'El campo Fecha Hora no tiene el formato Correcto'
            ]);
            if($request->tipo=='INGRESO'){
                $nuevosaldo = $request->saldo + $request->monto;
            }else{
                $nuevosaldo = $request->saldo - $request->monto;
            }
            $registrocuenta = RegistroCuenta::create([
                'obra' => $request->obra,
                'tipo' => $request->tipo,
                'medioentrega' => $request->medioentrega,
                'nro_operacion' => $request->nro_operacion,
                'nrocomprobante' => $request->nrocomprobante,
                'tiene_igv' => $request->tiene_igv,
                'banco_id' => $request->banco_id,
                'ruc_dni' => $request->ruc_dni,
                'usuario_id' => $request->usuario_id,
                'monto' => $request->monto,
                'detraccion' => $request->detraccion,
                'moneda' => $request->moneda,
                'saldo' => $nuevosaldo,
                'uso' => $request->uso,
                'observacion' => $request->observacion,
                'concepto' => $request->concepto,
                'fecha_hora' => $request->fecha_hora,
                'estado' => $request->estado,
                'origen' => $request->origen
            ]);
            return response()->json([
                'ok' => 1,
                'mensaje' => 'Registrado satisfactoriamente'
            ],201);
        }else{
            $request->validate([
                'obra'          => 'required',
                'tipo'          => 'required',
                'medioentrega'  => 'required',
                'tiene_igv'     => 'required|numeric',
                'usuario_id'    => 'required',
                'monto'         => 'required',
                'detraccion'    => 'numeric',
                'uso'           => 'required',
                'observacion'   => 'required',
                'concepto'      => 'required',
                'estado'        => 'required'
            ], [
                'required'      => 'El campo es obligatorio.',
                'numeric'       => 'El campo debe ser numérico.',
            ]);

            $registrocuenta = RegistroCuenta::where('id', $request->id)->update([
                'obra' => $request->obra,
                'tipo' => $request->tipo,
                'medioentrega' => $request->medioentrega,
                'nro_operacion' => $request->nro_operacion,
                'nrocomprobante' => $request->nrocomprobante,
                'tiene_igv' => $request->tiene_igv,
                'banco_id' => $request->banco_id,
                'ruc_dni' => $request->ruc_dni,
                'usuario_id' => $request->usuario_id,
                'monto' => $request->monto,
                'detraccion' => $request->detraccion,
                'moneda' => $request->moneda,
                'saldo' => $request->saldo,
                'uso' => $request->uso,
                'observacion' => $request->observacion,
                'concepto' => $request->concepto,
                'fecha_hora' => $request->fecha_hora,
                'estado' => $request->estado,
                'origen' => $request->origen
            ]);

            return response()->json([
                'ok' => 1,
                'mensaje' => 'Actualizado satisfactoriamente'
            ],201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $registro = RegistroCuenta::where('id',$request->id)->first();
        $registro->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Registro Eliminado'
        ]);
    }
}
