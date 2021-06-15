<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Flash;
use App\Models\User;

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

        if($usuario == null) Flash::error("Producto no encontrado");
    }

    /*

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    } */
}
