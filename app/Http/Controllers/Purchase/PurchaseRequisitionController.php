<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Model\Requisition;
use Illuminate\Http\Request;

class PurchaseRequisitionController extends Controller
{
    public function warrantyRequestedFromService(){
        //$products = ServiceWarranty::warrantyRequestedList();


        $products = Requisition::getInsertedRequisitionList();
        //return $products;

        return view('purchase.requisition.service-requested', compact('products'));
    }

    public function cancelRequisition(Request $request){
        return Requisition::cancelRequisition($request);
    }

    public function receiveProduct(Request $request){
        return Requisition::receiveProduct($request);
    }
}
