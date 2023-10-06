<?php

namespace App\Model;

use App\Mail\AutoMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Requisition extends Model
{
    public static function getRequisitionByServiceMaster($service_master){
        return DB::table('requisitions')
            ->select('*')
            ->where('service_master', $service_master)
            ->where('status', '!=', 'D')
            ->first();
    }

    public static function getInsertedRequisitionList(){
        return DB::table('requisitions')
            ->join('service_masters', 'service_masters.id', '=', 'requisitions.service_master')
            ->select('*', 'requisitions.remarks AS requisition_remarks', 'service_masters.service_id', 'service_masters.problem_description')
            ->where('requisitions.status', '=', 'I')
            ->orderBy('requisition_no', 'DESC')
            ->get();
    }

    public static function cancelRequisition($request){
        $service_request = Requisition::find($request->id);

        $service_request->last_updated_by = Auth::id();
        $service_request->status = 'C';
       // $service_request->product_received_at = Carbon::now();

        if($service_request->save()){
            $service_master = ServiceMaster::find($service_request->service_master);
           // $service_master->requisition_received = false;
            $service_master->access = 'S';
            $service_master->status = 'UP';
            $service_master->save();

            $user_email = User::find(Auth::id())->email;
            $assigned_email = ServiceAssign::getCurrentAssignment($service_master->id)->email;
            $mail_description = "Requisition Canceled; Service ID: ".$service_master->service_id;

            $result = Mail::to($assigned_email)->cc($user_email)->send(new AutoMail($mail_description));
            $req_result = ServiceRequestEmail::insertManual($mail_description, $service_master->id);
            $req_result_from_email = ServiceRequestEmailFrom::insert("support.it@palmalgarments.com", $service_master->id, $req_result);
            $e_result = ServiceRequestEmailTo::insert($assigned_email, $service_master->id, "to", $req_result);
            $e_result = ServiceRequestEmailTo::insert($user_email, $service_master->id, "cc", $req_result);

            $history = ServiceHistory::insert($service_master->id, "Requisition Canceled!");

            return '2';
        }
        return '0';
    }

    public static function receiveProduct($request){
        $service_request = Requisition::find($request->id);

        $service_request->last_updated_by = Auth::id();
        $service_request->status = 'R';
        $service_request->product_received_at = Carbon::now();

        if($service_request->save()){
            $service_master = ServiceMaster::find($service_request->service_master);
            $service_master->requisition_received = true;
            $service_master->access = 'S';
            $service_master->status = 'UP';
            $service_master->save();

            $user_email = User::find(Auth::id())->email;
            $assigned_email = ServiceAssign::getCurrentAssignment($service_master->id)->email;
            $mail_description = "Requisition Product Received from Vendor, please collect product form purchase desk; Service ID: ".$service_master->service_id;

            $result = Mail::to($assigned_email)->cc($user_email)->send(new AutoMail($mail_description));
            $req_result = ServiceRequestEmail::insertManual($mail_description, $service_master->id);
            $req_result_from_email = ServiceRequestEmailFrom::insert("support.it@palmalgarments.com", $service_master->id, $req_result);
            $e_result = ServiceRequestEmailTo::insert($assigned_email, $service_master->id, "to", $req_result);
            $e_result = ServiceRequestEmailTo::insert($user_email, $service_master->id, "cc", $req_result);

            $history = ServiceHistory::insert($service_master->id, "Requisition Product Received from Vendor!");

            return '2';
        }
        return '0';
    }

    public static function rejectProduct($request){
        $service_request = Requisition::find($request->id);
        $service_request->last_updated_by = Auth::id();
        $service_request->status = 'I';
        $service_request->remarks = $request->remarks;

        if($service_request->save()){
            $service_master = ServiceMaster::find($service_request->service_master);
            $service_master->requisition_received = true;
            $service_master->access = 'P';
            $service_master->status = 'PR';
            $service_master->save();

            $user_email = User::find(Auth::id())->email;
            //$assigned_email = ServiceAssign::getCurrentAssignment($service_master->id)->email;
            $mail_description = "Requisition Product Rejected; Requisition No: ".$service_request->requisition_no;
            $result = Mail::to("nazir.it@palmalgarments.com")->cc($user_email)->send(new AutoMail($mail_description));
            $req_result = ServiceRequestEmail::insertManual($mail_description, $service_master->id);
            $req_result_from_email = ServiceRequestEmailFrom::insert("support.it@palmalgarments.com", $service_master->id, $req_result);
            $e_result = ServiceRequestEmailTo::insert("nazir.it@palmalgarments.com", $service_master->id, "to", $req_result);
            $e_result = ServiceRequestEmailTo::insert($user_email, $service_master->id, "cc", $req_result);
            $result = ServiceHistory::insert($service_request->service_master, "Requisition Product Rejected; Rejection Remarks: ".$request->remarks);

            return '2';
        }
        return '0';
    }

    public static function insert($request){
        $service_request = new Requisition();

        $service_request->service_master = $request->service_master;
        $service_request->requisition_no = $request->requisition_no;

        //$service_request->reason_of_purchase = $request->reason_of_purchase;
        $service_request->service_comment = $request->service_comment;
        $service_request->remarks = $request->remarks;

        $service_request->received_at = $request->received_at;
        $service_request->received_by = $request->received_by;

        $service_request->inserted_by = Auth::id();
        $service_request->status = 'I';

        if($request->is_out_of_order == 'on'){
            $service_request->is_out_of_order = true;
        }
        else{
            $service_request->is_out_of_order = false;
        }

        if($service_request->save()){
            //send auto mail to purchase desk

            $service_master = ServiceMaster::find($request->service_master);
            $service_master->requisition_received = true;
            $service_master->access = 'P';
            $service_master->status = 'PR';
            $service_master->save();

            $user_email = User::find(Auth::id())->email;
            //$assigned_email = ServiceAssign::getCurrentAssignment($service_master->id)->email;
            $mail_description = "New Requisition Request Inserted; Requisition No: ".$service_request->requisition_no;

            $result = Mail::to("nazir.it@palmalgarments.com")->cc($user_email)->send(new AutoMail($mail_description));
            $req_result = ServiceRequestEmail::insertManual($mail_description, $service_master->id);
            $req_result_from_email = ServiceRequestEmailFrom::insert("support.it@palmalgarments.com", $service_master->id, $req_result);
            $e_result = ServiceRequestEmailTo::insert("nazir.it@palmalgarments.com", $service_master->id, "to", $req_result);
            $e_result = ServiceRequestEmailTo::insert($user_email, $service_master->id, "cc", $req_result);
            $result = ServiceHistory::insert($request->service_master, "New Requisition Info Inserted");

            return '1';
        }

        return '0';
    }

    public static function updateRequisition($request){
        $service_request = Requisition::find($request->id);

        $service_request->service_master = $request->service_master;
        $service_request->requisition_no = $request->requisition_no;

       // $service_request->reason_of_purchase = $request->reason_of_purchase;
        $service_request->service_comment = $request->service_comment;
        $service_request->remarks = $request->remarks;

        $service_request->received_at = $request->received_at;
        $service_request->received_by = $request->received_by;

        $service_request->last_updated_by = Auth::id();
        $service_request->status = 'I';

        if($request->is_out_of_order == 'on'){
            $service_request->is_out_of_order = true;
        }
        else{
            $service_request->is_out_of_order = false;
        }

        if($service_request->save()){

            $service_master = ServiceMaster::find($request->service_master);
            $service_master->requisition_received = true;
            $service_master->access = 'P';
            $service_master->status = 'PR';
            $service_master->save();

            //send auto mail to purchase desk
            $user_email = User::find(Auth::id())->email;
            //$assigned_email = ServiceAssign::getCurrentAssignment($service_master->id)->email;
            $mail_description = "Requisition Request Updated; Requisition No: ".$service_request->requisition_no;

            $result = Mail::to("nazir.it@palmalgarments.com")->cc($user_email)->send(new AutoMail($mail_description));
            $req_result = ServiceRequestEmail::insertManual($mail_description, $service_request->service_master);
            $req_result_from_email = ServiceRequestEmailFrom::insert("support.it@palmalgarments.com", $service_request->service_master, $req_result);
            $e_result = ServiceRequestEmailTo::insert("nazir.it@palmalgarments.com", $service_request->service_master, "to", $req_result);
            $e_result = ServiceRequestEmailTo::insert($user_email, $service_request->service_master, "cc", $req_result);
            $result = ServiceHistory::insert($request->service_master, "Requisition Info Updated");

            return '2';
        }
        return '0';
    }

    public static function updateRequisitionPurchase($request){
        $service_request = Requisition::find($request->id);

        $service_request->purchase_comment = $request->purchase_comment;
        $service_request->last_updated_by = Auth::id();
        $service_request->status = 'I';

        if($service_request->save()){
            $result = ServiceHistory::insert($request->service_master, "Purchase Comment Inserted in Requisition");
            return '2';
        }
        return '0';
    }

    public static function deleteRequisition($request){
        $service_request = Requisition::find($request->id);
        $service_request->last_updated_by = Auth::id();
        $service_request->status = 'D';
        if($service_request->save()){
            $service_master = ServiceMaster::find($request->service_master);
            $service_master->rquisition_received = false;
            $service_master->save();
            $result = ServiceHistory::insert( $service_master->id, "Requisition Deleted; Requisition No: ".$service_request->requisition_no."-".$service_request->id);
            return '1';
        }

        return '0';
    }
}
