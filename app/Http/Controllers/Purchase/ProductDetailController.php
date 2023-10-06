<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Model\ProductCategory;
use App\Model\ProductDetail;
use App\Model\ProductMaster;
use App\Model\ProductSubCategory;
use App\Model\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function new(){
        //$product_categories = ProductCategory::
        return view('purchase.product.new');
    }

    public function save(Request $request){
        //return $request->all();
        $array = $request->serial_no;
         if(sizeof(array_unique(array_diff_assoc( $array,array_unique( $array)))) > 0){
             return '3';
         }
         else{

             // check product already exists
             foreach ($request->serial_no AS $serial){
                if(ProductDetail::checkDuplicateProduct($request->product_master, 0,$serial)){
                    return '4';
                }
             }
             foreach ($request->serial_no AS $serial){

                 $model = new ProductDetail();
                 $purchase_master = ProductMaster::find($request->product_master);
                 $model->product_master = $request->product_master;
                 $model->vendor = $request->vendor;

                 $model->sl_no = $serial;

                 $model->purchase_date = $request->purchase_date;
                 $model->warranty_in_months = $purchase_master->warranty_in_months;

                 //$result = ProductDetail::insertNewProductDetail($model);
             }
             return '1';
         }
         //return '0';
    }

    public function search(){
        return view('purchase.product.search-product');
    }

    public function searchResult(Request $request){
        $service_masters = ProductDetail::searchActiveProductDetail($request->count, $request->serial_no);

       // return $service_masters;
        if(!empty($request->product_category)){
            $service_masters = $service_masters->where('product_category_id', $request->product_category);
        }

        //return $service_masters;

        if(!empty($request->product_sub_category)){
            $service_masters = $service_masters->where('product_sub_category_id', $request->product_sub_category);
        }

        if(!empty($request->product_master)){
            $service_masters = $service_masters->whereBetween('product_master_id', $request->product_master);
        }

        if(!empty($request->vendor)){
            $service_masters = $service_masters->whereBetween('vendor_id', $request->vendor);
        }

        /*if(!empty($request->serial_no)){
            $service_masters = $service_masters->where('sl_no', '=',$request->serial_no);
        }*/
        //return $service_masters;

        $output = '';

        if($service_masters->count() > 0){
            foreach ($service_masters as $item){
                $warranty_status = ProductDetail::checkWarranty($item->warranty_in_months,$item->purchase_date );
                $output .= '
                        <tr>
                            <td class="text-left">'.$item->product_category.'</td>
                            <td class="text-left">'.$item->product_sub_category.'</td>
                            <td class="text-left">'.$item->manufacturer.'</td>
                             <td class="text-left">'.$item->vendor_name.'</td>
                             <td class="text-left">'.$item->old_vendor.'</td>
                            <td class="text-left">'.$item->purchase_order_master_name.'</td>
                            <td class="text-left">'.$item->old_name.'</td>
                            <td class="text-center">'.Carbon::parse($item->purchase_date)->format('j-M-Y').'</td>
                            <td class="text-center">'.$item->sl_no.'</td>
                            <td class="text-center">'.$item->warranty_in_months.'</td>
                            <td class="text-center text-danger text-bold-700">'.$warranty_status.'</td>
                            <td class="text-center">
                                <a data-id = "'.$item->id.'"  class="btn btn-warning btn-sm btn-round fa fa-edit PrintView" title="Service Detail"></a>
                            </td>
                        </tr>
                        ';
            }
            $data = array(
                'table_data' => $output
            );
            return json_encode($data);
        }
        else{
            $data  = '0';
            return json_encode($data);
        }
    }

    public function searchSLNo(){
        return view('purchase.product.search-product');
    }

    public function searchSlNoResult(Request $request){

    }

    public function edit($id){
        $product_detail = ProductDetail::find($id);
       // return $data;

        if(!empty($product_detail)){
            $product_categories = ProductCategory::allProductCategoriesForSelectField();
            $vendors = Vendor::allVendorsForSelectField();
            if(!empty($product_detail->product_master)){
                $product_master = ProductMaster::find($product_detail->product_master);
                $product_sub_categories = ProductSubCategory::getProductSubCatForSelectByProductCategory($product_master->product_category);
                $product_masters = ProductMaster::getDropDownListSelect($product_master->product_category, $product_master->product_sub_category);
            }
            else{
                //return "hit";
                $product_master = null;
                $product_sub_categories = null;
                $product_masters = null;
            }
           // return $product_categories;
            return view('purchase.product.edit', compact('product_detail', 'product_master','product_categories', 'vendors', 'product_sub_categories', 'product_masters'));
        }

        return redirect()->back();
    }

    public function update(Request $request){
        // check product already exists
        if(!empty($request->serial_no)){
            if(ProductDetail::checkDuplicateProduct($request->product_master, $request->id, $request->serial_no)){
                return '4';
            }
        }
        return ProductDetail::updateProductDetail($request);
    }
}
