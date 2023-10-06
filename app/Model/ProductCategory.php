<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductCategory extends Model
{
    public static function allActiveProductCategories(){
        return ProductCategory::where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }


    public static function allProductCategories(){
        return  ProductCategory::all();
    }

    public static function allNotDeleteProductCategories(){
        return  ProductCategory::where('status', '!=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allDeletedProductCategoryies(){
        return  ProductCategory::where('status', '=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function insertProductCategory($request){
        $model = new ProductCategory();
        $model->name = $request->name;
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateProductCategory($request){
        $model = ProductCategory::find($request->id);
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
        $model = ProductCategory::find($id);
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
        $model = ProductCategory::find($id);

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
        $model = ProductCategory::find($id);

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
        $model = ProductCategory::find($id);
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
        return DB::table('product_categories')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function allProductCategoriesForSelectField(){
        return DB::table('product_categories')
            ->select('id', 'name', 'status')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }
}
