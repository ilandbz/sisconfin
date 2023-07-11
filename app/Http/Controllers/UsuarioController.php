<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data['content'] = 'paginas.usuarios';
        // $data['scriptsfooter'] = 'paginas.scriptsusuarios';
        // $data['links'] = 'paginas.linksusuarios';
        $data['usuarios'] = User::get();
        $data['roles'] = Role::get();
        return view('paginas.usuarios.inicio', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!$request->id){
            $request->validate([
                'name'      => 'required|unique:users,name',
                'nombres'   => 'required',
                'apellidos' => 'required',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'required',
                'password_confirmation' => 'required|same:password',
                'role_id'       => 'required'
            ], [
                'nombres.required'   => 'El campo nombres es obligatorio.',
                'apellidos.required' => 'El campo apellidos es obligatorio.',
                'email.required'     => 'El campo email es obligatorio.',
                'email.email'        => 'El campo email debe ser una dirección de correo válida.',
                'email.unique'       => 'El email ya está en uso.',
                'password.required'         => 'El campo contraseña es obligatorio.',
                'password_confirmation.required' => 'El campo confirmar contraseña es obligatorio.',
                'password_confirmation.same' => 'La confirmación de contraseña no coincide con la contraseña.',

            ]);
            $password = Hash::make($request->password);
            $usuario = User::create([
                'name'              => $request->name,
                'nombres'           => $request->nombres,
                'apellidos'         => $request->apellidos,
                'password'          => $password,
                'email'             => $request->email,
                'role_id'           => $request->role_id
            ]);
            return response()->json([
                'ok' => 1,
                'mensaje' => 'Usuario Registrado satisfactoriamente'
            ],201);
        }else{
            $request->validate([
                'name'      => 'required',
                'nombres'   => 'required',
                'apellidos' => 'required',
                'email'     => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($request->id)
                ],
                'role_id'   => 'required'
            ], [
                'nombres.required'   => 'El campo nombres es obligatorio.',
                'apellidos.required' => 'El campo apellidos es obligatorio.',
                'email.required'     => 'El campo email es obligatorio.',
                'email.email'        => 'El campo email debe ser una dirección de correo válida.',
                'email.unique'       => 'El email ya está en uso.'
            ]);
            $usuario = User::where('id', $request->id)->update([
                'name'              => $request->role_id,
                'nombres'           => $request->nombres,
                'apellidos'         => $request->apellidos,
                'email'             => $request->email,
                'role_id'           => $request->role_id
            ]);
            return response()->json([
                'ok' => 1,
                'mensaje' => 'Usuario Actualizado satisfactoriamente'
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
    public function destroy(string $id)
    {
        //
    }
}
