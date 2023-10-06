<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceWarrantyCheck extends Model
{
    public static function insertIntoServiceWarrantyCheck($request){
        //insert service warranty
        $service_warranty = new ServiceWarrantyCheck();
        $service_master = ServiceMaster::find($request->service_master);
        //$product_detail = ProductDetail::find($service_master->product_detail);

        $service_warranty->service_master = $request->service_master;
        $service_warranty->product_master = $request->product_master;
        $service_warranty->counter = self::getLastId($request->service_master);
       // $service_warranty->serial_no = $request->service_master;
        $service_warranty->serial_no =$request->serial_no;
        $service_warranty->inserted_by = Auth::id();
        $service_warranty->description =$request->description;

        $service_warranty->status = 'I';
        if($service_warranty->save()){
            $service_master->status = 'RW';
            $service_master->access = 'P';
            $service_master->last_updated_by = Auth::id();

            if($service_master->save()){
                $result = ServiceHistory::insert($service_master->id, "Requested for Purchase Warranty Check!");
                return '1';
            }
        }
        return '1';
    }

    public static function serviceWarrantyDetails($id){
        return DB::table('service_warranty_checks')
            ->join('product_masters', 'product_masters.id', '=', 'service_warranty_checks.product_master')
            ->join('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->join('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->leftjoin('product_details', 'product_details.id', '=', 'service_warranty_checks.product_detail')
            ->leftJoin('vendors', 'vendors.id', '=', 'product_details.vendor')
            ->select('product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category',
                'manufacturers.name AS manufacturer', 'product_masters.name AS product_name', 'service_warranty_checks.product_detail', 'service_warranty_checks.description',
                'service_warranty_checks.product_master',
                'product_details.sl_no', 'product_details.old_name', 'vendors.name AS vendor_name', 'product_details.old_vendor')
            ->where('service_warranty_checks.id', $id)
            ->first();
    }

    public static function getServiceWarrantyChecks($service_master){
        return DB::table('service_warranty_checks')
            ->join('product_masters', 'product_masters.id', '=', 'service_warranty_checks.product_master')
            ->join('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->join('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->join('product_categories', 'product_categories.id', '=', 'product_sub_categories.product_category')
            ->select('product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category',
                'manufacturers.name AS manufacturer', 'product_masters.name AS product_master', 'service_warranty_checks.service_master',
                'service_warranty_checks.serial_no', 'service_warranty_checks.counter', 'service_warranty_checks.warranty_status',
                'service_warranty_checks.is_warranty_requested', 'service_warranty_checks.description', 'service_warranty_checks.status',
                'service_warranty_checks.created_at', 'service_warranty_checks.updated_at', 'service_warranty_checks.remarks')
            ->where('service_warranty_checks.status', '!=', 'D')
            ->where('service_warranty_checks.service_master', '=', $service_master)
            ->orderBy('service_warranty_checks.counter', 'DESC')
            ->get();
    }



    public static function getWarrantyRequestedList($counter){
        return DB::table('service_warranty_checks')
            ->join('service_masters', 'service_masters.id', '=', 'service_warranty_checks.service_master')
            ->join('product_masters', 'product_masters.id', '=', 'service_warranty_checks.product_master')
            ->join('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->join('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->join('product_categories', 'product_categories.id', '=', 'product_sub_categories.product_category')
            ->select('service_warranty_checks.id',
                'service_masters.id AS service_master_id' , 'service_masters.service_id',
                'product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category',
                'manufacturers.name AS manufacturer', 'product_masters.name AS product_master', 'service_warranty_checks.service_master',
                'service_warranty_checks.serial_no', 'service_warranty_checks.counter', 'service_warranty_checks.warranty_status',
                'service_warranty_checks.is_warranty_requested', 'service_warranty_checks.description', 'service_warranty_checks.status',
                'service_warranty_checks.created_at', 'service_warranty_checks.updated_at', 'service_warranty_checks.remarks')
            ->where('service_warranty_checks.status', '=', 'I')
            ->orderBy('service_masters.id', 'DESC')
            ->orderBy('service_warranty_checks.counter', 'DESC')
            ->get()
            ->take($counter);
    }

    private static function getLastId($service_master){
        $data = DB::table('service_warranty_checks')
            ->select('counter')
            ->where('service_master', $service_master)
            ->orderBy('counter', 'DESC')
            ->first();

        if($data != null){
            return ((integer)$data->counter) + 1;
        }
        return 1;
    }

    public static function rejectNoWarranty($request){
        //insert service warranty
        //$service_warranty = new ServiceWarranty();

        $service_warranty_check = ServiceWarrantyCheck::find($request->id);
        $service_master = ServiceMaster::find($service_warranty_check->service_master);

        $service_warranty_check->warranty_status = 'NW';
        $service_warranty_check->is_warranty_requested = true;
        $service_warranty_check->last_updated_by = Auth::id();
        $service_warranty_check->status = 'NW';
        if($service_warranty_check->save()){
            $service_master->access = 'S';
            $service_master->status = 'UP';
            $service_master->last_updated_by = Auth::id();
            $service_master->save();
            $result = ServiceHistory::insert($service_master->id, "Product Has No Warranty!");

            return '1';
        }

        return null;
    }

    public static function invalidProduct($request){
        //insert service warranty
        //$service_warranty = new ServiceWarranty();

        $service_warranty_check = ServiceWarrantyCheck::find($request->id);
        $service_master = ServiceMaster::find($service_warranty_check->service_master);

        $service_warranty_check->warranty_status = 'IR';
        $service_warranty_check->is_warranty_requested = true;
        $service_warranty_check->last_updated_by = Auth::id();
        $service_warranty_check->status = 'IP';
        if($service_warranty_check->save()){
            $service_master->access = 'S';
            $service_master->status = 'UP';
            $service_master->last_updated_by = Auth::id();
            $service_master->save();
            $result = ServiceHistory::insert($service_master->id, "Invalid Product!");

            return '1';
        }

        return null;
    }

    public static function warrantyVoid($request){
        //insert service warranty
        //$service_warranty = new ServiceWarranty();

        $service_warranty_check = ServiceWarrantyCheck::find($request->id);
        $service_master = ServiceMaster::find($service_warranty_check->service_master);

        $service_warranty_check->warranty_status = 'WV';
        $service_warranty_check->is_warranty_requested = true;
        $service_warranty_check->last_updated_by = Auth::id();
        $service_warranty_check->status = 'WV';
        if($service_warranty_check->save()){
            $service_master->access = 'S';
            $service_master->status = 'UP';
            $service_master->last_updated_by = Auth::id();
            $service_master->save();
            $result = ServiceHistory::insert($service_master->id, "Warranty Void!");

            return '1';
        }

        return null;
    }

}
