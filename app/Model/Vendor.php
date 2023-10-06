<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Vendor extends Model
{
    public static function allActiveVendors(){
        return Vendor::where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allVendorsForSelectField(){
        return DB::table('vendors')
            ->select('id', 'name', 'status')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }
    public static function allVendors(){
        return  Vendor::all();
    }

    public static function allNotDeleteVendors(){
        return  Vendor::where('status', '!=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allDeletedVendors(){
        return  Vendor::where('status', '=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function insertVendor($request){
        $model = new Vendor();
        $model->name = $request->name;
        $model->address = $request->address;
        $model->contact_no = $request->contact_no;
        $model->email = $request->email;
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateVendor($request){
        $model = Vendor::find($request->id);
        if($model != null){
            $model->name = $request->name;
            $model->address = $request->address;
            $model->contact_no = $request->contact_no;
            $model->email = $request->email;
            $model->last_updated_by = Auth::id();

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){
        $model = Vendor::find($id);
        if($model != null){
            $data = array(
                'name' => $model->name,
                'address' => $model->address,
                'contact_no' => $model->contact_no,
                'email' => $model->email,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDelete($id){
        $model = Vendor::find($id);
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
        $model = Vendor::find($id);

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
        $model = Vendor::find($id);
        if($model != null){
            $model->status = 'I';
            if($model->save()){
                return '1';
            }
            return '0';
        }
        return '0';
    }

    public static function getDropDownList(){
        return DB::table('vendors')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function getVendorName($id){
        return Vendor::find($id)->name;
    }


}
