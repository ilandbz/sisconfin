<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['roles'] = Role::get();
        $data['title'] = 'Usuarios';
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
                'role_id'       => 'required'
            ], [
                'nombres.required'   => 'El campo nombres es obligatorio.',
                'apellidos.required' => 'El campo apellidos es obligatorio.',
                'email.required'     => 'El campo email es obligatorio.',
                'email.email'        => 'El campo email debe ser una dirección de correo válida.',
                'email.unique'       => 'El email ya está en uso.'
            ]);
            $password = Hash::make($request->name);
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
                'email.unique'       => 'El email ya está en uso.',
            ]);
            $usuario = User::where('id', $request->id)->update([
                'name'              => $request->name,
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


    public function lista(){
        $data['usuarios'] = User::with('Rol:id,nombre')->get();
        return $data;
    }

    public function perfil(){
        $data['roles'] = Role::get();
        $data['title'] = 'Perfil';
        return view('paginas.usuarios.perfil', $data);
    }

    public function cambiarclave(Request $request)
    {
        $request->validate([
            'password'              => ['required', 'string'],
            'newpassword'           => ['required', 'string'],
            'password_confirm'      => 'required|same:newpassword'
        ], [
            'password.required'         => 'El campo password es obligatorio.',
            'newpassword.required'      => 'El campo newpassword es obligatorio.',
            'password_confirm.required' => 'El campo password_confirm es obligatorio.',
            'password_confirm.same'     => 'El campo de confirmacion de password no coincide'
        ]);
        $user = Auth::user();
        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->newpassword);
            $user->save();
            return response()->json([
                'ok' => 1,
                'mensaje' => 'Clave Cambiado con Exito'
            ],200);
        } else {
            return response()->json([
                'error' => 'La contraseña actual es incorrecta.'
            ], 422);
        }
    }


    public function obtenerusuario(Request $request){
        $usuario = User::with('Rol:id,nombre')->where('id',$request->id)->first();
        return response()->json($usuario, 200);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        $usuario = User::where('id',$request->id)->first();
        $usuario->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Registro de Usuario Eliminado'
        ]);
    }
    public function resetearusuario(Request $request){
        $user = User::where('id', $request->id)->first();
        $user->password = Hash::make($user->name);

        $user->save();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Clave Reseteado con Exito'
        ],200);
    }
    public function cambiarestado(Request $request){
        $usuario = User::where('id', $request->id)->first();
        $usuario->es_activo = ($usuario->es_activo == 1) ? 0 : 1;
        $usuario->save();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Cambiado de Estado'
        ],200);
    }
}
