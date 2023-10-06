<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::orderBy('name')->get();

        return view('admin.role.index', compact('roles'));
    }

    public function saveRole(Request $request){
        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = Role::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                $supplier->view_name = $request->view_name;
                if($supplier->save())
                {
                    return 'Saved';
                }
            }
            return 'Updated';
        }
        else
        {
            $supplier = new Role();
            $supplier->name = $request->name;
            $supplier->view_name = $request->view_name;
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateRole(Request $req)
    {
        $supplier = Role::find($req->id);

        if($supplier == null)
            return null;

        $supplierData = array(
            'id' => $supplier->id,
            'name' => $supplier->name,
            'view_name' => $supplier->view_name
        );
        return $supplierData;
    }

}
