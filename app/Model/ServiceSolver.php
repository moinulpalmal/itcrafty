<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceSolver extends Model
{
    public static function insertSolver($service_master, $solver_id){
        $history = new ServiceSolver();
        $history->service_master = $service_master;
        $history->solver = $solver_id;
        $history->counter = self::getLastId($service_master);

        $history->inserted_by = Auth::id();
        return $history->save();
    }

    private static function getLastId($service_master){
        $data = DB::table('service_solvers')
            ->select('counter')
            ->where('service_master', $service_master)
            ->orderBy('counter', 'DESC')
            ->first();

        if($data != null){
            return ((integer)$data->counter) + 1;
        }
        return 1;
    }

    public static function getSolverInfo($service_master){
        $data = DB::table('service_solvers')
            ->select('solver')
            ->where('service_master', $service_master)
            ->orderBy('counter', 'DESC')
            ->first();

        if($data != null){
            return User::find($data->solver)->name;
        }
        return "";

    }
}
