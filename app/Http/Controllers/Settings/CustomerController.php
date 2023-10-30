<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Imports\BuyerImports;
use App\Model\Customer;
use App\Model\Department;
use App\Model\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function index(){
        //return $this->oldData();
       /* $customers =  DB::table('customers')
            ->select('id')
            ->where('designation', null)
            ->get();
       // $customers =
        foreach ($customers AS $customer){
            $customer = Customer::find($customer->id);

            $customer->department = Department::returnIDByName($customer->old_department);
            $customer->designation = Designation::returnIDByName($customer->old_designation);

            $customer->save();
        }*/
        $customers = Customer::allNotDeleteCustomers();
        return view('settings.customer', compact('customers'));
    }

    private function oldData(){
// for old data
        //return $req->all();
        $collection = Excel::toArray(new BuyerImports(), 'upload/emp_hod.xlsx');
        //return $collection;
        //return count($collection[0]);

       // return $collection[0][1098];

        for($i = 1098; $i < count($collection[0]); $i++ ){
            //return $i++;
            $country = $collection[0][$i];
            //return $country[0];
            //return $country;
            $newBuyer = new Customer();
            if($country[0] != "EmployeeID"){
                if(!$this->isExist($country[0])){
                    //$newBuyer->id = $country[0];
                    $newBuyer->employee_id =  $country[0];
                    $newBuyer->factory =  1;
                    $newBuyer->designation =  $this->designationId($country[1]);
                    $newBuyer->department =  $this->departmentId($country[4]);
                    $newBuyer->name = $country[3];
                    $newBuyer->status = 'A';

                    $newBuyer->save();
                }
            }
            //return $country[0];
        };

        return $i;
        // $this->mapOldData();
    }

    private function isExist($value){
        $data = DB::table('customers')
            ->select('id')
            ->where('employee_id', (string)$value)
            ->get();

        if($data->count() > 0){
            return true;
        }
        return false;
    }

    private function departmentId($name){
        $data = DB::table('departments')
            ->select('id')
            ->where('name', (string)$name)
            ->get();

        if($data->count() > 0){
            foreach ($data as $i){
                return $i->id;
            }
        }

        return null;
    }

    private function designationId($name){
        $data = DB::table('designations')
            ->select('id')
            ->where('name', (string)$name)
            ->get();

        if($data->count() > 0){
            foreach ($data as $i){
                return $i->id;
            }
        }
        return null;
    }

    public function save(Request $request){
        //return $request->all();
        if($request->id != null){
            return Customer::updateCustomer($request);
        }
        else{
            return Customer::insertCustomer($request);
        }
    }

    public function edit(Request $request){
        return Customer::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return Customer::returnDelete($request->id);
    }

    public function activate(Request $request){
        return Customer::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return Customer::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        $factory = 0;
        $department = 0;
        if($request->factory != ''){
            $factory = $request->factory;
        }

        if($request->department != ''){
            $department = $request->department;
        }
        return Customer::getDropDownList($factory, $department);
    }

    public function editByEmpId(Request $request){
        return Customer::returnDetailByEmpId(trim($request->employee_id));
    }
}
