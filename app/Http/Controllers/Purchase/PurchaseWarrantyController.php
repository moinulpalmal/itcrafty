<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Model\Requisition;
use App\Model\ServiceAssign;
use App\Model\ServiceHistory;
use App\Model\ServiceMaster;
use App\Model\ServiceRequest;
use App\Model\ServiceRequestEmail;
use App\Model\ServiceWarranty;
use App\Model\ServiceWarrantyCheck;
use App\Model\Vendor;
use App\User;
use App\View_Model\EmailList;
use Illuminate\Http\Request;

class PurchaseWarrantyController extends Controller
{
    public function warrantyRequestedFromService(){
        //$products = ServiceWarranty::warrantyRequestedList();


        $products = ServiceWarrantyCheck::getWarrantyRequestedList(1000);
        //return $products;

        return view('purchase.warranty.service-requested', compact('products'));
    }

    public function generateWarrantyRequest(Request $request){
        return ServiceWarranty::insertIntoServiceWarranty($request);
    }

    public function rejectNoWarranty(Request $request){
       return ServiceWarrantyCheck::rejectNoWarranty($request);
    }

    public function invalidProduct(Request $request){
        return ServiceWarrantyCheck::invalidProduct($request);
    }

    public function warrantyVoid(Request $request){
        return ServiceWarrantyCheck::warrantyVoid($request);
    }

    public function warrantyRequested(){
        //$products = ServiceWarranty::warrantyRequestedList();
        $products = ServiceWarranty::warrantyGeneratedRequestedList();

        return view('purchase.warranty.requested', compact('products'));
    }

    public function warrantySentMail(){
        $products = ServiceWarranty::warrantyRequestSentToVendorList();

        return view('purchase.warranty.mail-sent', compact('products'));
    }

    public function productSent(){
        $products = ServiceWarranty::warrantyProductSentToVendorList();

        return view('purchase.warranty.product-sent', compact('products'));
    }

    public function receivedFromVendor(){
        $products = ServiceWarranty::receivedFromVendorForWarranty();

        return view('purchase.warranty.product-sent', compact('products'));
    }

    public function sentToService(){
        $products = ServiceWarranty::warrantySentToServiceList(1000);

        return view('purchase.warranty.product-sent-service', compact('products'));
    }

    public function canceled(){
        $products = ServiceWarranty::warrantyCanceledList(1000);

        return view('purchase.warranty.canceled', compact('products'));
    }

    public function detail($id){
        //return $id;
        $service_warranty = ServiceWarranty::find($id);
        if($service_warranty == null){
            return redirect()->to(route('purchase.warranty.requested'));
        }
        //return $service_warranty;
        if($service_warranty->status != 'D'){
            //return EmailList::getEmailList();
            $users = User::getUserListForSelect();
            $service_assigns = ServiceAssign::getAssignmentDetails($service_warranty->service_master);
            $service_histories = ServiceHistory::getServiceHistories($service_warranty->service_master);
            //return $service_histories;
            $vendors = Vendor::allVendorsForSelectField();
            // return $service_histories;
            $service_master = ServiceMaster::serviceMasterDetails($service_warranty->service_master);
            $service_warranty_check = ServiceWarrantyCheck::serviceWarrantyDetails($service_warranty->service_warranty_check);
            $email_list = EmailList::getEmailList(array("u", "v", "ft", $service_master->service_id));
            $service_requests = ServiceRequest::getServiceRequestsByServiceMaster($service_warranty->service_master);
            $requisition = Requisition::getRequisitionByServiceMaster($service_warranty->service_master);
            $service_request_emails = ServiceRequestEmail::getEmailList($id);
            //service mails list la-gbe
            $service_master_histories = null;
            if ($service_master->product_detail != null) {
                $service_master_histories = ServiceMaster::getServiceMastersByProductDetail($service_warranty_check->product_detail);
            }

            if ($service_warranty != null) {
                return view('purchase.warranty.detail', compact('service_warranty','service_master', 'users', 'vendors',
                    'service_assigns', 'service_histories', 'service_master_histories', 'service_requests',
                    'email_list', 'requisition', 'service_request_emails', 'service_warranty_check'));
            };
            return redirect()->to(route('purchase.warranty.requested'));
        }

        return redirect()->to(route('purchase.warranty.requested'));
    }

    public function assignVendor(Request $request){
        return ServiceWarranty::assignVendor($request);
    }

    public function sendWarrantyRequest(Request $request){
        return ServiceWarranty::sendWarrantyMail($request);
    }

    //
    public function sendProductForWarranty(Request $request){
        return ServiceWarranty::deliverToVendorForWarranty($request);
    }

    public function receiveProductFromWarranty(Request $request){
        return ServiceWarranty::receivedFromVendorForWarranty($request);
    }

    public function sendProductToService(Request $request){
        return ServiceWarranty::deliverWarrantyProduct($request);
    }

    public function cancelWarrantyRequest(Request $request){
        return ServiceWarranty::cancelWarrantyRequest($request);
    }


}
