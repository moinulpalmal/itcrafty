<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        }else{
            $result = Customer::updateCustomerById($request);
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

    public static function allNotDeletedProductIssues(){
        return DB::table('product_issues')
            ->leftJoin('product_detail_id', 'product_details.id', '=', 'product_issues.product_detail_id')
            ->leftJoin('product_master_id', 'product_masters.id', '=', 'product_issues.product_master_id')
            ->leftJoin('product_categories', 'product_categories.id', '=', 'product_masters.product_sub_category_id')
            ->leftJoin('product_sub_categories', 'product_sub_categories.id', '=', 'product_categories.product_category_id')
            ->leftJoin('customers', 'customers.id', '=', 'product_issues.customer_id')
            ->leftJoin('issue_types', 'product_masters.id', '=', 'product_issues.issue_type_id')
           // ->leftJoin('issued_by', 'issued_bys.id', '=', 'product_issues.issued_by')
            ->leftJoin('requisition_id', 'requisitions.id', '=', 'product_issues.requisition_id')
            ->select('product_issues.id', 'product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category',
            '')
            ->where('product_issues.status', '!=', 'D')
            ->get();
    }
}
