<?php

namespace App\Http\Controllers\Issue;

use App\Http\Controllers\Controller;
use App\Model\issueType;
use App\Model\ProductCategory;
use App\Model\ProductDetail;
use App\Model\ProductIssue;
use App\Model\ProductMaster;
use App\Model\ProductSubCategory;
use Illuminate\Http\Request;

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
      //  return $product_issue;

        if($product_issue){
            if($product_issue->status != 'D'){
                $product_category_id = ProductMaster::getCategoryId($product_issue->product_master_id);
                $product_sub_category_id = ProductMaster::getSubCategoryId($product_issue->product_master_id);
                $product_categories = ProductCategory::allProductCategoriesForSelectField();
                $product_sub_categories = ProductSubCategory::getProductSubCatForSelectByProductCategory($product_category_id);
                $product_masters = ProductMaster::getProductMastersForSelectFieldBySubCategoryId($product_sub_category_id);
                $product_details = ProductDetail::allProductDetailForSelectField();
                $issue_types = issueType::getListForSlect();

                return view('issue.old-entry.edit', compact('id','issue_types',
                'product_category_id', 'product_sub_category_id', 'product_categories', 'product_sub_categories',
                'product_masters', 'product_details', ));
            }
        }

        return redirect()->to(route('old.entry'));
    }
}
