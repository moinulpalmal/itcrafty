<?php

namespace App\Model;

use App\Mail\AutoMail;
use App\Mail\SendRequisitionRequest;
use App\Mail\SendWarrantyRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ServiceWarranty extends Model
{
    /*public static function warrantyServiceRequestedList(){
        return DB::table('service_warranties')
            ->join('service_masters', 'service_masters.id', '=', 'service_warranties.service_master')
            ->join('product_masters', 'product_masters.id', '=', 'service_masters.product_master')
            ->join('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->join('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->join('customers', 'customers.id', '=', 'service_masters.customer')
            ->join('factories', 'factories.id', '=', 'customers.factory')
            ->leftjoin('departments', 'departments.id', '=', 'customers.department')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->select('product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category',
                'manufacturers.name AS manufacturer', 'factories.factory_name AS factory', 'departments.name AS department',
                'customers.name AS customer', 'designations.name AS designation', 'product_masters.name AS product_name', 'service_masters.contact_email',
                'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_warranties.id',
                'service_warranties.received_at', 'service_warranties.delivered_at', 'service_warranties.mailed_at', 'service_warranties.generated_at', 'service_warranties.sent_at')
            ->where('service_warranties.status', 'G')
            ->orderBy('service_masters.service_id', 'DESC')
            ->get();
    }*/

    public static function warrantyGeneratedRequestedList(){
        return DB::table('service_warranties')
            ->join('service_masters', 'service_masters.id', '=', 'service_warranties.service_master')
            ->join('product_masters', 'product_masters.id', '=', 'service_masters.product_master')
            ->join('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->join('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->join('customers', 'customers.id', '=', 'service_masters.customer')
            ->join('factories', 'factories.id', '=', 'customers.factory')
            ->leftjoin('departments', 'departments.id', '=', 'customers.department')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->select('product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category',
                'manufacturers.name AS manufacturer', 'factories.factory_name AS factory', 'departments.name AS department',
                'customers.name AS customer', 'designations.name AS designation', 'product_masters.name AS product_name', 'service_masters.contact_email',
                'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_warranties.id',
                'service_warranties.received_at', 'service_warranties.delivered_at', 'service_warranties.mailed_at', 'service_warranties.generated_at', 'service_warranties.sent_at')
            ->where('service_warranties.status', 'G')
            ->orderBy('service_masters.service_id', 'DESC')
            ->get();
    }

    public static function warrantyRequestSentToVendorList(){
        return DB::table('service_warranties')
            ->join('service_masters', 'service_masters.id', '=', 'service_warranties.service_master')
            ->join('product_masters', 'product_masters.id', '=', 'service_masters.product_master')
            ->join('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->join('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->join('customers', 'customers.id', '=', 'service_masters.customer')
            ->join('factories', 'factories.id', '=', 'customers.factory')
            ->leftjoin('departments', 'departments.id', '=', 'customers.department')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->select('product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category',
                'manufacturers.name AS manufacturer', 'factories.factory_name AS factory', 'departments.name AS department',
                'customers.name AS customer', 'designations.name AS designation', 'product_masters.name AS product_name', 'service_masters.contact_email',
                'service_warranties.received_at', 'service_warranties.delivered_at', 'service_warranties.mailed_at', 'service_warranties.generated_at', 'service_warranties.sent_at',
                'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_warranties.id')
            ->where('service_warranties.status', 'M')
            ->orderBy('service_masters.service_id', 'DESC')
            ->get();
    }

    public static function warrantyProductSentToVendorList(){
        return DB::table('service_warranties')
            ->join('service_masters', 'service_masters.id', '=', 'service_warranties.service_master')
            ->join('product_masters', 'product_masters.id', '=', 'service_masters.product_master')
            ->join('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->join('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->join('customers', 'customers.id', '=', 'service_masters.customer')
            ->join('factories', 'factories.id', '=', 'customers.factory')
            ->leftjoin('departments', 'departments.id', '=', 'customers.department')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->select('product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category',
                'manufacturers.name AS manufacturer', 'factories.factory_name AS factory', 'departments.name AS department',
                'customers.name AS customer', 'designations.name AS designation', 'product_masters.name AS product_name', 'service_masters.contact_email',
                'service_warranties.received_at', 'service_warranties.delivered_at', 'service_warranties.mailed_at', 'service_warranties.generated_at', 'service_warranties.sent_at',
                'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_warranties.id')
            ->where('service_warranties.status', 'S')
            ->orderBy('service_masters.service_id', 'DESC')
            ->get();
    }

    public static function warrantyReceivedFromVendorList(){
        return DB::table('service_warranties')
            ->join('service_masters', 'service_masters.id', '=', 'service_warranties.service_master')
            ->join('product_masters', 'product_masters.id', '=', 'service_masters.product_master')
            ->join('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->join('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->join('customers', 'customers.id', '=', 'service_masters.customer')
            ->join('factories', 'factories.id', '=', 'customers.factory')
            ->leftjoin('departments', 'departments.id', '=', 'customers.department')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->select('product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category',
                'manufacturers.name AS manufacturer', 'factories.factory_name AS factory', 'departments.name AS department',
                'customers.name AS customer', 'designations.name AS designation', 'product_masters.name AS product_name', 'service_masters.contact_email',
                'service_warranties.received_at', 'service_warranties.delivered_at', 'service_warranties.mailed_at', 'service_warranties.generated_at', 'service_warranties.sent_at',
                'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_warranties.id')
            ->where('service_warranties.status', 'R')
            ->orderBy('service_masters.service_id', 'DESC')
            ->get();
    }

    public static function warrantySentToServiceList($count){
        return DB::table('service_warranties')
            ->join('service_masters', 'service_masters.id', '=', 'service_warranties.service_master')
            ->join('product_masters', 'product_masters.id', '=', 'service_masters.product_master')
            ->join('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->join('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->join('customers', 'customers.id', '=', 'service_masters.customer')
            ->join('factories', 'factories.id', '=', 'customers.factory')
            ->leftjoin('departments', 'departments.id', '=', 'customers.department')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->select('product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category',
                'manufacturers.name AS manufacturer', 'factories.factory_name AS factory', 'departments.name AS department',
                'customers.name AS customer', 'designations.name AS designation', 'product_masters.name AS product_name', 'service_masters.contact_email',
                'service_warranties.received_at', 'service_warranties.delivered_at', 'service_warranties.mailed_at', 'service_warranties.generated_at', 'service_warranties.sent_at',
                'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_warranties.id')
            ->where('service_warranties.status', 'DP')
            ->orderBy('service_masters.service_id', 'DESC')
            ->get()
            ->take($count);
    }

    public static function warrantyCanceledList($count){
        return DB::table('service_warranties')
            ->join('service_masters', 'service_masters.id', '=', 'service_warranties.service_master')
            ->join('product_masters', 'product_masters.id', '=', 'service_masters.product_master')
            ->join('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->join('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->join('customers', 'customers.id', '=', 'service_masters.customer')
            ->join('factories', 'factories.id', '=', 'customers.factory')
            ->leftjoin('departments', 'departments.id', '=', 'customers.department')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->select('product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category',
                'manufacturers.name AS manufacturer', 'factories.factory_name AS factory', 'departments.name AS department',
                'customers.name AS customer', 'designations.name AS designation', 'product_masters.name AS product_name', 'service_masters.contact_email',
                'service_warranties.received_at', 'service_warranties.delivered_at', 'service_warranties.mailed_at', 'service_warranties.generated_at', 'service_warranties.sent_at',
                'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_warranties.id')
            ->where('service_warranties.status', 'C')
            ->orderBy('service_masters.service_id', 'DESC')
            ->get()
            ->take($count);
    }


    public static function insertIntoServiceWarranty($request){
        //insert service warranty
        $service_warranty = new ServiceWarranty();
        $service_warranty_check = ServiceWarrantyCheck::find($request->id);
        $service_master = ServiceMaster::find($service_warranty_check->service_master);
        $product_detail = ProductDetail::find($service_warranty_check->product_detail);

        $service_warranty->service_master = $service_master->id;
        $service_warranty->service_warranty_check = $request->id;
        $service_warranty->vendor = $product_detail->vendor;
        $service_warranty->problem_description = $service_warranty_check->description;
        $service_warranty->generated_at = Carbon::now();
        $service_warranty->inserted_by = Auth::id();
        $service_warranty->remarks = $request->remarks;
        $service_warranty->status = 'G';
        if($service_warranty->save()){
            $service_master->status = 'RW';
            $service_master->last_updated_by = Auth::id();

            $service_warranty_check->is_warranty_requested = true;
            $service_warranty_check->warranty_status = 'HR';
            $service_warranty_check->last_updated_by = Auth::id();
            $service_warranty_check->status = 'R';
            $service_warranty_check->save();

            if($service_master->save()){
                $result = ServiceHistory::insert($service_master->id, "Requested for Vendor Warranty!");
                return '1';
            }
        }

        return null;
    }

    public static function proceedWithoutWarranty($request){
        $service_master = ServiceMaster::find($request->id);
        if($service_master->product_detail == null){
            $service_master->product_detail = 0;
            $service_master->last_updated_by = Auth::id();

            if($service_master->save()){
                $result = ServiceHistory::insert($service_master->id, "Service started without warranty check!");
                return '1';
            }
        }

        return '0';
    }

    public static function assignVendor($request){
        $service_warranty = ServiceWarranty::find($request->id);
        $service_master = ServiceMaster::find($service_warranty->service_master);
        $product_detail = ProductDetail::find($service_master->product_detail);

        $service_warranty->vendor = $request->vendor;
        $service_warranty->last_updated_by = Auth::id();
        //$service_warranty->save();

        if($service_warranty->save()){
             if($product_detail->vendor == null)
             {
                   $product_detail->vendor = $request->vendor;
                   $product_detail->last_updated_by = Auth::id();
                   $product_detail->save();

                   return '2';
             }
        }
        return '0';
    }

    public static function sendWarrantyMail($request){
        $service_warranty = ServiceWarranty::find($request->id);
        $service_master = ServiceMaster::find($service_warranty->service_master);
        //$product_detail = ProductDetail::find($service_master->product_detail);
        $result = Mail::to($request->to_email)->cc($request->to_cc_email)->send(new SendWarrantyRequest($request->warranty_email_description));
        $user_email = User::find(Auth::id())->email;

        if($result == null){

            //service request email insert
            $req_result = ServiceRequestEmail::insertManual($request->warranty_email_description, $service_master->id);

            //update service warranty
            $service_warranty->mailed_at = Carbon::now();
            $service_warranty->service_mail = $req_result;
            $service_warranty->status = 'M';
            $service_warranty->last_updated_by = Auth::id();
            $service_warranty->save();

            $req_result_from_email = ServiceRequestEmailFrom::insert($user_email, $service_master->id, $req_result);

            foreach ($request->to_email AS $mail){
                $e_result = ServiceRequestEmailTo::insert($mail, $service_master->id, "to", $req_result);
            }

            if(!empty($request->to_cc_email)){
                foreach ($request->to_cc_email AS $mail){
                    $e_result = ServiceRequestEmailTo::insert($mail, $service_master->id, "cc", $req_result);
                }
            }
            //insert info service history
            $history = ServiceHistory::insert($service_master->id, "Warranty Request Mail Sent to Vendor");
            return '1';

        }

        return '0';
    }

    public static function deliverToVendorForWarranty($request){
        $service_warranty = ServiceWarranty::find($request->id);
        $service_master = ServiceMaster::find($service_warranty->service_master);

        $service_warranty->sent_at = Carbon::now();
        $service_warranty->status = 'S';
        $service_warranty->last_updated_by = Auth::id();
        if($service_warranty->save()){
            $history = ServiceHistory::insert($service_master->id, "Product Sent to Vendor for Warranty!");
            return '1';
        }

        return '0';
    }

    public static function receivedFromVendorForWarranty($request){
        $service_warranty = ServiceWarranty::find($request->id);
        $service_master = ServiceMaster::find($service_warranty->service_master);

        $service_warranty->received_at = Carbon::now();
        $service_warranty->status = 'R';
        $service_warranty->last_updated_by = Auth::id();
        if($service_warranty->save()){
            $history = ServiceHistory::insert($service_master->id, "Product Received from Vendor Warranty Service!");
            return '1';
        }

        return '0';
    }

    public static function deliverWarrantyProduct($request){
        $service_warranty = ServiceWarranty::find($request->id);
        $service_master = ServiceMaster::find($service_warranty->service_master);

        $service_warranty->delivered_at = Carbon::now();
        $service_warranty->status = 'DP';
        $service_warranty->last_updated_by = Auth::id();
        if($service_warranty->save()){
            $service_master->status = 'WR';
            $service_master->access = 'S';
            $service_master->last_updated_by = Auth::id();
            $service_master->save();
            //$assigned_to = ServiceMaster::assignedList()
            $user_email = User::find(Auth::id())->email;
            $assigned_email = ServiceAssign::getCurrentAssignment($service_master->id)->email;
            $mail_description = "Warranty Product Received from Vendor; Service ID: ".$service_master->service_id;

            $result = Mail::to($assigned_email)->cc($user_email)->send(new AutoMail($mail_description));
            $req_result = ServiceRequestEmail::insertManual($mail_description, $service_master->id);
            $req_result_from_email = ServiceRequestEmailFrom::insert("support.it@palmalgarments.com", $service_master->id, $req_result);
            $e_result = ServiceRequestEmailTo::insert($assigned_email, $service_master->id, "to", $req_result);
            $e_result = ServiceRequestEmailTo::insert($user_email, $service_master->id, "cc", $req_result);

            $history = ServiceHistory::insert($service_master->id, "Product Delivered to Service Desk after Vendor Warranty Service!");
            return '1';
        }

        return '0';
    }

    public static function cancelWarrantyRequest($request){
        $service_warranty = ServiceWarranty::find($request->id);
        $service_master = ServiceMaster::find($service_warranty->service_master);

        $service_warranty->delivered_at = Carbon::now();
        $service_warranty->status = 'C';
        $service_warranty->last_updated_by = Auth::id();
        if($service_warranty->save()){
            $service_master->status = 'WR';
            $service_master->last_updated_by = Auth::id();
            $service_master->save();
            $history = ServiceHistory::insert($service_master->id, "Warranty Request Canceled!");
            return '1';
        }

        return '0';
    }

    public static function warrantySummaryCount(){
        $data = DB::table('service_warranties')
            ->select(DB::raw('COUNT(id) as warranty_count'), 'status')
            ->where('status', '!=', 'D')
            ->groupBy('status')
            ->get();

        return $data;
    }
}
