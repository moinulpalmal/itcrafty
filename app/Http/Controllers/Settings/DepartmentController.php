<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Imports\BuyerImports;
use App\Model\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
class DepartmentController extends Controller
{
    public function index(){
       //$this->oldData();
        $departments = Department::allNotDeleteDepartments();
        return view('settings.department', compact('departments'));
    }

    private function oldData(){
// for old data
        //return $req->all();
        $collection = Excel::toArray(new BuyerImports(), 'upload/emp_hod.xlsx');
        //return $collection;
        //return count($collection[0]);
        for($i = 0; $i < count($collection[0]); $i++ ){
            //return $i++;
            $country = $collection[0][$i];
            //return $country;
            $newBuyer = new Department();
            if($country[0] != "EmployeeID"){
                if(!$this->isExist($country[4])){
                    //$newBuyer->id = $country[0];
                    $newBuyer->name = $country[4];
                    $newBuyer->status = 'A';

                    $newBuyer->save();
                }
            }
            //return $country[0];
        };

        // $this->mapOldData();
    }

    private function isExist($value){
        $data = DB::table('departments')
            ->select('id')
            ->where('name', (string)$value)
            ->get();

        if($data->count() > 0){
            return true;
        }
        return false;
    }

    public function save(Request $request){
        //return $request->all();
        if($request->id != null){
            return Department::updateDepartment($request);
        }
        else{
            return Department::insertDepartment($request);
        }
    }

    public function edit(Request $request){
        return Department::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return Department::returnDelete($request->id);
    }

    public function activate(Request $request){
        return Department::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return Department::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        if($request->check == 1){
            $DropDownData = Department::getDropDownList();
            return json_encode($DropDownData);
        }

        return null;
    }
}
