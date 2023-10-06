<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Imports\BuyerImports;
use App\Model\Vendor;
use App\Model\VendorPerson;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductVendorPersonController extends Controller
{
    public function index(){
        //$this->oldData();
        $vendors = Vendor::allVendorsForSelectField();
        $vendor_people = VendorPerson::allNotDeleteVendorPerson();
        return view('settings.vendor-person', compact('vendor_people', 'vendors'));
    }

    private function oldData(){
        // for old data
        //return $req->all();
        $collection = Excel::toArray(new BuyerImports(), 'upload/vendor_person.xlsx');
        //return $collection;
        //return count($collection[0]);
        for($i = 0; $i < count($collection[0]); $i++ ){
            //return $i++;
            $country = $collection[0][$i];
            //return $country;
            $newBuyer = new VendorPerson();
            if($country[0] != "ID"){
                $newBuyer->id = $country[0];
                $newBuyer->vendor = $country[1];
                $newBuyer->name = $country[2];
                if($country[2] != "NULL"){
                    $newBuyer->designation = $country[3];
                }
                if($country[3] != "NULL"){
                    $newBuyer->contact_no = $country[4];
                }

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
            return VendorPerson::updateVendorPerson($request);
        }
        else{
            return VendorPerson::insertVendorPerson($request);
        }
    }

    public function edit(Request $request){
        return VendorPerson::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return VendorPerson::returnDelete($request->id);
    }

    public function activate(Request $request){
        return VendorPerson::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return VendorPerson::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        if($request->check == 1){
            $DropDownData = VendorPerson::getDropDownList();
            return json_encode($DropDownData);
        }

        return null;
    }
}
