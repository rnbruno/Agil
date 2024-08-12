<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Balance;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const STATUS_PENDING = 'pendente';
    const STATUS_COMPLETED = 'completada';
    const STATUS_CANCELED = 'cancelada';

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate([
            'email' => 'required|email',
            'id_int' => 'required|integer',
            'valor' => 'required|integer',
        ]);

        $userIds = User::getUserForEmail($validated['email']);

        // dd($userIds); 

        if (!$userIds) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não existe este usuário',
            ]);
        }

        // dd("aqui",session()->getId());        dd("aqui",session()->getId());

        $contas = Transfer::transferir_cash($validated, $userIds);
        // dd($cartoes); // Verifique se os dados estão corretos
        if ($contas) {
            $verificarSaldo = Balance::saldo($contas, $validated);
            $mensagem = $verificarSaldo->saldo_status;
            $status = $verificarSaldo->status;
            if (!$status) {
                // $transfer1 = Transfer::find($contas->id);
                $updated = Transfer::where('id', $contas->id)
                    ->update([
                        'status' => self::STATUS_CANCELED,
                        'updated_at' => NOW(),
                        'mensagem' => $mensagem
                    ]);

                return response()->json([
                    'status' => $status,
                    'message' => $mensagem,
                ]);
            }

            $add = Balance::adicionar($validated, $userIds);

            if($add){
                $updated = Transfer::where('id', $contas->id)
                ->update([
                    'status' => self::STATUS_COMPLETED,
                    'updated_at' => NOW(),
                    'mensagem' => 'Transferido'
                ]);
            }
            
        }

        return response()->json($add);
    }

    /**
     * Display the specified resource.
     */
    public function show($fromAccountId)
    {
        $transfer = Transfer::getTransfersUsers($fromAccountId);
        if ($transfer) {
            return response()->json($transfer);
        } else {
            return response()->json(['error' => 'Transfer not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
}
