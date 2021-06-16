<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function mostrar_vista_usuarios(){
        return view('modulos.gestion_usuarios.listar_usuarios');
    }

    public function index()
    {
        $usuarios = User::select('usuarios.*', 'roles.nombre')
        ->join('roles', 'roles.id_rol', '=', 'usuarios.id_rol')
        ->get();

        return Datatables::of($usuarios)
            ->editColumn('Estado', function($usuario){
                return $usuario->estado == 1 ? 'Activo' : 'Inactivo';
            })
            ->addColumn('Opciones', function ($usuario) {
                return '<a href="/usuarios/actualizar/'.$usuario->id_usuario.'" class="btn btn-sm btn-primary"><i class="la la-edit"></i> Editar</a>';
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function mostrar_vista_editar_usuarios($id){
        $usuario = User::find($id);

        if($usuario == null) return back()->withErrors('No se encontro el usuario');

        return view('modulos.gestion_usuarios.editar_usuario', compact("usuario"));
    }

    public function update(Request $request)
    {
        $request->validate(User::$rules);
        
        try {
            $usuario = User::find($request->id_usuario);
            if($usuario == null) return redirect('/usuarios')->withErrors('Producto no encontrado');

            $usuario->update([
                'id_rol' => $request->id_rol,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tipo_documento' => $request->tipo_documento,
                'documento' => $request->documento
            ]);

            return redirect('/usuarios');
        } catch (Exception $e) {
            return redirect('/usuarios')->withErrors($e->getMessage());
        }
    }
}
