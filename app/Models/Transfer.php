<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Transfer extends Model
{
    use HasFactory;
    protected $table = 'transfers';

    const STATUS_PENDING = 'pendente';
    const STATUS_COMPLETED = 'completada';
    const STATUS_CANCELED = 'cancelada';
    protected $fillable = ['id', 'from_account_id', 'to_account_id'];

    protected $primaryKey = 'id';

    protected $attributes = [
        'id' => 'id',
        'from_account_id' => 'from_account_id',
        'to_account_id' => 'to_account_id',
    ];

    public $incrementing = true;
    // Definindo um escopo de consulta

    public static function transferir_cash($validated, $userTo)
    {

        $usuario_from = $validated['id_int'];
        $usuario_to = $userTo->id_int;
        $valor = $validated['valor'];

        $id = DB::table('transfers')->insert([
            'from_account_id' => $usuario_from,
            'to_account_id' =>  $usuario_to,
            'amount' => $valor,
            'status' => 'pendente',
            'created_at' => NOW(),
        ]); 

        $newTransfer = Transfer::latest()->first();

             // Retorna os dados utilizando a MarcacoesResource
        return $newTransfer;
    }
    
    public static function getTransfersUsers($fromAccountId)
    {
        $transfersIds = DB::table('transfers')
            ->leftJoin('users', 'users.id_int', '=', 'transfers.from_account_id')
            ->leftJoin('users as toUser', 'toUser.id_int', '=', 'transfers.to_account_id')
            ->Where('from_account_id', $fromAccountId)
            ->orWhere('to_account_id', $fromAccountId)
            ->orderBy('transfers.created_at', 'desc')
            ->select(
                'transfers.*', 
                'users.name as from_name',
                'toUser.name as to_name')
            ->get();
        return $transfersIds;
    }

}
