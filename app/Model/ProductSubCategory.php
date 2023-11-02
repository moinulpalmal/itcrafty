<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductSubCategory extends Model
{
    public static function allActiveProductSubCategories(){
        return DB::table('product_sub_categories')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_sub_categories.product_category')
            ->select('product_sub_categories.id', 'product_sub_categories.name', 'product_sub_categories.status',
                'product_categories.name AS product_category')
            ->where('product_sub_categories.status', '=', 'A')
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->get();
    }

    public static function allProductSubCategoriesForSelectField(){
        return DB::table('product_sub_categories')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_sub_categories.product_category')
            ->select('product_sub_categories.id', 'product_sub_categories.name', 'product_sub_categories.status',
                'product_categories.name AS product_category')
            ->where('product_sub_categories.status', '=', 'A')
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->get();
    }
    public static function allProductSubCategories(){
        return DB::table('product_sub_categories')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_sub_categories.product_category')
            ->select('product_sub_categories.id', 'product_sub_categories.name', 'product_sub_categories.status',
                'product_categories.name AS product_category')
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->get();
    }

    public static function allNotDeleteProductSubCategories(){
        return DB::table('product_sub_categories')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_sub_categories.product_category')
            ->select('product_sub_categories.id', 'product_sub_categories.name', 'product_sub_categories.status',
                'product_categories.name AS product_category')
            ->where('product_sub_categories.status', '!=', 'D')
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->get();
    }

    public static function allDeletedProductSubCategories(){
        return DB::table('product_sub_categories')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_sub_categories.product_category')
            ->select('product_sub_categories.id', 'product_sub_categories.name', 'product_sub_categories.status',
                'product_categories.name AS product_category')
            ->where('product_sub_categories.status', '=', 'D')
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->get();
    }

    public static function insertProductSubCategory($request){
        $model = new ProductSubCategory();
        $model->product_category = $request->product_category;
        $model->name = $request->name;
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateProductSubCategory($request){
        $model = ProductSubCategory::find($request->id);
        if($model != null){
            $model->name = $request->name;
            $model->product_category = $request->product_category;
            $model->last_updated_by = Auth::id();

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){
        $model = ProductSubCategory::find($id);
        if($model != null){
            $data = array(
                'name' => $model->name,
                'product_category' => $model->product_category,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDelete($id){
        $model = ProductSubCategory::find($id);

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
        $model = ProductSubCategory::find($id);

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
        $model = ProductSubCategory::find($id);
        if($model != null){
            $model->status = 'I';
            if($model->save()){
                return '1';
            }
            return '0';
        }
        return '0';
    }

    public static function getDropDownListByProductCategory($product_category){
        return DB::table('product_sub_categories')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->where('product_category', '=', $product_category)
            ->orderBy('name', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function getProductSubCatForSelectByProductCategory($product_category){
        return DB::table('product_sub_categories')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->where('product_category', '=', $product_category)
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function getDropDownList(){
        return DB::table('product_sub_categories')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function getProductSubCategoriesForSelectField(){
        return DB::table('product_sub_categories')
            ->select('id', 'name', 'status')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }
}
