<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceAssign extends Model
{
    public static function getAssignmentDetails($service_master){
        return DB::table('service_assigns')
            ->join('users', 'users.id', '=', 'service_assigns.assigned_to')
            ->select('users.name', 'service_assigns.assign_date', 'service_assigns.assignment_description',
            'service_assigns.clearance_description', 'service_assigns.clearance_date', 'service_assigns.status', 'service_assigns.counter')
            ->where('service_assigns.service_master', $service_master)
            ->where('service_assigns.status', '!=', 'D')
            ->orderBy('service_assigns.counter', 'DESC')
            ->get();
    }

    public static function getCurrentAssignment($service_master){
        return DB::table('service_assigns')
            ->join('users', 'users.id', '=', 'service_assigns.assigned_to')
            ->select('service_assigns.assigned_to', 'users.email')
            ->where('service_assigns.service_master', $service_master)
            ->where('service_assigns.status', '=', 'SA')
            ->orderBy('service_assigns.counter', 'ASC')
            ->first();
    }

    public static function isAssigned($user_id, $service_master_id){
        $data = DB::table('service_assigns')
            ->select('service_master')
            ->where('service_assigns.service_master', $service_master_id)
            ->where('service_assigns.assigned_to', $user_id)
            ->where('service_assigns.status', '=', 'SA')
            ->get();

        if($data->count() > 0){
            return 1;
        }
        return 0;
    }

    public static function assignmentCheck($user_id, $service_master_id){
        $data = DB::table('service_assigns')
            ->select('service_master')
            ->where('service_assigns.service_master', $service_master_id)
            ->where('service_assigns.assigned_to', $user_id)
            ->where('service_assigns.status', '=', 'SA')
            ->get();

            if($data->count() > 0){
                return true;
            }
            else{
                $service_master = ServiceMaster::find($service_master_id);
                if($service_master != null){
                    if($service_master->status == "SC"){
                        return true;
                    }
                    else if($service_master->status == "I"){
                        return true;
                    }
                    else if($service_master->status == "SD"){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                return false;
            }

            //return false;
    }

    public static function insert($request){
        $service_master = ServiceMaster::find($request->service_master);

        if($service_master->has_assigned == true){
            //close previous assignment
            $lastAssignment = self::getLastIdForUpdate($request->service_master);
           $result =  DB::table('service_assigns')
               ->where('counter', $lastAssignment)
               ->where('service_master', $request->service_master)
                ->update(
                    ['clearance_description' => $request->clearance_description,
                        'clearance_date' => Carbon::now(),
                        'status' => 'SC',
                        'last_updated_by' => Auth::id()
                    ]
                );

            //insert new assignment

            $history = new ServiceAssign();
            $history->service_master = $request->service_master;
            $history->counter = self::getLastIdForInsert($request->service_master);
            $history->assigned_to = $request->assigned_to;
            $history->assignment_description =  $request->assignment_description;
            $history->assign_date =  Carbon::now();
            $history->inserted_by = Auth::id();
            $history->status = 'SA';
            if($history->save()){
                $service_master->status = 'SA';
                $service_master->has_assigned = true;
                $service_master->last_updated_by = Auth::id();
                $service_master->save();
                $result = ServiceHistory::insert($request->service_master, "First Service Person Assigned!");

                return '1';
            }
            else{
                return '0';
            }
        }
        else{
            //insert new assignment
            $history = new ServiceAssign();
            $history->service_master = $request->service_master;
            $history->counter= self::getLastIdForInsert($request->service_master);
            $history->assignment_description =  $request->assignment_description;
            $history->assigned_to = $request->assigned_to;
            $history->assign_date =  Carbon::now();
            $history->inserted_by = Auth::id();
            if($history->save()){
                $service_master->status = 'SA';
                $service_master->has_assigned = true;
                $service_master->last_updated_by = Auth::id();
                $service_master->save();
                $result = ServiceHistory::insert($request->service_master, "New Service Person Assigned!");
                return '1';
            }
            else{
                return '0';
            }
        }
    }

    private static function getLastIdForUpdate($service_master){
        $data = DB::table('service_assigns')
            ->select('counter')
            ->where('service_master', $service_master)
            ->orderBy('counter', 'DESC')
            ->first();

        if($data != null){
            return ((integer)$data->counter);
        }
        return 1;
    }

    public static function getLastIdForInsert($service_master){
        $data = DB::table('service_assigns')
            ->select('counter')
            ->where('service_master', $service_master)
            ->orderBy('counter', 'DESC')
            ->first();

        if($data != null){
            return ((integer)$data->counter) + 1;
        }
        return 1;
    }

}
