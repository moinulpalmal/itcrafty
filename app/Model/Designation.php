<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Designation extends Model
{
    public static function allActiveDesignations(){
        return Designation::where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allDesignationsForSelectField(){
        return DB::table('designations')
            ->select('id', 'name', 'status')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }
    public static function allDesignations(){
        return  Designation::all();
    }

    public static function allNotDeleteDesignations(){
        return  Designation::where('status', '!=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allDeletedDesignations(){
        return  Designation::where('status', '=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function insertDesignation($request){
        $model = new Designation();
        $model->name = $request->name;
        $model->short_form = $request->short_form;
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateDesignation($request){
        $model = Designation::find($request->id);
        if($model != null){
            $model->name = $request->name;
            $model->short_form = $request->short_form;
            $model->last_updated_by = Auth::id();

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){
        $model = Designation::find($id);
        if($model != null){
            $data = array(
                'name' => $model->name,
                'short_form' => $model->short_form,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDelete($id){
        $model = Designation::find($id);

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
        $model = Designation::find($id);

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
        $model = Designation::find($id);
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
        return DB::table('designations')
            ->select('id', DB::raw('CONCAT(name, " ( ", IFNULL(short_form, " "), " ) ") AS name'))
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function returnIDByName($name){
        $data =  DB::table('designations')
            ->select('id')
            ->where('name', '=', $name)
            ->orderBy('name', 'ASC')
            ->get();

        if($data->count() > 0){
            return $data[0]->id;
        }
        return 0;

    }
}
