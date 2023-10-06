<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductMaster extends Model
{
    public static function allActiveProductMaster(){
        return DB::table('product_masters')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->leftjoin('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->leftjoin('manufacturers', 'manufacturer.id', '=', 'product_masters.manufacturer')
            ->select('product_masters.id', 'product_masters.name', 'product_masters.status',
                'product_masters.description', 'product_masters.has_warranty', 'product_masters.has_sl_no', 'product_masters.warranty_in_months',
                'product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category', 'manufacturers.name AS manufacturer')
            ->where('product_masters.status', '=', 'A')
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->orderBy('manufacturers.name', 'ASC')
            ->orderBy('product_masters.name', 'ASC')
            ->get();
    }

    public static function allProductMasterForSelectField(){
        return null;
    }
    public static function allProductMaster(){
        return DB::table('product_masters')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->leftjoin('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->select('product_masters.id', 'product_masters.name', 'product_masters.status',
                'product_masters.description', 'product_masters.has_warranty', 'product_masters.has_sl_no', 'product_masters.warranty_in_months',
                'product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category', 'manufacturers.name AS manufacturer')
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->orderBy('manufacturers.name', 'ASC')
            ->orderBy('product_masters.name', 'ASC')
            ->get();
    }

    public static function allNotDeleteProductMaster(){
        return DB::table('product_masters')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->leftjoin('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->select('product_masters.id', 'product_masters.name', 'product_masters.status',
                'product_masters.description', 'product_masters.has_warranty', 'product_masters.has_sl_no', 'product_masters.warranty_in_months',
                'product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category', 'manufacturers.name AS manufacturer')
            ->where('product_masters.status', '!=', 'D')
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->orderBy('manufacturers.name', 'ASC')
            ->orderBy('product_masters.name', 'ASC')
            ->get();
    }

    public static function allDeletedProductMaster(){
        return DB::table('product_masters')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->leftjoin('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->select('product_masters.id', 'product_masters.name', 'product_masters.status',
                'product_masters.description', 'product_masters.has_warranty', 'product_masters.has_sl_no', 'product_masters.warranty_in_months',
                'product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category', 'manufacturers.name AS manufacturer')
            ->where('product_masters.status', '=', 'D')
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->orderBy('manufacturers.name', 'ASC')
            ->orderBy('product_masters.name', 'ASC')
            ->get();
    }

    public static function insertProductMaster($request){
        $model = new ProductMaster();

        $model->product_category = $request->product_category;
        $model->product_sub_category = $request->product_sub_category;
        $model->manufacturer = $request->manufacturer;

        $model->name = $request->name;
        $model->description = $request->description;

        if($request->has_warranty == 'on'){
            $model->has_warranty = true;
        }
        else{
            $model->has_warranty = false;
        }

        if($request->has_sl_no == 'on'){
            $model->has_sl_no = true;
        }
        else{
            $model->has_sl_no = false;
        }

        $model->warranty_in_months = $request->warranty_in_months;

        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateProductMaster($request){
        $model = ProductMaster::find($request->id);
        if($model != null){
            $model->product_category = $request->product_category;
            $model->product_sub_category = $request->product_sub_category;
            $model->manufacturer = $request->manufacturer;

            $model->name = $request->name;
            $model->description = $request->description;

            if($request->has_warranty == 'on'){
                $model->has_warranty = true;
            }
            else{
                $model->has_warranty = false;
            }

            if($request->has_sl_no == 'on'){
                $model->has_sl_no = true;
            }
            else{
                $model->has_sl_no = false;
            }

            $model->warranty_in_months = $request->warranty_in_months;

            $model->last_updated_by = Auth::id();

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){
        $model = ProductMaster::find($id);
        if($model != null){
            $data = array(
                'product_category' => $model->product_category,
                'name' => $model->name,
                'product_sub_category' => $model->product_sub_category,
                'manufacturer' => $model->manufacturer,
                'description' => $model->description,
                'has_warranty' => $model->has_warranty,
                'has_sl_no' => $model->has_sl_no,
                'warranty_in_months' => $model->warranty_in_months,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDelete($id){
        $model = ProductMaster::find($id);

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
        $model = ProductMaster::find($id);

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
        $model = ProductMaster::find($id);
        if($model != null){
            $model->status = 'I';
            if($model->save()){
                return '1';
            }
            return '0';
        }
        return '0';
    }

    public static function getDropDownList($category, $sub_category){
        return DB::table('product_masters')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->select('product_masters.id', DB::raw('CONCAT(IFNULL(manufacturers.name, " "), "-" ,product_masters.name) AS name'))
            ->where('product_masters.status', '=', 'A')
            ->where('product_masters.product_category', '=', $category)
            ->where('product_masters.product_sub_category', '=', $sub_category)
            ->orderBy('manufacturers.name', 'ASC')
            ->orderBy('product_masters.name', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function getDropDownListSelect($category, $sub_category){
        return DB::table('product_masters')
            ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
            ->select('product_masters.id', DB::raw('CONCAT(IFNULL(manufacturers.name, " "), "-" ,product_masters.name) AS name'))
            ->where('product_masters.status', '=', 'A')
            ->where('product_masters.product_category', '=', $category)
            ->where('product_masters.product_sub_category', '=', $sub_category)
            ->orderBy('manufacturers.name', 'ASC')
            ->orderBy('product_masters.name', 'ASC')
            ->get();

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function getCategoryName($id){
        return ProductCategory::find(ProductMaster::find($id)->product_category)->name;
    }

    public static function getSubCategoryName($id){
        return ProductSubCategory::find(ProductMaster::find($id)->product_sub_category)->name;
    }

    public static function getManufacturerName($id){
        return Manufacturer::find(ProductMaster::find($id)->manufacturer)->name;
    }

    public static function getProductMasterName($id){
        return ProductMaster::find($id)->name;
    }
}
