<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Mail\SendMacBindingRequest;
use App\Mail\SendRequisitionRequest;
use App\Mail\SendServiceComplete;
use App\Model\Customer;
use App\Model\Department;
use App\Model\Factory;
use App\Model\ProductCategory;
use App\Model\ProductMaster;
use App\Model\ProductSubCategory;
use App\Model\Requisition;
use App\Model\ServiceAssign;
use App\Model\ServiceHistory;
use App\Model\ServiceMaster;
use App\Model\ServiceRequest;
use App\Model\ServiceRequestEmail;
use App\Model\ServiceRequestEmailFrom;
use App\Model\ServiceRequestEmailTo;
use App\Model\ServiceWarranty;
use App\Model\ServiceWarrantyCheck;
use App\User;
use App\View_Model\EmailList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ServiceMasterController extends Controller
{
    public function new()
    {
        if(Auth::user()->hasTaskPermission('service_receive_desk', Auth::id())){
            $users = User::getUserListForSelect();

            return view('services.master.new', compact('users'));
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        //return ServiceMaster::all()->last();
        if(Auth::user()->hasTaskPermission('service_team_leader', Auth::id())){
            $service_master = ServiceMaster::find($id);
            if($service_master != null){
                if($service_master->status != 'D'){
                    $users = User::getUserListForSelect();
                    $factories = Factory::allFactoriesForSelectField();
                    $departments = Department::allDepartmentsForSelectField();
                    $product_categories = ProductCategory::allProductCategoriesForSelectField();
                    $product_master = ProductMaster::find($service_master->product_master);
                    $product_sub_categories = ProductSubCategory::getProductSubCatForSelectByProductCategory($product_master->product_category);
                    $customer = Customer::find($service_master->customer);
                    $customer_list = Customer::getDropDownListSelect($customer->factory, $customer->department);
                    $product_master_list = ProductMaster::getDropDownListSelect($product_master->product_category, $product_master->product_sub_category);
                    return view('services.master.edit', compact('service_master', 'users', 'factories', 'departments',
                        'product_categories', 'product_sub_categories', 'customer', 'customer_list', 'product_master_list', 'product_master'));
                }
            }

            return redirect()->to(route('services.master.queue'));
        }
        return redirect()->back();
    }

    public function save(Request $request)
    {
        //return $request->all();
        return ServiceMaster::insertProductMaster($request);
    }

    public function update(Request $request)
    {
        //return $request->all();
        return ServiceMaster::updateProductMaster($request);
    }

    public function assign(Request $request)
    {
        //return $request->all();
        return ServiceAssign::insert($request);
    }

    public function makeUnderProcess(Request $request)
    {
        //return $request->all();
        return ServiceMaster::makeUnderProcess($request->id);
    }

    public function queue()
    {

        $products = ServiceMaster::queueList();
        return view('services.master.queue', compact('products'));
    }

    public function assigned()
    {
        if(Auth::user()->hasTaskPermission('service_team_leader', Auth::id())){
            $products = ServiceMaster::assignedList();
        }
        else{
            $products = ServiceMaster::assignedListByUser( Auth::id());
        }

        //$products = ServiceMaster::queueList();
        return view('services.master.assigned', compact('products'));
    }

    public function underProcess()
    {
        // $products = ServiceMaster::assignedList();
        if(Auth::user()->hasTaskPermission('service_team_leader', Auth::id())){
            $products = ServiceMaster::underProcessList();
        }
        else{
            $products = ServiceMaster::underProcessListByUser( Auth::id());
        }

        return view('services.master.under-process', compact('products'));
    }

    public function solved(){
        $products = ServiceMaster::serviceCompleteList();
        return view('services.master.solved', compact('products'));
    }

    public function solvedApproved(){
        $products = ServiceMaster::serviceCompleteApprovedList();
        return view('services.master.solved-approved', compact('products'));
    }

    public function delivered(){
        //return 10;
        $products = ServiceMaster::deliveryCompleteList(1000);

        //return $products;
        return view('services.master.delivered', compact('products'));
    }

    public function warrantyRequested(){
        if(Auth::user()->hasTaskPermission('service_team_leader', Auth::id())){
            $products = ServiceMaster::warrantyRequestedList();
        }
        else{
            $products = ServiceMaster::warrantyRequestedListByUser(Auth::id());
        }


        //return $products;
        return view('services.master.warranty-requested', compact('products'));
    }

    public function warrantyReceived(){
        if(Auth::user()->hasTaskPermission('service_team_leader', Auth::id())){
            $products = ServiceMaster::warrantyReceivedList();
        }
        else{
            $products = ServiceMaster::warrantyReceivedListByUser(Auth::id());
        }


        //return $products;
        return view('services.master.warranty-received', compact('products'));
    }

    public function detail($id)
    {

        //return EmailList::getEmailList();
        //check access
        //return ServiceAssign::isAssigned(Auth::id(), $id);
       // return User::getUserEmailListByTask("service_team_leader");
        $has_access = false;
        if(Auth::user()->hasTaskPermission('service_team_leader', Auth::id())){
            $has_access = true;
        }
        else{
            $has_access = ServiceAssign::assignmentCheck(Auth::id(), $id);
        }
        if($has_access){
            $users = User::getUserListForSelect();
            $email_list = EmailList::getEmailList(array("u", "ft", $id));
            $service_assigns = ServiceAssign::getAssignmentDetails($id);
            $service_histories = ServiceHistory::getServiceHistories($id);

            // return $service_histories;
            $service_master = ServiceMaster::serviceMasterDetails($id);
            $service_requests = ServiceRequest::getServiceRequestsByServiceMaster($id);
            $requisition = Requisition::getRequisitionByServiceMaster($id);
            $service_request_emails = ServiceRequestEmail::getEmailList($id);
            $service_warranty_checks = ServiceWarrantyCheck::getServiceWarrantyChecks($id);
            //service mails list lagbe
            $service_master_histories = null;
            //return $service_master;
           // return $service_master->product_detail;
            if ($service_master != null) {
                if ($service_master->product_detail != null) {
                    $service_master_histories = ServiceMaster::getServiceMastersByProductDetail($service_master->product_detail);
                }
            }
            if ($service_master != null) {
                return view('services.master.detail', compact('service_master', 'users',
                    'service_assigns', 'service_histories', 'service_master_histories', 'service_requests',
                    'email_list', 'requisition', 'service_request_emails', 'service_warranty_checks'));
            }
        }
        else{
            return redirect()->to(route('services.master.queue'));
        }
        return redirect()->to(route('services.master.queue'));
    }
    public function sendRequisitionRequest(Request $request)
    {

        $result = Mail::to($request->to_email)->cc($request->to_cc_email)->send(new SendRequisitionRequest($request->requisition_email_description));
        $user_email = User::find(Auth::id())->email;
       if($result == null){
           $service_master = ServiceMaster::find($request->service_master);
           $service_master->has_requisition_request = true;
           $service_master->last_updated_by = Auth::id();
           $service_master->save();

           //insert into service email requests
           $req_result = ServiceRequestEmail::insert($request);

           //insert into service emails
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
           $history = ServiceHistory::insert($service_master->id, "New Requisition Request Sent Through Email");
            return '1';
       }

       return $result;
    }

    public function addRequisitionInfo(Request $request){
        if($request->id == null){
            return Requisition::insert($request);
        }
        else{
            return Requisition::updateRequisition($request);
        }
    }

    public function rejectRequisitionProduct(Request $request){
        return Requisition::rejectProduct($request);
    }

    public function deleteRequisitionInfo(Request $request){
       return Requisition::deleteRequisition($request);
    }

    public function addPurchaseCommentRequisitionInfo(Request $request){
        return Requisition::updateRequisitionPurchase($request);
    }

    public function serviceComplete(Request $request){
        //return $request->all();
        //update service master
        return ServiceMaster::serviceComplete($request);
        //add service history
    }

    public function approveComplete(Request $request){
        //return $request->all();
        //update service master
        return ServiceMaster::serviceApproved($request);
        //add service history
    }

    public function serviceCompleteMail(Request $request){
        //return $request->all();
        $result = Mail::to($request->to_email)->cc($request->to_cc_email)->send(new SendServiceComplete($request->service_email_description));
        $user_email = User::find(Auth::id())->email;
        if($result == null){
            $service_master = ServiceMaster::find($request->service_master);
           // $service_master->has_requisition_request = true;
           // $service_master->last_updated_by = Auth::id();
            //$service_master->save();

            //insert into service email requests
            $req_result = ServiceRequestEmail::insert($request);

            //insert into service emails
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
            $history = ServiceHistory::insert($service_master->id, "Service Complete Mail Sent!");
            return '1';
        }
        return $result;
    }

    public function macBindingMail(Request $request){
        //return $request->all();
        $result = Mail::to($request->to_email)->cc($request->to_cc_email)->send(new SendMacBindingRequest($request->mac_binding_email_description));
        $user_email = User::find(Auth::id())->email;
        if($result == null){
            $service_master = ServiceMaster::find($request->service_master);
            $service_master->is_mac_binding_mail_sent = true;
            $service_master->last_updated_by = Auth::id();
            $service_master->save();

            //insert into service email requests
            $req_result = ServiceRequestEmail::insert($request);

            //insert into service emails
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
            $history = ServiceHistory::insert($service_master->id, "MAC Binding Request Mail Sent!");
            return '1';
        }
        return $result;
    }

    public function deliveryComplete(Request $request){
        return ServiceMaster::deliveryComplete($request->id);
    }

    public function generateWarrantyRequest(Request $request){
        return ServiceWarranty::insertIntoServiceWarranty($request);
    }

    public function sendWarrantyRequest(Request $request){
        //return $request->all();

        return ServiceWarrantyCheck::insertIntoServiceWarrantyCheck($request);
    }

    public function proceedWithoutWarranty(Request $request){
        return ServiceWarranty::proceedWithoutWarranty($request);
    }



    public function receiveFromWarranty(Request $request){
       // return ServiceWarranty::insertIntoServiceWarranty($request);
    }

    public function delete(Request $request)
    {
        //return $request->all();
        return ServiceMaster::deleteMaster($request->id);
    }

}
