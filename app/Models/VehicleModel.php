<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = ['id'];

    public static function getVehicleTags($id)
    {
        $userEmails = DB::table('vehicle_models')
             ->select(
                'users.email',  DB::raw("CONCAT(users.name, ' - ', users.email) as user_email"),
            )
            ->get();

            // Retorna os dados utilizando a MarcacoesResource
        return $userEmails;
    }
}
