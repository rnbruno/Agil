<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Type_user extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
    ];

    protected $hidden = [
        'id',
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'type_user'); // Verifique se 'user_type_id' é o nome correto da chave estrangeira
    }

    public function getTipo($id){
        $query = DB::table('type_users')
        ->where('id', $id)
        ->first(); 
        return $query;
    }
}
