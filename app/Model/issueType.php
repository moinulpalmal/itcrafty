<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class issueType extends Model
{
    public static function getListForSlect(){
        return DB::table('issue_types')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function getDropDownList(){
        return DB::table('issue_types')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->pluck("id","name");
    }
}
