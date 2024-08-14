<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';

    const STATUS_CORRENT = 'corrente';
    const STATUS_POUND = 'poupanca';
    protected $fillable = ['id', 'accound_number'];

    protected $primaryKey = 'id';

    protected $attributes = [
        'id' => 'id',
        'accound_number' => 'accound_number',

    ];

    public $incrementing = true;
    // Definindo um escopo de consulta

    public static function getAccountUsers($id_int)
    {
        // dd($id_int);
        // Recuperar todas as contas
        $accounts = DB::table('accounts')
            ->join('users', 'users.id_int', '=', 'accounts.id_int')
            ->where('users.id_int', $id_int)
            ->select('accounts.*')
            ->get();

        // Contar a quantidade de contas
        $accountsCount = $accounts->count();

        // Obter o primeiro item
        $firstAccount = $accounts->first();
        
        if ($firstAccount) {
            $firstAccount->accountsCount = $accountsCount;
        }
        
        // $response = $firstAccount;
        $response = $accounts;
        return $response;
    }
}
