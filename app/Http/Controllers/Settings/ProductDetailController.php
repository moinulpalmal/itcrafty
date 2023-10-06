<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Imports\BuyerImports;
use App\Model\ProductDetail;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductDetailController extends Controller
{
    public function index(){
        //$this->oldData();
        //return Manufacturer::returnId("HP");

        $products = ProductDetail::allNotDeleteProductDetail();
        return view('settings.product-detail', compact('products'));
    }
    private function oldData(){
        // for old data
        //return $req->all();
        $collection = Excel::toArray(new BuyerImports(), 'upload/laptop.xlsx');
        //return $collection;
        //return count($collection[0]);
        for($i = 0; $i < count($collection[0]); $i++ ){
            //return $i++;
            $country = $collection[0][$i];
            //return $country;
            $newBuyer = new ProductDetail();
            if($country[0] != "ID"){
               // $newBuyer->id = $country[0];
                $newBuyer->old_name = $country[1];
                $newBuyer->sl_no = $country[2];
                $newBuyer->old_vendor = $country[3];
                $newBuyer->old_purchase_date = $country[4];
                $newBuyer->status = 'A';
                $newBuyer->purchase_date =  Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($country[4]));
                $newBuyer->save();
            }
            //return $country[0];
        };

        // $this->mapOldData();
    }

    public function getWarrantyDetail(Request $request){
        $data = ProductDetail::returnForWarranty($request);

        return $data;
       return json_encode($data);
    }
}
