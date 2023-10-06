<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Factory extends Model
{
    public static function allActiveFactories(){
        return Factory::where('status', '=', 'A')
                        ->orderBy('factory_name', 'ASC')
                        ->orderBy('unit_name', 'ASC')
                        ->get();
    }


    public static function allFactories(){
        return  Factory::all();
    }

    public static function allNotDeleteFactories(){
        return  Factory::where('status', '!=', 'D')
            ->orderBy('factory_name', 'ASC')
            ->orderBy('unit_name', 'ASC')
            ->get();
    }

    public static function allDeletedFactories(){
        return  Factory::where('status', '=', 'D')
            ->orderBy('factory_name', 'ASC')
            ->orderBy('unit_name', 'ASC')
            ->get();
    }

    public static function insertFactory($request){
        $model = new Factory();
        $model->factory_name = $request->factory_name;
        $model->factory_short_name = $request->factory_short_name;
        $model->unit_name = $request->unit_name;
        $model->unit_short_name = $request->unit_short_name;
        $model->inserted_by = Auth::id();
        if($request->department_applicable == 'on'){
            $model->department_applicable = true;
        }
        else{
            $model->department_applicable = false;
        }

        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateFactory($request){
        $model = Factory::find($request->id);
        if($model != null){
            $model->factory_name = $request->factory_name;
            $model->factory_short_name = $request->factory_short_name;
            $model->unit_name = $request->unit_name;
            $model->unit_short_name = $request->unit_short_name;
            $model->last_updated_by = Auth::id();
            if($request->department_applicable == 'on'){
                $model->department_applicable = true;
            }
            else{
                $model->department_applicable = false;
            }

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){
        $model = Factory::find($id);
        if($model != null){
            $data = array(
                'factory_name' => $model->factory_name,
                'factory_short_name' => $model->factory_short_name,
                'unit_name' => $model->unit_name,
                'unit_short_name' => $model->unit_short_name,
                'department_applicable' => $model->department_applicable,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDelete($id){
        $model = Factory::find($id);

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
        $model = Factory::find($id);

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
        $model = Factory::find($id);
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
        return DB::table('factories')
                    ->select('id', DB::raw('CONCAT(factory_name, " - ", IFNULL(unit_name, " ")) AS name'))
                    ->where('status', '=', 'A')
                    ->orderBy('factory_name', 'ASC')
                    ->orderBy('unit_name', 'ASC')
                    ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function allFactoriesForSelectField(){
        return DB::table('factories')
            ->select('id', DB::raw('CONCAT(factory_name, " - ", IFNULL(unit_name, " ")) AS name'))
            ->where('status', '=', 'A')
            ->orderBy('factory_name', 'ASC')
            ->orderBy('unit_name', 'ASC')
            ->get();
    }
}
