<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type_user;

class TypeUserController extends Controller
{
    public function usuario_pessoa()
    {
        $results = Type_user::getTipo();
        
        // dd($results);
        
       
        // return Inertia::render('Usuario/Usuarios',[
        //     'usuarios'=>Usuario::all()->map(function($usuarios){
        //         return [
        //             'usuario_id'=>$usuarios->usuario_id,
        //             'nome'=>$usuarios->nome,
        //         ];
        //     })
        // ]);
        // Transform the results using the resource

        return Inertia::render('Usuario/Usuarios', [
            'usuarios' => $results
        ]); 

    }
}
