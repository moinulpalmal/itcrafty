<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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

    public static function allActiveIssueTypes(){
        return DB::table('issue_types')
            ->select('id', 'name', 'status')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allDeletedIssueTypes(){
        return DB::table('issue_types')
            ->select('id', 'name', 'status')
            ->where('status', '=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allNotDeletedIssueTypes(){
        return DB::table('issue_types')
            ->select('id', 'name', 'status')
            ->where('status', '!=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function insertIssueTypes($request){
        $model = new IssueType();
        $model->name = $request->name;
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateIssueTypes($request){
        $model = IssueType::find($request->id);
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
        $model = IssueType::find($id);
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
        $model = IssueType::find($id);

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
        $model = IssueType::find($id);

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
        $model = IssueType::find($id);
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
