<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Conta;
use Illuminate\Http\Request;
use App\Http\Requests\ContaRequest;
use App\Http\Resources\ContaResource;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contas = Conta::getContas();
        // dd($cartoes); // Verifique se os dados estão corretos
    
        return ContaResource::collection($contas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $contas = Conta::create($request->validated());
 
        return new ContaResource($contas);
    }

    /**
     * Display the specified resource.
     */
    public function show(Conta $conta)
    {
        return new ContaResource($conta);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conta $conta)
    {
        $conta->update($request->validated());
 
        return new ContaResource($conta);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conta $conta)
    {
        $conta->delete();
 
        return response()->noContent();
    }
}