<?php

namespace App\Http\Controllers\Issue;

use App\Http\Controllers\Controller;
use App\Model\issueType;
use App\Model\ProductCategory;
use App\Model\ProductDetail;
use App\Model\ProductIssue;
use App\Model\ProductMaster;
use App\Model\Customer;
use App\Model\Factory;
use App\Model\Department;
use App\Model\Designation;
use App\Model\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IssueController extends Controller
{
    public function oldEntry(){
        $issue_types = issueType::getListForSlect();
        return view('issue.old-entry.entry', compact('issue_types'));
    }

    public function oldEntrySave(Request $request){
       // return $request->all();
        return ProductIssue::insertProductIssue($request);
    }

    public function editOldEntry($id){
        $product_issue = ProductIssue::find($id);

        if($product_issue){
            if($product_issue->status != 'D'){

                $factories = Factory::allFactoriesForSelectField();
                $departments = Department::allDepartmentsForSelectField();
                $designations = Designation::allDesignationsForSelectField();
                $product_category_id = ProductMaster::getCategoryId($product_issue->product_master_id);
                $product_sub_category_id = ProductMaster::getSubCategoryId($product_issue->product_master_id);
                $product_categories = ProductCategory::allProductCategoriesForSelectField();
                $product_sub_categories = ProductSubCategory::getProductSubCatForSelectByProductCategory($product_category_id);
                $product_masters = ProductMaster::getProductMastersForSelectFieldBySubCategoryId($product_sub_category_id);
                $product_details = ProductDetail::allProductDetailForSelectField();
                $issue_types = issueType::getListForSlect();


                $customer = DB::table('product_issues')
                        ->join('customers','customers.id', '=', 'product_issues.customer_id')
                        ->select('customers.id', 'customers.employee_id','customers.factory','customers.designation','customers.department','customers.name','customers.email',
                            'customers.mobile_no','customers.ext_no','customers.mobile_no','customers.job_location','customers.status')
                        ->where('customers.id',$product_issue->customer_id)
                        ->get();


                // if($product_issue->product_detail_id !== 0)
                //     {
                //         $product_info = DB::table('product_issues')
                //                 ->join('product_details','product_details.product_master', '=', 'product_issues.id')
                //                 ->join('product_masters','product_masters.id', '=', 'product_issues.product_master_id')
                //                 ->select('product_masters.id','product_masters.name','product_details.sl_no','product_details.purchase_date','product_details.warranty_in_months')
                //                 ->where('product_masters.id',$product_issue->product_detail_id)
                //                 ->get();
                //     }

                // else $product_info = 0;

                return view('issue.old-entry.edit', compact('id','issue_types','product_issue','product_category_id', 'product_sub_category_id',
                 'product_categories', 'product_sub_categories','product_masters', 'product_details','customer','factories','departments','designations'));
            }
        }

        return redirect()->to(route('old.entry'));
    }
}
