<?php

namespace App\Model;

use App\Mail\AutoMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ServiceMaster extends Model
{
    public static function insertProductMaster($request){
        $model = new ServiceMaster();
        $model->service_id = ServiceMaster::getNewServiceId();
        $model->customer = $request->customer;
        $model->contact_email = $request->email;
        $model->contact_no = ServiceMaster::getContactInfo($request);

        $model->product_master = $request->product_master;
        $model->problem_description = $request->problem_description;

        $model->received_by = $request->received_by;
        $model->received_at = $request->received_at;
        $model->remarks = $request->remarks;

        $model->inserted_by = Auth::id();
        $model->status = 'I';
        if($model->save()){
            //update customer info
            //insert into service history
            $history = ServiceHistory::insert($model->id, "New Service Master Inserted!");
            return $model->service_id;
        }
        return '0';
    }

    public static function updateProductMaster($request){
        $model = ServiceMaster::find($request->id);
       // $model->service_id = ServiceMaster::getNewServiceId();
        $model->customer = $request->customer;
        $model->contact_email = $request->email;
        $model->contact_no = ServiceMaster::getContactInfo($request);

        $model->product_master = $request->product_master;
        $model->problem_description = $request->problem_description;

        $model->received_by = $request->received_by;
        $model->received_at = $request->received_at;
        $model->remarks = $request->remarks;

        $model->last_updated_by = Auth::id();
       // $model->status = 'I';
        if($model->save()){
            //update customer info
            //insert into service history
            $history = ServiceHistory::insert($model->id, "Service Master Update!");
            return '2';
        }
        return '0';
    }

    public static function serviceComplete($request){
        //return $request->all();

        $model = ServiceMaster::find($request->id);

        $model->solution_description = $request->solution_description;
       // $model->solved_at = $request->solved_at;
        $model->solved_at = Carbon::now()->addHour(6);
        $model->status = "SC";
        $model->last_updated_by = Auth::id();
        $model->remarks = $request->remarks;
        if($model->save()){
            $e_result = ServiceSolver::insertSolver($request->id, $request->solved_by);
            // auto mail to service team leader
            $user_email = User::find(Auth::id())->email;
            $to_mail_list = User::getUserEmailListByTask("service_team_leader");
            //$assigned_email = ServiceAssign::getCurrentAssignment($service_master->id)->email;
            $mail_description = "Service Completed; Service ID: ".$model->service_id;
            $result = Mail::to($to_mail_list)->cc($user_email)->send(new AutoMail($mail_description));
            $req_result = ServiceRequestEmail::insertManual($mail_description, $model->id);
            $req_result_from_email = ServiceRequestEmailFrom::insert("support.it@palmalgarments.com", $model->id, $req_result);
           for($i = 0; $i < sizeof($to_mail_list); $i++){
               $e_result = ServiceRequestEmailTo::insert($to_mail_list[$i], $model->id, "to", $req_result);
           }
            $e_result = ServiceRequestEmailTo::insert($user_email,$model->id, "cc", $req_result);

            $history = ServiceHistory::insert($model->id, "Service Completed!");
            //solved by entry
            return '1';
        }

        return '0';
    }

    public static function serviceApproved($request){
        //return $request->all();

        $model = ServiceMaster::find($request->id);

       // $model->solution_description = $request->solution_description;
       // $model->solved_at = $request->solved_at;
        $model->status = "CA";
        $model->has_edit_access = false;
        $model->last_updated_by = Auth::id();
       // $model->remarks = $request->remarks;

        if($model->save()){
            //$e_result = ServiceSolver::insertSolver($request->id, $request->solved_by);
            // auto mail to service team leader
            if($model->contact_email != null){
                $e_result = ServiceSolver::insertSolver($request->id, $request->solved_by);
                // auto mail to service team leader
                $user_email = User::find(Auth::id())->email;
                //$to_mail_list = User::getUserEmailListByTask("service_team_leader");
                //$assigned_email = ServiceAssign::getCurrentAssignment($service_master->id)->email;
                $mail_description = "Service Completed; Please contact with CHO IT-Support desk; Service ID: ".$model->service_id;
                $result = Mail::to($model->contact_email)->cc($user_email)->send(new AutoMail($mail_description));
                $req_result = ServiceRequestEmail::insertManual($mail_description, $model->id);
                $req_result_from_email = ServiceRequestEmailFrom::insert("support.it@palmalgarments.com", $model->id, $req_result);
                $e_result = ServiceRequestEmailTo::insert($model->contact_email, $model->id, "to", $req_result);
                $e_result = ServiceRequestEmailTo::insert($user_email,$model->id, "cc", $req_result);
            }

            $history = ServiceHistory::insert($model->id, "Service Completed Approved!");
            //solved by entry
            return '1';
        }

        return '0';
    }

    private static function getContactInfo($request){
        $contact_no = "";
        if($request->job_location){
            $contact_no = $contact_no."Job Location: ".$request->job_location."; ";
        }

        if($request->mobile_no){
            if($contact_no != ''){
                $contact_no = $contact_no."Mobile No: ".$request->mobile_no. "; ";
            }

        }

        if($request->ext_no){
            if($contact_no != ''){
                $contact_no = $contact_no."Extension No: ".$request->ext_no."; ";
            }
        }

        return $contact_no;
    }

    private static function getNewServiceId(){
        $current_year = Carbon::now()->year;
        if(is_null(ServiceMaster::first())){
            $new_service_id = (integer)($current_year."0000"."1");
            return $new_service_id;
        }
        else{
            $last_service_id = ServiceMaster::all()->last()->service_id;
            $last_service_id_string = (string)$last_service_id;
            $last_year = (integer)substr($last_service_id_string, 0, 4);
            if($current_year == $last_year){
                return ($last_service_id+1);
            }
            else{
                $new_service_id = (integer)($current_year."0000"."1");
                return $new_service_id;
            }
        }

    }

    public static function makeUnderProcess($id){
        $service_master = ServiceMaster::find($id);
        //check current status
        if($service_master->status == "SA"){
            $service_master->status = 'UP';
            $service_master->last_updated_by = Auth::id();

            if($service_master->save()){
                //check current assignment check; if no current assign
                $result = ServiceHistory::insert($id , "Product Servicing Under Process!");
                return '1';
            }
        }
        else if($service_master->status == "I"){
            $service_master->status = 'UP';
            $service_master->last_updated_by = Auth::id();
            $service_master->has_assigned = true;

            if($service_master->save()){
                $history = new ServiceAssign();
                $history->service_master = $id;
                $history->counter = ServiceAssign::getLastIdForInsert($id);
                $history->assigned_to = Auth::id();
                $history->assignment_description =  "Self Assignment!";
                $history->assign_date =  Carbon::now();
                $history->inserted_by = Auth::id();
                $history->status = 'SA';
                $history->save();
                $result = ServiceHistory::insert($id , "Product Servicing Under Process with Self Assignment!");
                return '1';
            }
        }
        else{
            return '0';
        }

        return '0';
    }

    public static function deleteMaster($id){
        if(Auth::user()->hasTaskPermission('service_team_leader', Auth::id())){
            $service_master = ServiceMaster::find($id);

            $service_master->status = 'D';
            $service_master->last_updated_by = Auth::id();

            if($service_master->save()){
                $result = ServiceHistory::insert($id , "Service Master Deleted!");
                return '1';
            }
            return '0';
        }

        return '0';
    }

    public static function deliveryComplete($id){
        $service_master = ServiceMaster::find($id);

        $service_master->status = 'SD';
        $service_master->delivered_at = Carbon::now()->addHour(6);
        $service_master->delivered_by = Auth::id();
        $service_master->last_updated_by = Auth::id();

        if($service_master->save()){
            $result = ServiceHistory::insert($id , "Product Delivery Complete!");
            return '1';
        }

        return '0';
    }

    public static function getServiceMastersByProductDetail($product_detail){
        return DB::table('service_masters')
            ->select('id', 'service_id', 'received_at', 'solved_at', 'delivered_at')
            ->where('product_detail', $product_detail)
            ->where('status', '!=', 'D')
            ->orderBy('service_id', 'DESC')
            ->get();
    }

    public static function serviceMasterDetails($id){
        return DB::table('service_masters')
            ->join('product_masters', 'product_masters.id', '=', 'service_masters.product_master')
            ->join('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->join('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->join('customers', 'customers.id', '=', 'service_masters.customer')
            ->join('factories', 'factories.id', '=', 'customers.factory')
            ->leftjoin('departments', 'departments.id', '=', 'customers.department')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->leftjoin('product_details', 'product_details.id', '=', 'service_masters.product_detail')
            ->leftJoin('vendors', 'vendors.id', '=', 'product_details.vendor')
            ->select('product_categories.name AS product_category', 'product_categories.id AS product_category_id',
                'product_sub_categories.name AS product_sub_category', 'product_sub_categories.id AS product_sub_category_id',
                'manufacturers.name AS manufacturer', 'factories.factory_name AS factory', 'departments.name AS department',
                'customers.name AS customer', 'designations.name AS designation', 'customers.email AS customer_email', 'customers.employee_id',
                'product_masters.name AS product_name',  'product_masters.id AS product_master_id',
                'service_masters.contact_email', 'service_masters.access',
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id',
                'service_masters.solved_at', 'service_masters.delivered_at', 'service_masters.delivered_by', 'service_masters.received_by',
                'service_masters.product_detail', 'service_masters.problem_description', 'service_masters.solution_description', 'service_masters.remarks',
                'service_masters.has_assigned', 'service_masters.has_requisition_request', 'service_masters.product_master', 'service_masters.requisition_received',
                'product_details.sl_no', 'product_details.old_name', 'service_masters.has_warranty', 'service_masters.is_mac_binding_mail_sent',
                'service_masters.has_edit_access', 'vendors.name AS vendor_name', 'product_details.old_vendor')
            ->where('service_masters.id', $id)
            ->where('service_masters.status', '!=', 'D')
            ->orderBy('service_masters.service_id', 'ASC')
            ->first();
    }

    public static function forSearchList($count){
        return DB::table('service_masters')
            ->join('product_masters', 'product_masters.id', '=', 'service_masters.product_master')
            ->join('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->join('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->join('customers', 'customers.id', '=', 'service_masters.customer')
            ->join('factories', 'factories.id', '=', 'customers.factory')
            ->leftjoin('departments', 'departments.id', '=', 'customers.department')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->join('service_statuses', 'service_statuses.tag', '=', 'service_masters.status')
            ->select('product_categories.name AS product_category', 'product_categories.id AS product_category_id',
                'product_sub_categories.name AS product_sub_category', 'product_sub_categories.id AS product_sub_category_id',
                'product_masters.id AS product_master_id', 'factories.id AS factory_id', 'departments.id AS department_id',
                'manufacturers.name AS manufacturer', 'factories.factory_name AS factory', 'departments.name AS department',
                'customers.name AS customer', 'designations.name AS designation', 'product_masters.name AS product_name', 'service_masters.contact_email',
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id',
                 'service_statuses.service_status', 'service_statuses.tag AS status_tag')
            ->where('service_masters.status', '!=','D')
            ->orderBy('service_masters.service_id', 'DESC')
            ->get()
            ->take($count);
    }

    public static function queueList(){
        return DB::table('service_masters')
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
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id')
            ->where('service_masters.status', 'I')
            ->orderBy('service_masters.service_id', 'ASC')
            ->get();
    }

    public static function assignedList(){
        return DB::table('service_masters')
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
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id')
            ->where('service_masters.status', 'SA')
            ->orderBy('service_masters.service_id', 'ASC')
            ->get();
    }

    public static function assignedListByUser($user_id){
        return DB::table('service_assigns')
            ->join('service_masters', 'service_masters.id', '=', 'service_assigns.service_master')
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
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id')
            ->where('service_masters.status', 'SA')
            ->where('service_assigns.status', 'SA')
            ->where('service_assigns.assigned_to', $user_id)
            ->orderBy('service_masters.service_id', 'ASC')
            ->get();
    }

    public static function underProcessList(){
        return DB::table('service_masters')
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
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id')
            ->where('service_masters.status', 'UP')
            ->orderBy('service_masters.service_id', 'ASC')
            ->get();
    }

    public static function underProcessListByUser($user_id){
        return DB::table('service_assigns')
            ->join('service_masters', 'service_masters.id', '=', 'service_assigns.service_master')
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
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id')
            ->where('service_masters.status', 'UP')
            ->where('service_assigns.status', 'SA')
            ->where('service_assigns.assigned_to', $user_id)
            ->orderBy('service_masters.service_id', 'ASC')
            ->get();
    }

    public static function serviceCompleteList(){
        return DB::table('service_masters')
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
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id')
            ->where('service_masters.status', 'SC')
            ->orderBy('service_masters.service_id', 'ASC')
            ->get();
    }

    public static function serviceCompleteApprovedList(){
        return DB::table('service_masters')
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
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id')
            ->where('service_masters.status', 'CA')
            ->orderBy('service_masters.service_id', 'ASC')
            ->get();
    }

    public static function deliveryCompleteList($count){
        return DB::table('service_masters')
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
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id')
            ->where('service_masters.status', 'SD')
            ->orderBy('service_masters.service_id', 'ASC')
            ->get()
            ->count($count);
    }

    public static function warrantyRequestedList(){
        return DB::table('service_masters')
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
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id')
            ->where('service_masters.status', 'RW')
            ->orderBy('service_masters.service_id', 'ASC')
            ->get();
    }

    public static function warrantyRequestedListByUser($user_id){
        return DB::table('service_assigns')
            ->join('service_masters', 'service_masters.id', '=', 'service_assigns.service_master')
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
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id')
            ->where('service_masters.status', 'RW')
            ->where('service_assigns.status', 'SA')
            ->where('service_assigns.assigned_to', $user_id)
            ->orderBy('service_masters.service_id', 'ASC')
            ->get();
    }

    public static function warrantySentList(){
        return DB::table('service_masters')
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
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id')
            ->where('service_masters.status', 'SW')
            ->orderBy('service_masters.service_id', 'ASC')
            ->get();
    }

    public static function warrantyReceivedList(){
        return DB::table('service_masters')
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
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id')
            ->where('service_masters.status', 'WR')
            ->orderBy('service_masters.service_id', 'ASC')
            ->get();
    }

    public static function warrantyReceivedListByUser($user_id){
        return DB::table('service_assigns')
            ->join('service_masters', 'service_masters.id', '=', 'service_assigns.service_master')
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
                'service_masters.received_at', 'service_masters.service_id', 'service_masters.contact_no', 'service_masters.status', 'service_masters.id')
            ->where('service_masters.status', 'WR')
            ->where('service_assigns.status', 'SA')
            ->where('service_assigns.assigned_to', $user_id)
            ->orderBy('service_masters.service_id', 'ASC')
            ->get();
    }

    public static function serviceSummaryCount(){
        $data = DB::table('service_masters')
                    ->select(DB::raw('COUNT(id) as service_count'), 'status')
                    ->where('status', '!=', 'D')
                    ->groupBy('status')
                    ->get();

        return $data;
    }

    public static function serviceSummaryCountByUser($user_id){
        $data = DB::table('service_assigns')
            ->join('service_masters', 'service_masters.id', '=', 'service_assigns.service_master')
            ->select(DB::raw('COUNT(service_masters.id) as service_count'), 'service_masters.status')
            ->where('service_masters.status', '!=', 'D')
            ->where('service_assigns.status', 'SA')
            ->where('service_assigns.assigned_to', $user_id)
            ->groupBy('service_masters.status')
            ->get();

        return $data;
    }
}
