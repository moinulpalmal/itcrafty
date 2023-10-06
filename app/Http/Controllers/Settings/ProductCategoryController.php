<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Imports\BuyerImports;
use App\Model\ProductCategory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductCategoryController extends Controller
{
    public function index(){
        //$this->oldData();
        $manufacturers = ProductCategory::allNotDeleteProductCategories();
        return view('settings.product-category', compact('manufacturers'));
    }

    private function oldData(){
        // for old data
        //return $req->all();
        $collection = Excel::toArray(new BuyerImports(), 'upload/category.xlsx');
        //return $collection;
        //return count($collection[0]);
        for($i = 0; $i < count($collection[0]); $i++ ){
            //return $i++;
            $country = $collection[0][$i];
            //return $country;
            $newBuyer = new ProductCategory();
            if($country[0] != "ProdCatID"){
                $newBuyer->id = $country[0];
                $newBuyer->name = $country[1];
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
            return ProductCategory::updateProductCategory($request);
        }
        else{
            return ProductCategory::insertProductCategory($request);
        }
    }

    public function edit(Request $request){
        return ProductCategory::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return ProductCategory::returnDelete($request->id);
    }

    public function activate(Request $request){
        return ProductCategory::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return ProductCategory::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        if($request->check == 1){
            $DropDownData = ProductCategory::getDropDownList();
            return json_encode($DropDownData);
        }

        return null;
    }
}
