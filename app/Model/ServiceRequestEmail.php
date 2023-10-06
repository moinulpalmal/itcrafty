<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceRequestEmail extends Model
{
    public static function insert($request){
        $service_request = new ServiceRequestEmail();

        $service_request->service_master = $request->service_master;
        $service_request->counter = self::getLastId($request->service_master);
        if($request->email_tag == "RR"){
            $service_request->email_description = $request->requisition_email_description;
        }
        else if($request->email_tag == "SC"){
            $service_request->email_description = $request->service_email_description;
        }
        else if($request->email_tag == "RW"){
            $service_request->email_description = $request->warranty_email_description;
        }
        else if($request->email_tag == "MB"){
            $service_request->email_description = $request->mac_binding_email_description;
        }
        else{
            $service_request->email_description = "";
        }


        if($service_request->save()){

           /* $result = ServiceHistory::insert($request->service_master, "New Service Requests Email With this
            Following Description: ".$request->description);*/

            return  $service_request->counter;
        }

        return '0';
    }

    public static function insertManual($description, $service_master_id){
        $service_request = new ServiceRequestEmail();

        $service_request->service_master = $service_master_id;

        $service_request->counter = self::getLastId($service_master_id);
        $service_request->email_description = $description;
        if($service_request->save()){

            /* $result = ServiceHistory::insert($request->service_master, "New Service Requests Email With this
             Following Description: ".$request->description);*/

            return $service_request->counter;
        }

        return '0';
    }

    private static function getLastId($service_master){
        $data = DB::table('service_request_emails')
            ->select('counter')
            ->where('service_master', $service_master)
            ->orderBy('counter', 'DESC')
            ->first();

        if($data != null){
            return ((integer)$data->counter) + 1;
        }
        return 1;
    }

    public static function getEmailList($service_master){
        return DB::table('service_request_emails')
            ->select('counter', 'email_description', 'created_at')
            ->where('service_master', $service_master)
            ->orderBy('counter', 'DESC')
            ->get();
    }
}
