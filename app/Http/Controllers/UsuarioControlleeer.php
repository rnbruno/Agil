<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ValidationException;
use App\Http\Resources\UsuarioPessoaResource;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all()->map(function($usuarios) {
            return [
                'usuario_id' => $usuarios->usuario_id,
                'pessoa_id' => $usuarios->pessoa_id,
                'usuario' => $usuarios->usuario,
                'inativo' => $usuarios->inativo,
            ];
        });
        
        // dd($usuarios);
        
        return Inertia::render('Usuario/Usuarios', [
            'usuarios' => $usuarios
        ]);
        // return Inertia::render('Usuario/Usuarios',[
        //     'usuarios'=>Usuario::all()->map(function($usuarios){
        //         return [
        //             'usuario_id'=>$usuarios->usuario_id,
        //             'nome'=>$usuarios->nome,
        //         ];
        //     })
        // ]);
    }

    public function usuario_pessoa()
    {
        $results = Usuario::getUsuarioPessoa();
        
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
    public function usuarioPessoaJson()
    {
        $results = Usuario::getUsuarioPessoa();
        
        // dd($results);
        
        // return Inertia::render('Usuario/Usuarios', [
        //     'usuarios' => $results
        // ]); 
        // return Inertia::render('Usuario/Usuarios',[
        //     'usuarios'=>Usuario::all()->map(function($usuarios){
        //         return [
        //             'usuario_id'=>$usuarios->usuario_id,
        //             'nome'=>$usuarios->nome,
        //         ];
        //     })
        // ]);
        // Transform the results using the resource
        $usuarios = UsuarioPessoaResource::collection($results);

        // Debugging the transformed data
        // dd($usuarios);

        // return Inertia::render('Usuario/Usuarios', [
        //     'usuarios' => $usuarios
        // ]);
        return Inertia::render('Usuario/Usuarios', [
            'usuarios' => UsuarioPessoaResource::collection($usuarios)
        ]);
    }

    public function desativarAtivarUsuario(Request $request): JsonResponse
    {
        // Processar a requisi��o
        // $data = $request->all();
        $data = $request->validate([
            'pessoa_id' => 'required|integer',
            'inativo' => 'required|boolean',
        ]);

       
        // // Retornar uma resposta JSON
        // return response()->json([
        //     'message' => 'Requisição AJAX processada com sucesso!',
        //     'data' => $data,
        // ]); 
        try {
            // Encontrar o usuário pelo ID
            $usuario = Pessoa::findOrFail($data['pessoa_id']);

            // Atualizar o campo pessoa_inativo com o valor recebido
            $inativo = ($data['inativo'] == 0) ? 1 : 0;
            $usuario->inativo = $inativo;
            $usuario->save();
            $mensagem = ($data['inativo'] == 1) ? 'Usuário desativado com sucesso' : 'Usuário ativado com sucesso';
            return response()->json(['message' => $mensagem]);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Erro de validação', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao desativar usuário', 'error' => $e->getMessage()], 500);
        }
        
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
