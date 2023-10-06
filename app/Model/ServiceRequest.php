<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceRequest extends Model
{
    public static function insert($request){
        $service_request = new ServiceRequest();

        $service_request->service_master = $request->service_master;
        $service_request->counter = self::getLastId($request->service_master);
        $service_request->tracking = $request->tracking;
        $service_request->description = $request->description;

        $service_request->inserted_by = Auth::id();
        $service_request->status = 'I';

        if($service_request->save()){

            $result = ServiceHistory::insert($request->service_master, "New Service Requests With this
            Following Description: ".$request->description);

            return '1';
        }

        return '0';
    }

    public static function getServiceRequestsByTracking($tracking){
        $data =  DB::table('service_requests')
            ->join('service_masters', 'service_masters.id', '=', 'service_requests.service_master')
            ->select('service_master.id AS service_master', 'service_master.service_id', 'service_requests.tracking',
                'service_requests.tracking', 'service_requests.tracking_id', 'service_requests.description')
            ->where('service_requests.tracking', $tracking)
            ->where('service_requests.status', '!=', 'D')
            ->orderBy('service_masters.service_id', 'DESC')
            ->orderBy('service_requests.counter', 'ASC')
            ->get();
    }

    public static function getServiceRequestsByServiceMaster($service_masters){
        $data =  DB::table('service_requests')
            ->join('service_masters', 'service_masters.id', '=', 'service_requests.service_master')
            ->select('service_masters.id AS service_master', 'service_masters.service_id', 'service_requests.tracking',
                'service_requests.tracking', 'service_requests.tracking_id', 'service_requests.description')
            ->where('service_requests.service_master', $service_masters)
            ->where('service_requests.status', '!=', 'D')
            ->orderBy('service_masters.service_id', 'DESC')
            ->orderBy('service_requests.counter', 'ASC')
            ->get();
    }

    private static function getLastId($service_master){
        $data = DB::table('service_requests')
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
