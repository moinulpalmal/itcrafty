<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Manufacturer extends Model
{
    public static function allActiveManufacturers(){
        return Manufacturer::where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allManufacturersForSelectField(){
        return DB::table('manufacturers')
            ->select('id', 'name', 'status')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }
    public static function allManufacturers(){
        return  Manufacturer::all();
    }

    public static function allNotDeleteManufacturers(){
        return  Manufacturer::where('status', '!=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allDeletedManufacturers(){
        return  Manufacturer::where('status', '=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function insertManufacturer($request){
        $model = new Manufacturer();
        $model->name = $request->name;
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateManufacturer($request){
        $model = Manufacturer::find($request->id);
        if($model != null){
            $model->name = $request->name;
            $model->last_updated_by = Auth::id();

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){
        $model = Manufacturer::find($id);
        if($model != null){
            $data = array(
                'name' => $model->name,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDelete($id){
        $model = Manufacturer::find($id);

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
        $model = Manufacturer::find($id);

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
        $model = Manufacturer::find($id);
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
        return DB::table('manufacturers')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function returnId($name){
      $data =  DB::table('manufacturers')
            ->select('id')
            ->where('name',  (string)$name)
            ->get();
      foreach ($data AS $value){
          return $value->id;
      }
      //return $data[0];
    }
}
