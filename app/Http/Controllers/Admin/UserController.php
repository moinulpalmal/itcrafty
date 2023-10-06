<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Department;
use App\Model\Designation;
use App\Model\Factory;
use App\Model\Role;
use App\Model\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(){

        //$factories = Factory::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('admin.user.index', compact('users'));
    }

    public function historicalUser()
    {
        //$factories = Factory::orderBy('name')->get();
        $users = User::onlyTrashed()->orderBy('name')->get();
        return view('admin.user.historical', compact('users'));
    }

    public function newUser()
    {
        $departments = Department::allDepartmentsForSelectField();
        $factories = Factory::allFactoriesForSelectField();
        $designations = Designation::allDesignationsForSelectField();

        return view('admin.user.add', compact('departments', 'factories', 'designations'));
    }

    public function saveUser(Request $request)
    {
        //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        $this->validate($request, [
            'employee_id' => 'required|max:50|min:2',
            'full_name' => 'required|string|max:255|min:2',
            'official_mobile_number' => 'required|numeric',
            'personal_mobile_number' => 'required|numeric',
            'email' => 'required|string|email|max:255|unique:users',
            'official_extension_number' => 'required|numeric',
//            'profile_picture' => 'required|mimes:jpeg,png,jpg',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string|min:1|max:1',
            'designation' => 'required',
            'factory' => 'required',
            'department' => 'required'
            //'employee_joining_date' => 'required|date'
        ]);

        //return $request->all();

        $user = new User();
        $user->employee_id = $request->get('employee_id');
        $user->name = $request->get('full_name');
        $user->department_id = $request->get('department');
        $user->designation_id = $request->get('designation');
        $user->factory_id = $request->get('factory');

        $user->official_mobile_no = $request->get('official_mobile_number');
        $user->personal_mobile_no = $request->get('personal_mobile_number');
        $user->official_extension_no = $request->get('official_extension_number');

        if($request->approval_authority == 'on'){
            $user->approval_authority = true;
        }
        else{
            $user->approval_authority = false;
        }

        $user->email = $request->get('email');
        $user->gender = $request->get('gender');
        $user->password = Hash::make($request->get('password'));

        $user->inserted_by = Auth::user()->id;
       // $user->last_updated_by = Auth::user()->id;

        /*if($request->hasFile('profile_picture')){
            $image = $request->file('profile_picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save( public_path('imageFolder/users/' . $filename));
            $user->profile_picture  = 'imageFolder/users/'.$filename;
        }*/

        if($user->save())
        {
            return redirect()->route('admin.user.detail', ['id'=>$user->id]);
        }
        return redirect()->route('admin.user');
    }

    public function updateUser(Request $request)
    {
        //return $request->all();

        $this->validate($request, [
            'employee_id' => 'required|max:50|min:2',
            'full_name' => 'required|string|max:255|min:2',
            'official_mobile_number' => 'required|numeric',
            'personal_mobile_number' => 'required|numeric',
            'official_extension_number' => 'required|numeric',
            'gender' => 'required|string|min:1|max:1',
            'designation' => 'required',
            'factory' => 'required',
            'department' => 'required'
            //'employee_joining_date' => 'required|date'
        ]);

        //return $requestuest->all();

        $user = User::find($request->id);

        $user->employee_id = $request->get('employee_id');
        $user->name = $request->get('full_name');
        $user->official_mobile_no = $request->get('official_mobile_number');
        $user->personal_mobile_no = $request->get('personal_mobile_number');
        $user->official_extension_no = $request->get('official_extension_number');
        $user->department_id = $request->get('department');
        $user->factory_id = $request->get('factory');
        $user->designation_id = $request->get('designation');
        //$user->employee_joining_date = $request->get('employee_joining_date');
        $user->gender = $request->get('gender');

        if($request->approval_authority == 'on'){
            $user->approval_authority = true;
        }
        else{
            $user->approval_authority = false;
        }

       // $user->inserted_by = Auth::user()->name;
        $user->last_updated_by = Auth::user()->name;

        if($user->save())
        {
            return redirect()->route('admin.user.detail', ['id' => $user->id]);
        }
        return redirect()->route('admin.user');
    }

    public function detail($id){
        //$user = User::with()->roles

        $user = User::find($id);

        //return $user;

        if($user != null){
            $roleList = Role::orderBy('view_name')->get();
            $taskList = Task::orderBy('view_name')->get();

            return view('admin.user.detail',
                compact('user', 'roleList', 'taskList'));
        }

        //$userImage = UserImage::Where('user_id', $id)->first();

        return redirect()->route('admin.user');
    }

    public function resetPassword($id){
        $user = User::find($id);
        if($user != null){
            return view('admin.user.reset-password', compact('user'));
        }

        return redirect()->route('admin.user');
    }

    public function updatePassword(Request $request){
        if(Auth::Check())
        {
            /*$this->validate($request, [
                'password' => 'required|string|min:8|confirmed',
            ]);*/

            $requestData = $request->All();
            $validator = $this->validatePasswords($requestData);
            if($validator->fails())
            {
                return back()->withErrors($validator->getMessageBag());
            }
            else
            {
                $currentPassword = User::find($requestData['user_id'])->password;

                if($requestData['password'] == $currentPassword)
                {
                    //$userId = Auth::User()->id;
                    $user = User::find($requestData['user_id']);
                    $user->password = Hash::make($requestData['new-password']);
                    $user->save();
                    return back()->with('reset-password-success', 'Your password has been updated successfully.');
                }
                else
                {
                    return back()->withErrors(['Sorry, your current password was not recognised. Please try again.']);
                }
            }
        }
        else
        {
            // Auth check failed - redirect to domain root
            return redirect()->to('/');
        }
    }

    public function validatePasswords(array $data)
    {
        $messages = [
            'password.required' => 'Please enter your current password',
            'new-password.required' => 'Please enter a new password',
            'new-password-confirmation.not_in' => 'Sorry, common passwords are not allowed. Please try a different new password.'
        ];

        $validator = Validator::make($data, [
            'password' => 'required',
            'new-password' => ['required', 'same:new-password', 'min:8', Rule::notIn($this->bannedPasswords())],
            'new-password-confirmation' => 'required|same:new-password',
        ], $messages);

        return $validator;
    }

    public function bannedPasswords(){
        return [
            'password', '12345678', '123456789', 'baseball', 'football', 'jennifer', 'iloveyou', '11111111', '222222222', '33333333', 'qwerty123'
        ];
    }


    public function provideAccess(Request $request){
        $user = User::find($request->id);
        if($user != null){
            $user->approved = true;
            if($user->save()){
                return 'success';
            }
            return '0';
        }

        return '0';
    }

    public function blockAccess(Request $request){
        $user = User::find($request->id);
        if($user != null){
            $user->approved = false;
            if($user->save()){
                return 'success';
            }
            return '0';
        }

        return '0';
    }

    public function editUser($id)
    {
        $user = User::find($id);
        //return $user;
        if($user != null){
            $departments = Department::allDepartmentsForSelectField();
            $factories = Factory::allFactoriesForSelectField();
            $designations = Designation::allDesignationsForSelectField();
            return view('admin.user.edit',
                compact( 'user', 'departments', 'designations', 'factories'));
            //return view('admin.user.edit', ['data'=>$user]);
        }
        return redirect()->route('admin.user');
    }

    public function softDelete(Request $request)
    {
        $user = User::find($request->id);
        $user->approved = false;
        $user->save();
        if($user->delete())
        {
            return true;
        }
        return 'Error';
    }

    public function restore(Request $request)
    {
        //return '1';
        $user = User::onlyTrashed()->find($request->id);
        if($user->restore()){
            return '1';
        }
        return '0';
    }

    public function fullDelete(Request $request)
    {
        $user = User::onlyTrashed()
            ->with('roles')
            ->with('tasks')
            ->find($request->id);
        $user->roles()->detach();
        $user->tasks()->detach();
        //File::delete($user->profile_picture);
        if($user->forceDelete()){
            return '1';
        }
        return '0';
    }

    public function applyRole(Request $request){

        $user = User::find($request->user_id);

        //return $request->all();


        $roleList = Role::orderBy('view_name')->get();
        foreach ($roleList as $role) {

            $taskList = Task::orderBy('view_name')
                ->where('role_id', $role->id)
                ->get();

            if(!empty($request->get('r_'.$role->name))){
                if($request->get('r_'.$role->name) == 'on'){
                    if(!User::hasPermission($role->name, $request->user_id)){
                        $user->roles()->attach($role->id);
                        foreach ($taskList as $task) {
                            if(!empty($request->get('t_'.$task->name))){

                                if($request->get('t_'.$task->name) == 'on'){
                                    //return $request->all();
                                    if(!User::hasTaskPermission($task->name, $request->user_id)){
                                        $user->tasks()->attach($task->id);
                                    }
                                }
                                else{
                                    $user->tasks()->detach($task->id);
                                }
                            }
                            else{
                                $user->tasks()->detach($task->id);
                            }
                        }
                    }
                    else{
                        foreach ($taskList as $task) {
                            if(!empty($request->get('t_'.$task->name))){
                                if($request->get('t_'.$task->name) == 'on'){
                                    //return $request->all();
                                    if(!User::hasTaskPermission($task->name, $request->user_id)){
                                        $user->tasks()->attach($task->id);
                                    }
                                }
                                else{
                                    $user->tasks()->detach($task->id);
                                }
                            }
                            else{
                                $user->tasks()->detach($task->id);
                            }
                        }
                    }
                }
                else{
                    $user->roles()->detach($role->id);
                    foreach ($taskList as $task) {
                        $user->tasks()->detach($task->id);
                    }
                }
            }
            else{
                $user->roles()->detach($role->id);
                foreach ($taskList as $task) {
                    $user->tasks()->detach($task->id);
                }
            }
            //if($req->get('IsCHO') == 'on')
        }

        //$taskList = Task::orderBy('view_name')->get();



       /* if($req->get('IsCHO') == 'on')
        {
            $DataUpdate->update('factories','id',$HiddenFactoryID,'is_cho',true);
        }*/

       /* $user = User::find($user_id);
        $user->roles()->attach($role_id);
        return redirect()->route('administration.user.detail', ['id'=>$user->id]);*/

       return 'Update';
    }

    /*public function deleteRole($role_id, $user_id){
        $user = User::find($user_id);

        $user->roles()->detach($role_id);

        //return redirect('/admin/user/detail', ['id' => $user->id]);
        return redirect()->route('administration.user.detail', ['id'=>$user->id]);
    }*/

    public function provideApprovalAccess(Request $request){
        $user = User::find($request->id);
        if($user != null){
            $user->approval_authority = true;
            if($user->save()){
                return 'success';
            }
            return '0';
        }

        return '0';
    }

    public function blockApprovalAccess(Request $request){
        $user = User::find($request->id);
        if($user != null){
            $user->approval_authority = false;
            if($user->save()){
                return 'success';
            }
            return '0';
        }

        return '0';
    }

    public function getUserIssue(Request $request){
        $user = User::find($request->id);
        if($user != null){
            $data = array(
                'name' => $user->name,
                'factory_id' => $user->factory_id,
                'department_id' => $user->department_id,
                'id' => $user->id
            );
            return $data;

        }

        return '0';
    }

    public function getUserInfo(Request $request){
        $user = User::where('employee_id', $request->code)->first();
        if($user != null){
            $data = array(
                'name' => $user->name,
                'factory_id' => $user->factory_id,
                'department_id' => $user->department_id,
                'designation' => $user->designation,
                'official_mobile_no' => $user->official_mobile_no,
                'official_extension_no' => $user->official_extension_no,
                'id' => $user->id,
                'employee_joining_date' => $user->employee_joining_date,
            );
            return $data;
            //return json_encode($data);
        }
        else{
            $data = array(
                'name' => '',
                'factory_id' => '',
                'department_id' => '',
                'designation' => '',
                'official_mobile_no' => '',
                'official_extension_no' => '',
                'id' => '',
                'employee_joining_date' => ''
            );
            return $data;
        }
    }
}
