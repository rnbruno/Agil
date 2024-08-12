<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'type_user', // Adicione o campo tipo_de_usuario
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function userType()
    {
        return $this->belongsTo(Type_user::class, 'type_user');
    }
    public static function getEmails()
    {
        $userEmails = DB::table('users')
             ->select(
                'users.email',  DB::raw("CONCAT(users.name, ' - ', users.email) as user_email"),
            )
            ->get();

            // Retorna os dados utilizando a MarcacoesResource
        return $userEmails;
    }
    public static function getUserForEmail($email)
    {
        $userIds = DB::table('users')
            ->where('email', $email)
            ->whereNotNull('id_int')
            ->select(
                'users.id_int')
            ->first();

            // Retorna os dados utilizando a MarcacoesResource
        return $userIds;
    }
}
