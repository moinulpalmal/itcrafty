<?php

namespace App\View_Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmailList extends Model
{
    public static function getEmailList($array){
       $data = DB::table('view_email_list')
                    ->select('email AS email', 'tag')
                    ->orderBy('email')
                    ->get();
       $data = $data->whereIn('tag', $array);
       //$data = $data->groupBy('email');
        return $data;
    }

    public static function ageInDays($date){
        $currentDate = Carbon::now();
        $purchase_date = $date;
        $age = $currentDate->diff($purchase_date);
        $final_age = $age->format('%a');

        return $final_age;
    }
}
