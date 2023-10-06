<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Model\ServiceMaster;
use App\View_Model\EmailList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceSearchController extends Controller
{
    public function searchProduct(){
        return view('services.search.search-product');
    }

    public function searchFactory(){
        return view('services.search.search-product');
    }

    public function searchProductResult(Request $request){
        $service_masters = ServiceMaster::forSearchList($request->count);

        if(!empty($request->product_category)){
            $service_masters = $service_masters->where('product_category_id', $request->product_category);
        }

        if(!empty($request->product_sub_category)){
            $service_masters = $service_masters->where('product_sub_category_id', $request->product_sub_category);
        }

        if(!empty($request->product_master)){
            $service_masters = $service_masters->whereBetween('product_master_id', $request->product_master);
        }

        if(!empty($request->factory)){
            $service_masters = $service_masters->whereBetween('factory_id', $request->factory);
        }

        if(!empty($request->department)){
            $service_masters = $service_masters->whereBetween('department_id', $request->department);
        }

        if(!empty($request->status)){
            $service_masters = $service_masters->whereBetween('status_tag', $request->status);
        }

        $output = '';

        if($service_masters->count() > 0){
            foreach ($service_masters as $item){
                $age = EmailList::ageInDays($item->received_at);
                $output .= '
                        <tr>
                            <td class="text-center">'.$item->service_id.'</td>
                            <td class="text-left">'.$item->product_category.'</td>
                            <td class="text-left">'.$item->product_sub_category.'</td>
                            <td class="text-left">'.$item->manufacturer.'</td>
                            <td class="text-left">'.$item->product_name.'</td>
                            <td class="text-left">'.$item->factory.'</td>
                            <td class="text-left">'.$item->department.'</td>
                            <td class="text-left">'.$item->customer.'</td>
                            <td class="text-left">'.$item->designation.'</td>
                            <td class="text-left">'.$item->contact_no.'</td>
                             <td class="text-left">'.$item->contact_email.'</td>
                            <td class="text-center">'.Carbon::parse($item->received_at)->format('j-M-Y').'</td>
                            <td class="text-center">'.$age.'</td>
                            <td class="text-right">'.$item->service_status.'</td>
                            <td class="text-center">
                                <a data-id = "'.$item->id.'"  class="btn btn-info btn-sm btn-round fa fa-eye PrintView" title="Service Detail"></a>
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
}
