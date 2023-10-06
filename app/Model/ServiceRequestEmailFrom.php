<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceRequestEmailFrom extends Model
{
    public static function insert($email, $service_master, $service_request_id){
        $service_request = new ServiceRequestEmailFrom();

        $service_request->email = $email;
        $service_request->service_master = $service_master;
        $service_request->counter = self::getLastId($service_master);
        $service_request->service_request = $service_request_id;

        if($service_request->save()){
            return '1';
        }

        return '0';
    }

    private static function getLastId($service_master){
        $data = DB::table('service_request_email_froms')
            ->select('counter')
            ->where('service_master', $service_master)
            ->orderBy('counter', 'DESC')
            ->first();

        if($data != null){
            return ((integer)$data->counter) + 1;
        }
        return 1;
    }

    public static function emailFrom($service_master, $counter){
        return DB::table('service_request_email_froms')
            ->select('email')
            ->where('service_master', $service_master)
            ->where('counter', $counter)
            ->orderBy('counter', 'ASC')
            ->get();
    }
}
