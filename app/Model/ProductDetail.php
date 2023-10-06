<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductDetail extends Model
{
    public static function allActiveProductDetail(){
        return DB::table('product_details')
            ->leftjoin('product_masters', 'product_masters.id', '=', 'product_details.product_master')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->leftjoin('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->leftjoin('manufacturers', 'manufacturer.id', '=', 'product_masters.manufacturer')
            ->leftjoin('vendors', 'vendors.id', '=', 'product_details.vendor')
            ->select('product_masters.id', 'product_masters.name', 'product_masters.status',
                'product_masters.description', 'product_masters.has_warranty', 'product_masters.has_sl_no', 'product_masters.warranty_in_months',
                'product_details.old_name', 'product_details.old_vendor', 'product_details.old_purchase_date',
                'product_details.sl_no', 'product_details.purchase_date', 'product_details.warranty_in_months',
                'product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category', 'manufacturers.name AS manufacturer')
            ->where('product_details.status', '=', 'A')
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->orderBy('manufacturers.name', 'ASC')
            ->orderBy('vendors.name', 'ASC')
            ->orderBy('product_masters.name', 'ASC')
            ->get();
    }

    public static function searchActiveProductDetail($count, $sl_no){
        if(!empty($sl_no)){
            return DB::table('product_details')
                ->leftjoin('product_masters', 'product_masters.id', '=', 'product_details.product_master')
                ->leftjoin('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
                ->leftjoin('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
                ->leftjoin('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
                ->leftjoin('vendors', 'vendors.id', '=', 'product_details.vendor')
                ->select('product_details.id', 'product_masters.name', 'product_masters.status',
                    'product_masters.description', 'product_masters.has_warranty', 'product_masters.has_sl_no',
                    'product_masters.warranty_in_months', 'product_masters.name AS purchase_order_master_name',
                    'product_details.old_name', 'product_details.old_vendor', 'product_details.old_purchase_date',
                    'product_details.sl_no', 'product_details.purchase_date',
                    'product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category',
                    'manufacturers.name AS manufacturer', 'vendors.name AS vendor_name',
                    'product_masters.id AS product_master_id', 'product_categories.id AS product_category_id',
                    'product_sub_categories.id AS product_sub_category_id', 'vendors.id AS vendor_id')
                ->where('product_details.status', '=', 'A')
                ->where('product_details.sl_no', '=', $sl_no)
                ->orderBy('product_categories.name', 'ASC')
                ->orderBy('product_sub_categories.name', 'ASC')
                ->orderBy('manufacturers.name', 'ASC')
                ->orderBy('vendors.name', 'ASC')
                ->orderBy('product_masters.name', 'ASC')
                ->get()
                ->take($count);
        }
        else{
            return DB::table('product_details')
                ->join('product_masters', 'product_masters.id', '=', 'product_details.product_master')
                ->join('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
                ->join('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
                ->join('manufacturers', 'manufacturers.id', '=', 'product_masters.manufacturer')
                ->join('vendors', 'vendors.id', '=', 'product_details.vendor')
                ->select('product_details.id', 'product_masters.name', 'product_masters.status',
                    'product_masters.description', 'product_masters.has_warranty', 'product_masters.has_sl_no',
                    'product_masters.warranty_in_months', 'product_masters.name AS purchase_order_master_name',
                    'product_details.old_name', 'product_details.old_vendor', 'product_details.old_purchase_date',
                    'product_details.sl_no', 'product_details.purchase_date',
                    'product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category',
                    'manufacturers.name AS manufacturer', 'vendors.name AS vendor_name',
                    'product_masters.id AS product_master_id', 'product_categories.id AS product_category_id',
                    'product_sub_categories.id AS product_sub_category_id', 'vendors.id AS vendor_id')
                ->where('product_details.status', '=', 'A')
                ->orderBy('product_categories.name', 'ASC')
                ->orderBy('product_sub_categories.name', 'ASC')
                ->orderBy('manufacturers.name', 'ASC')
                ->orderBy('vendors.name', 'ASC')
                ->orderBy('product_masters.name', 'ASC')
                ->get()
                ->take($count);
        }

    }

    public static function allProductDetailForSelectField(){
        return null;
    }
    public static function allProductDetail(){
        return DB::table('product_details')
            ->leftjoin('product_masters', 'product_masters.id', '=', 'product_details.product_master')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->leftjoin('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->leftjoin('manufacturers', 'manufacturer.id', '=', 'product_masters.manufacturer')
            ->leftjoin('vendors', 'vendors.id', '=', 'product_details.vendor')
            ->select('product_masters.id', 'product_masters.name', 'product_masters.status',
                'product_masters.description', 'product_masters.has_warranty', 'product_masters.has_sl_no', 'product_masters.warranty_in_months',
                'product_details.old_name', 'product_details.old_vendor', 'product_details.old_purchase_date',
                'product_details.sl_no', 'product_details.purchase_date', 'product_details.warranty_in_months',
                'product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category', 'manufacturers.name AS manufacturer')
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->orderBy('manufacturers.name', 'ASC')
            ->orderBy('vendors.name', 'ASC')
            ->orderBy('product_masters.name', 'ASC')
            ->get();
    }

    public static function allNotDeleteProductDetail(){
        return ProductDetail::all();
        /*return DB::table('product_details')
            ->leftjoin('product_masters', 'product_masters.id', '=', 'product_details.product_master')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->leftjoin('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->leftjoin('manufacturers', 'manufacturer.id', '=', 'product_masters.manufacturer')
            ->leftjoin('vendors', 'vendors.id', '=', 'product_details.vendor')
            ->select('product_masters.id', 'product_masters.name', 'product_masters.status',
                'product_masters.description', 'product_masters.has_warranty', 'product_masters.has_sl_no', 'product_masters.warranty_in_months',
                'product_details.old_name', 'product_details.old_vendor', 'product_details.old_purchase_date',
                'product_details.sl_no', 'product_details.purchase_date', 'product_details.warranty_in_months',
                'product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category', 'manufacturers.name AS manufacturer')
            ->where('product_details.status', '!=', 'D')
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->orderBy('manufacturers.name', 'ASC')
            ->orderBy('vendors.name', 'ASC')
            ->orderBy('product_masters.name', 'ASC')
            ->get();*/
    }

    public static function allDeletedProductDetail(){
        return DB::table('product_details')
            ->leftjoin('product_masters', 'product_masters.id', '=', 'product_details.product_master')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->leftjoin('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->leftjoin('manufacturers', 'manufacturer.id', '=', 'product_masters.manufacturer')
            ->leftjoin('vendors', 'vendors.id', '=', 'product_details.vendor')
            ->select('product_masters.id', 'product_masters.name', 'product_masters.status',
                'product_masters.description', 'product_masters.has_warranty', 'product_masters.has_sl_no', 'product_masters.warranty_in_months',
                'product_details.old_name', 'product_details.old_vendor', 'product_details.old_purchase_date',
                'product_details.sl_no', 'product_details.purchase_date', 'product_details.warranty_in_months',
                'product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category', 'manufacturers.name AS manufacturer')
            ->where('product_details.status', '=', 'D')
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->orderBy('manufacturers.name', 'ASC')
            ->orderBy('vendors.name', 'ASC')
            ->orderBy('product_masters.name', 'ASC')
            ->get();
    }

    public static function insertProductDetail($request){
        $model = new ProductDetail();

        $model->product_master = $request->product_master;
        $model->vendor = $request->vendor;

        $model->old_name = $request->old_name;
        $model->old_vendor = $request->old_vendor;
        $model->old_purchase_date = $request->old_purchase_date;
        $model->sl_no = $request->sl_no;

        $model->purchase_date = $request->purchase_date;
        $model->warranty_in_months = $request->warranty_in_months;

        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){
            return '1';
        }
        return '0';
    }

    public static function insertNewProductDetail($product){
        $model = new ProductDetail();

        $model->product_master = $product->product_master;
        $model->vendor = $product->vendor;

        $model->sl_no = $product->sl_no;

        $model->purchase_date = $product->purchase_date;
        $model->warranty_in_months = $product->warranty_in_months;

        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){
            return '1';
        }
        return '0';
    }

    public static function updateProductDetail($request){
        $model = ProductDetail::find($request->id);
        if($model != null){
            $model->product_master = $request->product_master;
            $model->vendor = $request->vendor;

           // $model->old_name = $request->old_name;
            //$model->old_vendor = $request->old_vendor;
           // $model->old_purchase_date = $request->old_purchase_date;
            $model->sl_no = $request->serial_no;

            $model->purchase_date = $request->purchase_date;
            //$model->warranty_in_months = $request->warranty_in_months;

            $model->last_updated_by = Auth::id();

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){
        $model = ProductDetail::find($id);
        if($model != null){
            if($model->product_master > 0){
                $data = array(
                    'old_name' => $model->old_name,
                    'old_vendor' => $model->old_vendor,
                    'old_purchase_date' => $model->old_purchase_date,
                    'sl_no' => $model->sl_no,
                    'product_master' => $model->product_master,
                    'product_category' => ProductMaster::find($model->product_master)->product_category,
                    'product_sub_category' => ProductMaster::find($model->product_master)->product_sub_category,
                    'manufacturer' => ProductMaster::find($model->product_master)->manufacturer,
                    'vendor' => $model->vendor,
                    'purchase_date' => $model->purchase_date,
                    'warranty_in_months' => $model->warranty_in_months,
                    'id' => $model->id
                );
                return $data;
            }
            else{
                $data = array(
                    'old_name' => $model->old_name,
                    'old_vendor' => $model->old_vendor,
                    'old_purchase_date' => $model->old_purchase_date,
                    'sl_no' => $model->sl_no,
                    'product_master' => '',
                    'product_category' => '',
                    'product_sub_category' => '',
                    'manufacturer' => '',
                    'vendor' => $model->vendor,
                    'purchase_date' => $model->purchase_date,
                    'warranty_in_months' => $model->warranty_in_months,
                    'id' => $model->id
                );
                return $data;
            }

        }
        return '0';

    }

    public static function checkDuplicateProduct($product_master, $product_detail, $sl_no ){
        $data = DB::table('product_details')
            ->select('id')
            ->where('sl_no', $sl_no)
            ->where('product_master', $product_master)
            ->where('id', '!=', $product_detail)
            ->where('status', '!=', 'D')
            ->get();

        if($data->count() > 0){
            return true;
        }

        return false;
    }
    public static function returnDelete($id){
        $model = ProductDetail::find($id);

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
        $model = ProductDetail::find($id);

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
        $model = ProductDetail::find($id);
        if($model != null){
            $model->status = 'I';
            if($model->save()){
                return '1';
            }
            return '0';
        }
        return '0';
    }

    public static function getProductDetailIdBySlNo($sl_no){
        $model = DB::table('product_details')
            ->leftjoin('product_masters', 'product_masters.id', '=', 'product_details.product_master')
            ->leftjoin('product_categories', 'product_categories.id', '=', 'product_masters.product_category')
            ->leftjoin('product_sub_categories', 'product_sub_categories.id', '=', 'product_masters.product_sub_category')
            ->leftjoin('manufacturers', 'manufacturer.id', '=', 'product_masters.manufacturer')
            ->leftjoin('vendors', 'vendors.id', '=', 'product_details.vendor')
            ->select('product_masters.id', 'product_masters.name', 'product_masters.status',
                'product_masters.description', 'product_masters.has_warranty', 'product_masters.has_sl_no', 'product_masters.warranty_in_months',
                'product_details.old_name', 'product_details.old_vendor', 'product_details.old_purchase_date',
                'product_details.sl_no', 'product_details.purchase_date', 'product_details.warranty_in_months',
                'product_categories.name AS product_category', 'product_sub_categories.name AS product_sub_category', 'manufacturers.name AS manufacturer')
            ->where('product_details.sl_no', '=', $sl_no)
            ->orderBy('product_categories.name', 'ASC')
            ->orderBy('product_sub_categories.name', 'ASC')
            ->orderBy('manufacturers.name', 'ASC')
            ->orderBy('vendors.name', 'ASC')
            ->orderBy('product_masters.name', 'ASC')
            ->get();

        return $model;
    }

    public static function checkWarranty($pa_warranty_in_months, $purchase_date){
        if(!empty($pa_warranty_in_months)){
            $currentDate = Carbon::now();

            $warranty_in_months = (integer)$pa_warranty_in_months;

            $warranty_id_days = 0;
            if($warranty_in_months != null){
                $warranty_id_days = $warranty_in_months * 30;
            }
            $age = $currentDate->diff($purchase_date);
            $final_age = $age->format('%a');
            if($final_age > $warranty_id_days){
                return "No";
            }
            else{
                return "Yes";
            }
        }

        return "Update Product Info!";

    }

    public static function returnForWarranty($request){
        //return $request->all();
        $product_master = ProductMaster::find($request->product_master);
        $service_master = ServiceMaster::find($request->service_master);

        $warranty_in_months = (integer)$product_master->warranty_in_months;
        $warranty_id_days = 0;
        if($warranty_in_months != null){
            $warranty_id_days = $warranty_in_months * 30;
        }
        $currentDate = Carbon::now();

        $model = DB::table('product_details')
            ->select('id', 'sl_no', 'purchase_date', 'product_master', 'old_name', 'product_master')
            ->where('product_details.sl_no', '=', ($request->serial_no))
            ->first();

       // return $model->product_master;

        if($model != null){
            $purchase_date = $model->purchase_date;
            $age = $currentDate->diff($purchase_date);
            $final_age = $age->format('%a');

            if($model->product_master == null){
                //return $model->product_master;
                if($final_age > $warranty_id_days){
                    // update product detail with product master
                    if($model->product_master == null){
                        $product_detail = ProductDetail::find($model->id);
                        $product_detail->product_master = $product_master->id;
                        $product_detail->save();
                    }

                    if($service_master->product_detail == null){
                        $service_master->product_detail = $model->id;
                        $service_master->has_warranty = false;
                        $service_master->save();
                    }

                    $service_history = ServiceHistory::insert($service_master->id, "Warranty Checked on Empty Product Master at Product Detail; No Warranty!");
                    $data = array(
                        'sl_no' => $model->sl_no,
                        'has_warranty' => false,
                        'has_data' => true,
                        'has_product_missed' => false,
                        'product_detail' => $model->id,
                        'warranty_in_months' => $product_master->warranty_in_months
                    );
                    return $data;
                }
                else{
                    if($model->product_master == null){
                        $product_detail = ProductDetail::find($model->id);
                        $product_detail->product_master = $product_master->id;
                        $product_detail->save();
                    }

                    if($service_master->product_detail == null){
                        $service_master->product_detail = $model->id;
                        $service_master->has_warranty = true;
                        $service_master->save();
                    }

                    $service_history = ServiceHistory::insert($service_master->id, "Warranty Checked Empty Product Master at Product Detail; Has Warranty!");
                    $data = array(
                        'sl_no' => $model->sl_no,
                        'has_warranty' => true,
                        'has_data' => true,
                        'has_product_missed' => false,
                        'product_detail' => $model->id,
                        'warranty_in_months' => $product_master->warranty_in_months
                    );
                    return $data;
                }
            }
            else{
                //return $model->product_master;
                if($model->product_master != $service_master->product_master){
                    //return $model->product_master;
                    $data = array(
                        'sl_no' => null,
                        'has_warranty' => false,
                        'has_data' => true,
                        'product_detail' => null,
                        'has_product_missed' => true,
                        'warranty_in_months' => null
                    );
                    $service_history = ServiceHistory::insert($service_master->id, "Warranty Checked; Product miss-matched!");
                    return $data;
                }
                else{
                   // return "tutu";
                    if($final_age > $warranty_id_days){
                        // update product detail with product master
                        if($model->product_master == null){
                            $product_detail = ProductDetail::find($model->id);
                            $product_detail->product_master = $product_master->id;
                            $product_detail->save();
                        }

                        if($service_master->product_detail == null){
                            $service_master->product_detail = $model->id;
                            $service_master->has_warranty = false;
                            $service_master->save();
                        }

                        $service_history = ServiceHistory::insert($service_master->id, "Warranty Checked; No Warranty!");
                        $data = array(
                            'sl_no' => $model->sl_no,
                            'has_warranty' => false,
                            'has_data' => true,
                            'has_product_missed' => false,
                            'product_detail' => $model->id,
                            'warranty_in_months' => $product_master->warranty_in_months
                        );
                        return $data;
                    }
                    else{
                        if($model->product_master == null){
                            $product_detail = ProductDetail::find($model->id);
                            $product_detail->product_master = $product_master->id;
                            $product_detail->save();
                        }

                        if($service_master->product_detail == null){
                            $service_master->product_detail = $model->id;
                            $service_master->has_warranty = true;
                            $service_master->save();
                        }

                        $service_history = ServiceHistory::insert($service_master->id, "Warranty Checked; Has Warranty!");
                        $data = array(
                            'sl_no' => $model->sl_no,
                            'has_warranty' => true,
                            'has_data' => true,
                            'has_product_missed' => false,
                            'product_detail' => $model->id,
                            'warranty_in_months' => $product_master->warranty_in_months
                        );
                        return $data;
                    }
                }
            }
        }

        $service_history = ServiceHistory::insert($service_master->id, "Warranty Checked; No Product Information Found!");

        $data = array(
            'sl_no' => null,
            'has_warranty' => false,
            'has_data' => false,
            'product_detail' => null,
            'has_product_missed' => null,
            'warranty_in_months' => null
        );
        return $data;
    }

    public static function returnForWarrantyServiceMasterProductSl($service_check_id){
        //return $request->all();
        //$service_master = ServiceMaster::find($service_master_id);
        $service_warranty_checks = ServiceWarrantyCheck::find($service_check_id);
        $product_master = ProductMaster::find($service_warranty_checks->product_master);


        $warranty_in_months = (integer)$product_master->warranty_in_months;
        $warranty_id_days = 0;
        if($warranty_in_months != null){
            $warranty_id_days = $warranty_in_months * 30;
        }
        $currentDate = Carbon::now();

        $model = DB::table('product_details')
            ->select('id', 'sl_no', 'purchase_date', 'product_master', 'old_name', 'product_master')
            ->where('product_details.sl_no', '=', $service_warranty_checks->serial_no)
            ->first();

        // return $model->product_master;

        if($model != null){
            $purchase_date = $model->purchase_date;
            $age = $currentDate->diff($purchase_date);
            $final_age = $age->format('%a');

            if($model->product_master == null){
                //return $model->product_master;
                if($final_age > $warranty_id_days){
                    // update product detail with product master
                    if($model->product_master == null){
                        $product_detail = ProductDetail::find($model->id);
                        $product_detail->product_master = $product_master->id;
                        $product_detail->save();
                    }

                    if($service_warranty_checks->product_detail == null){
                        $service_warranty_checks->product_detail = $model->id;
                        //$service_warranty_checks->has_warranty = false;
                        $service_warranty_checks->save();
                    }

                    //$service_history = ServiceHistory::insert($service_master->id, "Warranty Checked on Empty Product Master at Product Detail; No Warranty!");
                    return "Warranty Checked on Empty Product Master at Product Detail; No Warranty!";

                }
                else{
                    if($model->product_master == null){
                        $product_detail = ProductDetail::find($model->id);
                        $product_detail->product_master = $product_master->id;
                        $product_detail->save();
                    }

                    if($service_warranty_checks->product_detail == null){
                        $service_warranty_checks->product_detail = $model->id;
                       // $service_warranty_checks->has_warranty = true;
                        $service_warranty_checks->save();
                    }

                    //$service_history = ServiceHistory::insert($service_master->id, "Warranty Checked Empty Product Master at Product Detail; Has Warranty!");
                    return "Warranty Checked Empty Product Master at Product Detail; Has Warranty!";

                }
            }
            else{
                //return $model->product_master;
                if($model->product_master != $service_warranty_checks->product_master){
                   // $service_history = ServiceHistory::insert($service_master->id, "Warranty Checked; Product miss-matched!");
                    return "Warranty Checked; Product miss-matched!";

                }
                else{
                    // return "tutu";
                    if($final_age > $warranty_id_days){
                        // update product detail with product master
                        if($model->product_master == null){
                            $product_detail = ProductDetail::find($model->id);
                            $product_detail->product_master = $product_master->id;
                            $product_detail->save();
                        }

                        if($service_warranty_checks->product_detail == null){
                            $service_warranty_checks->product_detail = $model->id;
                            //$service_warranty_checks->has_warranty = false;
                            $service_warranty_checks->save();
                        }

                       // $service_history = ServiceHistory::insert($service_master->id, "Warranty Checked; No Warranty!");
                        return  "Warranty Checked; No Warranty!";

                    }
                    else{
                        if($model->product_master == null){
                            $product_detail = ProductDetail::find($model->id);
                            $product_detail->product_master = $product_master->id;
                            $product_detail->save();
                        }

                        if($service_warranty_checks->product_detail == null){
                            $service_warranty_checks->product_detail = $model->id;
                           // $service_warranty_checks->has_warranty = true;
                            $service_warranty_checks->save();
                        }

                        //$service_history = ServiceHistory::insert($service_master->id, "Warranty Checked; Has Warranty!");
                        return  "Warranty Checked; Has Warranty!";
                    }
                }
            }
        }

        //$service_history = ServiceHistory::insert($service_master->id, "Warranty Checked; No Product Information Found!");
        return  "Warranty Checked; No Product Information Found!";
    }

}
