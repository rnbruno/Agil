<?php

namespace App\Http\Controllers;

use App\Models\Cartao;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $results = Cartao::getCartaoTipoCartaoProduto();
        
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
        return response()->json(['data' => $results]);
        // return Inertia::render('Usuario/Cartao', [
        //     'cartoes' => $results
        // ]); 
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
    public function show(Cartao $cartao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cartao $cartao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cartao $cartao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cartao $cartao)
    {
        //
    }
}