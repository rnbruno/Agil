<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Balance extends Model
{
    use HasFactory;

    protected $table = 'balances';

    protected $fillable = ['id', 'accound_id'];

    protected $primaryKey = 'id';

    protected $attributes = [
        'id' => 'id',
        'accound_id' => 'accound_id',

    ];

    public $incrementing = true;
    // Definindo um escopo de consulta

    public static function saldo($contas, $validated)
    {

        $usuario_from = $validated['id_int'];
        $valor = $validated['valor'];

        $saldo = DB::table('balances')
            ->Where('account_id', $usuario_from)
            ->orderBy('balances.id', 'desc')
            ->select(DB::raw("
             CASE
                WHEN IFNULL(amount, 0) < $valor THEN 'Saldo insuficiente'
                ELSE 'Saldo suficiente'
                    END as saldo_status,  
            CASE
                WHEN IFNULL(amount, 0) < $valor THEN false
                ELSE true
                    END as status
            "))
            ->first();
        // if ($saldo) {
        //     // Exibe a consulta SQL bruta e os bindings para depuração
        //     dd($saldo->toSql(), $saldo->getBindings());
        // } else {
        //     // Informe que a construção da consulta falhou
        //     dd('Erro: A consulta não foi construída corretamente.');
        // }
        return $saldo;
    }
    public static function adicionar($validated, $userIds)
    {

        $usuario_from = $validated['id_int'];
        $usuario_to = $userIds->id_int;
        $valor = $validated['valor'];

        $resposta = array();
        $resposta["status"] = false;
        $resposta["message"] = "erro";

        $lastRecord = DB::table('balances')
            ->where('account_id', $usuario_to)
            ->orderBy('id', 'desc')
            ->first();


        if ($lastRecord) {
            // Passo 2: Calcule o novo valor.
            $newAmount = $lastRecord->amount + $valor;

            // Passo 3: Atualize o registro com o novo valor.
            DB::table('balances')
                ->where('id', $lastRecord->id)
                ->update([
                    'amount' => $newAmount,
                    'updated_at' => now(), // Atualize o timestamp
                    'balance_date' => now() // Atualize o timestamp
                ]);
        } else {
            // Se não houver registros, insira um novo registro
            DB::table('balances')->insert([
                'account_id' => $usuario_to,
                'amount' => $valor,
                'created_at' => now(),
                'updated_at' => now(),
                'balance_date' => now()
            ]);
        }

        $lastRecordTo = DB::table('balances')
            ->where('account_id', $usuario_from)
            ->orderBy('id', 'desc')
            ->first();


        if ($lastRecordTo) {
            // Passo 2: Calcule o novo valor.
            $newAmount = $lastRecordTo->amount - $valor;

            // Passo 3: Atualize o registro com o novo valor.
            DB::table('balances')
                ->where('id', $lastRecordTo->id)
                ->update([
                    'amount' => $newAmount,
                    'updated_at' => now(), // Atualize o timestamp
                    'balance_date' => now()
                ]);
        } else {
            // Se não houver registros, insira um novo registro
            DB::table('balances')->insert([
                'account_id' => $usuario_to,
                'amount' => $valor,
                'created_at' => now(),
                'updated_at' => now(),
                'balance_date' => now()
            ]);
        }

        $resposta["status"] = true;
        $resposta["message"] = "Transferido com sucesso!";

        return $resposta;
    }

}
