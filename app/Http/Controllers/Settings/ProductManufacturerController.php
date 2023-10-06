<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Imports\BuyerImports;
use App\Model\Manufacturer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductManufacturerController extends Controller
{
    public function index(){
        //$this->oldData();
        $manufacturers = Manufacturer::allNotDeleteManufacturers();
        return view('settings.manufacturer', compact('manufacturers'));
    }

    private function oldData(){
        // for old data
        //return $req->all();
        $collection = Excel::toArray(new BuyerImports(), 'upload/manufacturer.xlsx');
        //return $collection;
        //return count($collection[0]);
        for($i = 0; $i < count($collection[0]); $i++ ){
            //return $i++;
            $country = $collection[0][$i];
            //return $country;
            $newBuyer = new Manufacturer();
            if($country[0] != "ManufacID"){
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
            return Manufacturer::updateManufacturer($request);
        }
        else{
            return Manufacturer::insertManufacturer($request);
        }
    }

    public function edit(Request $request){
        return Manufacturer::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return Manufacturer::returnDelete($request->id);
    }

    public function activate(Request $request){
        return Manufacturer::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return Manufacturer::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        if($request->check == 1){
            $DropDownData = Manufacturer::getDropDownList();
            return json_encode($DropDownData);
        }

        return null;
    }
}
