<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProductIssue extends Model
{
    public static function insertProductIssue($request){
        $customer_id = $request->customer_id;
        $product_detail_id = 0;
        //return $customer_id;
        //$requisition_id = 0;
        if(is_null($customer_id)){
            $customer_id = Customer::returnCustomerId(trim($request->employee_id));
            if($customer_id == '-1'){
                $result = Customer::insertCustomer($request);
            }
            $customer_id = Customer::returnCustomerId(trim($request->employee_id));
        }

       // return $request->all();

        if(is_null($request->serial_no)){

            $product_issue = new ProductIssue();
            $product_issue->product_master_id = $request->product_master;
            $product_issue->product_detail_id = $product_detail_id;
            $product_issue->customer_id = $customer_id;
            $product_issue->issue_type_id = $request->issue_type;
            $product_issue->issue_date = $request->issue_date;
            $product_issue->issue_description = $request->issue_description;
            $product_issue->reference_no = $request->requisition_no;
            $product_issue->remarks = $request->remarks;
            $product_issue->inserted_by = Auth::id();
            if($product_issue->save()){
                return '1';
            }

            return '0';
        }else{
          //  return $request->all();
            $product_detail_id = ProductDetail::insertProductDetailOld($request);
            $product_issue = new ProductIssue();
            $product_issue->product_master_id = $request->product_master;
            $product_issue->product_detail_id = $product_detail_id;
            $product_issue->customer_id = $customer_id;
            $product_issue->issue_type_id = $request->issue_type;
            $product_issue->issue_date = $request->issue_date;
            $product_issue->issue_description = $request->issue_description;
            $product_issue->reference_no = $request->requisition_no;
            $product_issue->remarks = $request->remarks;
            $product_issue->inserted_by = Auth::id();

            if($product_issue->save()){
                return '1';
            }

            return '0';
        }


        return '0';

    }
}
