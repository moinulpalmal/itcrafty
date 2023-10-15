<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    public static function allActiveCustomers(){
        return DB::table('customers')
            ->join('factories', 'factories.id', '=', 'customers.factory')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->leftjoin('departments', 'departments.id', '=', 'customers.department')
            ->select('customers.id', 'customers.employee_id','customers.name',
                'customers.email', 'customers.mobile_no', 'customers.ext_no', 'customers.status',
                'designations.name AS designation', 'factories.factory_name AS factory', 'departments.name AS department')
            ->where('customers.status', '=', 'A')
            ->orderBy('factories.factory_name', 'ASC')
            ->orderBy('departments.name', 'ASC')
            ->orderBy('designations.name', 'ASC')
            ->orderBy('customers.name', 'ASC')
            ->get();
    }

    /*public static function allCustomersForSelectField(){
        return DB::table('customers')
            ->select('id', 'Customers_name', 'unit_name', 'status')
            ->where('status', '=', 'A')
            ->orderBy('Customers_name', 'ASC')
            ->orderBy('unit_name', 'ASC')
            ->get();
    }*/
    public static function allCustomers(){
        return DB::table('customers')
            ->join('factories', 'factories.id', '=', 'customers.factory')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->leftjoin('departments', 'departments.id', '=', 'customers.department')
            ->select('customers.id', 'customers.employee_id','customers.name',
                'customers.email', 'customers.mobile_no', 'customers.ext_no', 'customers.status',
                'designations.name AS designation', 'factories.factory_name AS factory', 'departments.name AS department')
            ->orderBy('factories.factory_name', 'ASC')
            ->orderBy('departments.name', 'ASC')
            ->orderBy('designations.name', 'ASC')
            ->orderBy('customers.name', 'ASC')
            ->get();
    }

    public static function allNotDeleteCustomers(){
        return DB::table('customers')
            ->join('factories', 'factories.id', '=', 'customers.factory')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->leftjoin('departments', 'departments.id', '=', 'customers.department')
            ->select('customers.id', 'customers.employee_id','customers.name',
                'customers.email', 'customers.mobile_no', 'customers.ext_no', 'customers.status',
                'designations.name AS designation', 'factories.factory_name AS factory', 'departments.name AS department')
            ->where('customers.status', '!=', 'D')
            ->orderBy('factories.factory_name', 'ASC')
            ->orderBy('departments.name', 'ASC')
            ->orderBy('designations.name', 'ASC')
            ->orderBy('customers.name', 'ASC')
            ->get();
    }

    public static function allDeletedCustomers(){
        return DB::table('customers')
            ->join('factories', 'factories.id', '=', 'customers.factory')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->leftjoin('departments', 'departments.id', '=', 'customers.department')
            ->select('customers.id', 'customers.employee_id','customers.name',
                'customers.email', 'customers.mobile_no', 'customers.ext_no', 'customers.status',
                'designations.name AS designation', 'factories.factory_name AS factory', 'departments.name AS department')
            ->where('customers.status', '=', 'D')
            ->orderBy('factories.factory_name', 'ASC')
            ->orderBy('departments.name', 'ASC')
            ->orderBy('designations.name', 'ASC')
            ->orderBy('customers.name', 'ASC')
            ->get();
    }

    public static function insertCustomer($request){
        $model = new Customer();

        $model->name = $request->name;
        $model->employee_id = $request->employee_id;

        $model->factory = $request->factory;
        $model->designation = $request->designation;
        $model->department = $request->department;

        $model->job_location = $request->job_location;

        $model->email = $request->email;
        $model->mobile_no = $request->mobile_no;
        $model->ext_no = $request->ext_no;

        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateCustomer($request){
        $model = Customer::find($request->id);
        if($model != null){

            $model->name = $request->name;
            $model->employee_id = $request->employee_id;

            $model->factory = $request->factory;
            $model->designation = $request->designation;
            $model->department = $request->department;

            $model->job_location = $request->job_location;

            $model->email = $request->email;
            $model->mobile_no = $request->mobile_no;
            $model->ext_no = $request->ext_no;

            $model->last_updated_by = Auth::id();

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){

        $model = Customer::find($id);
        if($model != null){
            $data = array(
                'employee_id' => $model->employee_id,
                'factory' => $model->factory,
                'designation' => $model->designation,
                'department' => $model->department,
                'job_location' => $model->job_location,
                'name' => $model->name,
                'email' => $model->email,
                'mobile_no' => $model->mobile_no,
                'ext_no' => $model->ext_no,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDetailByEmpId($emp_id){
        $id = 0;
        $data = DB::table('customers')
            ->select('id')
            ->where('status', '=', 'A')
            ->where('employee_id', '=', $emp_id)
            ->get();

        if($data->count() > 0){
            $id = $data[0]->id;
        }

        $model = Customer::find($id);

        if($model != null){
            $data = array(
                'employee_id' => $model->employee_id,
                'factory' => $model->factory,
                'designation' => $model->designation,
                'department' => $model->department,
                'job_location' => $model->job_location,
                'name' => $model->name,
                'email' => $model->email,
                'mobile_no' => $model->mobile_no,
                'ext_no' => $model->ext_no,
                'id' => $model->id
            );
            return $data;
        }
        $data = array(
            'employee_id' => '',
            'factory' => '',
            'designation' =>'',
            'department' => '',
            'job_location' => '',
            'name' => '',
            'email' => '',
            'mobile_no' => '',
            'ext_no' => '',
            'id' => '',
        );
        return $data;

    }

    public static function returnDelete($id){
        $model = Customer::find($id);

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
        $model = Customer::find($id);
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
        $model = Customer::find($id);
        if($model != null){
            $model->status = 'I';
            if($model->save()){
                return '1';
            }
            return '0';
        }
        return '0';
    }

    public static function getDropDownList($factory, $department){
         $data = DB::table('customers')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->select('customers.id', 'customers.designation','customers.department', 'designations.name', 'customers.employee_id',
                DB::raw('CONCAT(IFNULL(customers.employee_id, " "), " - " , IFNULL(designations.name, " ")," - ",customers.name) AS name'))
            ->where('customers.status', '=', 'A')
             ->where('customers.factory', '=', $factory)
             ->orderBy('customers.employee_id', 'ASC')
            ->orderBy('designations.name', 'ASC')
            ->orderBy('customers.name', 'ASC')
             ->get();

         if($department != 0){
             $data = $data->where('department', '=', $department);
         }


         return $data->pluck("id","name");
        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function getDropDownListSelect($factory, $department){
        $data = DB::table('customers')
            ->leftjoin('designations', 'designations.id', '=', 'customers.designation')
            ->select('customers.id', 'customers.designation','customers.department', 'designations.name', 'customers.employee_id',
                DB::raw('CONCAT(IFNULL(customers.employee_id, " "), " - " , IFNULL(designations.name, " ")," - ",customers.name) AS name'))
            ->where('customers.status', '=', 'A')
            ->where('customers.factory', '=', $factory)
            ->orderBy('customers.employee_id', 'ASC')
            ->orderBy('designations.name', 'ASC')
            ->orderBy('customers.name', 'ASC')
            ->get();

        if($department != 0){
            $data = $data->where('department', '=', $department);
        }


        return $data;
        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function getCustomerContactInfo($id){

    }

    public static function returnCustomerId($employee_id){
        $data = DB::table('customers')
            ->select('id')
            ->where('employee_id', '=', $employee_id)
            ->where('status', '!=', 'D')
            ->get();

        if($data->count() > 0){
            return $data[0]->id;
        }

        return '-1';
    }
}
