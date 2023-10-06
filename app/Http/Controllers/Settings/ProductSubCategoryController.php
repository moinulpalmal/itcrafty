<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Imports\BuyerImports;
use App\Model\ProductSubCategory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductSubCategoryController extends Controller
{
    public function index(){
        //$this->oldData();
        $manufacturers = ProductSubCategory::allNotDeleteProductSubCategories();
        return view('settings.product-sub-category', compact('manufacturers'));
    }

    private function oldData(){
        // for old data
        //return $req->all();
        $collection = Excel::toArray(new BuyerImports(), 'upload/sub-category.xlsx');
        //return $collection;
        //return count($collection[0]);
        for($i = 0; $i < count($collection[0]); $i++ ){
            //return $i++;
            $country = $collection[0][$i];
            //return $country;
            $newBuyer = new ProductSubCategory();
            if($country[0] != "ProdSubCatID"){
                $newBuyer->id = $country[0];
                $newBuyer->product_category = $country[1];
                $newBuyer->name = $country[2];
                $newBuyer->is_split_product = $country[5];
                $newBuyer->status = 'A';

                $newBuyer->save();
            }
            //return $country[0];
        };
        // $this->mapOldData();
    }

    public function save(Request $request){
        //return $request->all();
        if($request->id != null){
            return ProductSubCategory::updateProductSubCategory($request);
        }
        else{
            return ProductSubCategory::insertProductSubCategory($request);
        }
    }

    public function edit(Request $request){
        return ProductSubCategory::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return ProductSubCategory::returnDelete($request->id);
    }

    public function activate(Request $request){
        return ProductSubCategory::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return ProductSubCategory::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        if($request->check == 1){
            $DropDownData = ProductSubCategory::getDropDownList();
            return json_encode($DropDownData);
        }

        return null;
    }

    public function getDropDownListByProductCategory(Request $request){
        if($request->category_id){
            $DropDownData = ProductSubCategory::getDropDownListByProductCategory($request->category_id);
            return json_encode($DropDownData);
        }

        return null;
    }
}
