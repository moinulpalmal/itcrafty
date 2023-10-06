<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(){
        $roles = Role::orderBy('name')->get();

        $tasks = DB::table('tasks')
            ->join('roles', 'roles.id', '=', 'tasks.role_id')
            ->select('roles.view_name AS role_name', 'tasks.id', 'tasks.name', 'tasks.view_name')
            ->orderBy('roles.view_name', 'ASC')
            ->orderBy('tasks.name', 'ASC')
            ->get();

        return view('admin.task.index', compact('roles', 'tasks'));
    }

    public function saveTask(Request $request){
        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = Task::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                $supplier->role_id = $request->role_name;
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
            $supplier = new Task();
            $supplier->name = $request->name;
            $supplier->role_id = $request->role_name;
            $supplier->view_name = $request->view_name;
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateTask(Request $req)
    {
        $supplier = Task::find($req->id);

        if($supplier == null)
            return null;

        $supplierData = array(
            'id' => $supplier->id,
            'role_id' => $supplier->role_id,
            'name' => $supplier->name,
            'view_name' => $supplier->view_name
        );
        return $supplierData;
    }
}
