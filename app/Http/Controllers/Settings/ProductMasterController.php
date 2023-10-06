<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Imports\BuyerImports;
use App\Model\ProductMaster;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductMasterController extends Controller
{
    public function index(){
        //$this->oldData();
        $products = ProductMaster::allNotDeleteProductMaster();
        return view('settings.product-master', compact('products'));
    }
    private function oldData(){
        // for old data
        //return $req->all();
        $collection = Excel::toArray(new BuyerImports(), 'upload/product_master.xlsx');
        //return $collection;
        //return count($collection[0]);
        for($i = 0; $i < count($collection[0]); $i++ ){
            //return $i++;
            $country = $collection[0][$i];
            //return $country;
            $newBuyer = new ProductMaster();
            if($country[0] != "ID"){
                $newBuyer->id = $country[0];
                $newBuyer->name = $country[1];
                $newBuyer->product_category = $country[4];
                $newBuyer->product_sub_category = $country[3];
                $newBuyer->manufacturer = $country[2];
                $newBuyer->description = $country[5];
                if($country[6] == 'Y'){
                    $newBuyer->has_warranty = true;
                }
                else{
                    $newBuyer->has_warranty = false;
                }

                if($country[8] == 'Y'){
                    $newBuyer->has_sl_no = true;
                }
                else{
                    $newBuyer->has_sl_no = false;
                }
                $newBuyer->warranty_in_months = $country[7];
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
            return ProductMaster::updateProductMaster($request);
        }
        else{
            return ProductMaster::insertProductMaster($request);
        }
    }

    public function edit(Request $request){
        return ProductMaster::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return ProductMaster::returnDelete($request->id);
    }

    public function activate(Request $request){
        return ProductMaster::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return ProductMaster::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        return ProductMaster::getDropDownList($request->category, $request->sub_category);
    }
}
