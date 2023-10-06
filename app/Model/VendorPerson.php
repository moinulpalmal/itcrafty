<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendorPerson extends Model
{
    public static function allActiveVendorPerson(){
        return DB::table('vendor_people')
            ->leftjoin('vendors', 'vendors.id', '=', 'vendor_people.vendor')
            ->select('vendor_people.id', 'vendor_people.name', 'vendor_people.status',
                'vendor_people.designation', 'vendor_people.contact_no',
                'vendors.name AS vendor', 'vendor_people.email')
            ->where('vendor_people.status', '=', 'A')
            ->orderBy('vendors.name', 'ASC')
            ->orderBy('vendor_people.name', 'ASC')
            ->get();
    }

    public static function allVendorPersonForSelectField(){
        return DB::table('vendor_people')
            ->leftjoin('vendors', 'vendors.id', '=', 'vendor_people.vendor')
            ->select('vendor_people.id', 'vendor_people.name', 'vendor_people.status',
                'vendor_people.designation', 'vendor_people.contact_no',
                'vendors.name AS vendor', 'vendor_people.email')
            ->where('vendor_people.status', '=', 'A')
            ->orderBy('vendors.name', 'ASC')
            ->orderBy('vendor_people.name', 'ASC')
            ->get();
    }
    public static function allVendorPerson(){
        return DB::table('vendor_people')
            ->leftjoin('vendors', 'vendors.id', '=', 'vendor_people.vendor')
            ->select('vendor_people.id', 'vendor_people.name', 'vendor_people.status',
                'vendor_people.designation', 'vendor_people.contact_no',
                'vendors.name AS vendor', 'vendor_people.email')
            ->orderBy('vendors.name', 'ASC')
            ->orderBy('vendor_people.name', 'ASC')
            ->get();
    }

    public static function allNotDeleteVendorPerson(){
        return DB::table('vendor_people')
            ->leftjoin('vendors', 'vendors.id', '=', 'vendor_people.vendor')
            ->select('vendor_people.id', 'vendor_people.name', 'vendor_people.status',
                'vendor_people.designation', 'vendor_people.contact_no',
                'vendors.name AS vendor', 'vendor_people.email')
            ->where('vendor_people.status', '!=', 'D')
            ->orderBy('vendors.name', 'ASC')
            ->orderBy('vendor_people.name', 'ASC')
            ->get();
    }

    public static function allDeletedVendorPerson(){
        return DB::table('vendor_people')
            ->leftjoin('vendors', 'vendors.id', '=', 'vendor_people.vendor')
            ->select('vendor_people.id', 'vendor_people.name', 'vendor_people.status',
                'vendor_people.designation', 'vendor_people.contact_no',
                'vendors.name AS vendor', 'vendor_people.email')
            ->where('vendor_people.status', '=', 'D')
            ->orderBy('vendors.name', 'ASC')
            ->orderBy('vendor_people.name', 'ASC')
            ->get();
    }

    public static function insertVendorPerson($request){
        $model = new VendorPerson();
        $model->vendor = $request->vendor;
        $model->name = $request->name;
        $model->designation = $request->designation;
        $model->contact_no = $request->contact_no;
        $model->email = $request->email;
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateVendorPerson($request){
        $model = VendorPerson::find($request->id);
        if($model != null){
            $model->name = $request->name;
            $model->vendor = $request->vendor;
            $model->designation = $request->designation;
            $model->contact_no = $request->contact_no;
            $model->last_updated_by = Auth::id();
            $model->email = $request->email;

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){
        $model = VendorPerson::find($id);
        if($model != null){
            $data = array(
                'name' => $model->name,
                'vendor' => $model->vendor,
                'contact_no' => $model->contact_no,
                'designation' => $model->designation,
                'email' => $model->email,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDelete($id){
        $model = VendorPerson::find($id);

        if($model != null){
            $model->status = 'D';
            if($model->save()){
                return '1';
            }

            return '0';
        }
        return '0';
    }

    public static function returnActivate($id){
        $model = VendorPerson::find($id);

        if($model != null){
            $model->status = 'A';
            if($model->save()){
                return '1';
            }
            return '0';
        }
        return '0';
    }

    public static function returnDeActivate($id){
        $model = VendorPerson::find($id);
        if($model != null){
            $model->status = 'I';
            if($model->save()){
                return '1';
            }
            return '0';
        }
        return '0';
    }

    public static function getDropDownListByVendor($vendor){
        return DB::table('vendor_people')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->where('vendor', '=', $vendor)
            ->orderBy('name', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function getDropDownList(){
        return DB::table('vendor_people')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }
}
