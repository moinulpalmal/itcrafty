<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FactoryIt extends Model
{
    public static function allActiveFactoryIts(){

        return DB::table('factory_its')
            ->join('designations', 'designations.id', '=', 'factory_its.designation')
            ->join('factories', 'factories.id', '=', 'factory_its.factory')
            ->select('factory_its.id', 'factory_its.name', 'factory_its.email', 'factory_its.mobile_no', 'factory_its.status',
                    'designations.name AS designation', 'factories.factory_name AS factory')
            ->where('factory_its.status', '=', 'A')
            ->orderBy('factories.factory_name', 'ASC')
            ->orderBy('factory_its.name', 'ASC')
            ->get();
    }

    public static function allNotDeleteFactoryIts(){

        return DB::table('factory_its')
            ->join('designations', 'designations.id', '=', 'factory_its.designation')
            ->join('factories', 'factories.id', '=', 'factory_its.factory')
            ->select('factory_its.id', 'factory_its.name', 'factory_its.email', 'factory_its.mobile_no', 'factory_its.status',
                'designations.name AS designation', 'factories.factory_name AS factory')
            ->where('factory_its.status', '!=', 'D')
            ->orderBy('factories.factory_name', 'ASC')
            ->orderBy('factory_its.name', 'ASC')
            ->get();
    }

    public static function allDeletedFactoryIts(){
        return DB::table('factory_its')
            ->join('designations', 'designations.id', '=', 'factory_its.designation')
            ->join('factories', 'factories.id', '=', 'factory_its.factory')
            ->select('factory_its.id', 'factory_its.name', 'factory_its.email', 'factory_its.mobile_no', 'factory_its.status',
                'designations.name AS designation', 'factories.factory_name AS factory')
            ->where('factory_its.status', '=', 'D')
            ->orderBy('factories.factory_name', 'ASC')
            ->orderBy('factory_its.name', 'ASC')
            ->get();
    }

    public static function insertFactoryIt($request){
        $model = new FactoryIt();
        $model->name = $request->name;
        $model->designation = $request->designation;
        $model->factory = $request->factory;
        $model->email = $request->email;
        $model->mobile_no = $request->mobile_no;
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateFactoryIt($request){
        $model = FactoryIt::find($request->id);
        if($model != null){
            $model->name = $request->name;
            $model->designation = $request->designation;
            $model->factory = $request->factory;
            $model->email = $request->email;
            $model->mobile_no = $request->mobile_no;
            $model->last_updated_by = Auth::id();
            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){
        $model = FactoryIt::find($id);
        if($model != null){
            $data = array(
                'name' => $model->name,
                'designation' => $model->designation,
                'factory' => $model->factory,
                'email' => $model->email,
                'mobile_no' => $model->mobile_no,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDelete($id){
        $model = FactoryIt::find($id);

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
        $model = FactoryIt::find($id);

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
        $model = FactoryIt::find($id);
        if($model != null){
            $model->status = 'I';
            if($model->save()){
                return '1';
            }
            return '0';
        }
        return '0';
    }
}
