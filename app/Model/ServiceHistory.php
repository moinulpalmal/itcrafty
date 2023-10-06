<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceHistory extends Model
{
    public static function getServiceHistories($service_master){
        return DB::table('service_histories')
            ->join('users', 'users.id', '=', 'service_histories.inserted_by')
            ->select('users.name', 'service_histories.created_at', 'service_histories.description', 'service_histories.counter')
            ->where('service_histories.service_master', $service_master)
            ->orderBy('service_histories.counter', 'DESC')
            ->get();

    }

    public static function insert($service_master, $description){
        $history = new ServiceHistory();
        $history->service_master = $service_master;
        $history->counter = self::getLastId($service_master);
        $history->description =  $description;
        $history->inserted_by = Auth::id();
        return $history->save();
    }

    private static function getLastId($service_master){
        $data = DB::table('service_histories')
            ->select('counter')
            ->where('service_master', $service_master)
            ->orderBy('counter', 'DESC')
            ->first();

        if($data != null){
            return ((integer)$data->counter) + 1;
        }
        return 1;
    }
}
