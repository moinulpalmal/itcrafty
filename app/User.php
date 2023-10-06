<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



      public function roles()
    {
        return $this->belongsToMany('App\Model\Role');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Model\Task');
    }

    public function hasRole($role)
    {
        if($role != null){
            if($this != null){
                $roles = $this->roles()->where('name', $role)->count();
                if($roles >= 1){
                    return true;
                }
                return false;
            }
            else{
                return redirect()->route('/home');
            }
        }
        else{
            return redirect()->route('/home');
        }
    }

    public function hasTask($role)
    {
        if($role != null){
            if($this != null){
                $roles = $this->tasks()->where('name', $role)->count();
                if($roles >= 1){
                    return true;
                }
                return false;
            }
            else{
                return redirect()->route('/home');
            }
        }
        else{
            return redirect()->route('/home');
        }
    }

     /*public function hasRole($role)
     {
         if($role != null){
             if($this != null){
                 $roles = $this->roles()->where('name', $role)->count();
                 if($roles >= 1){
                     return true;
                 }
                 return false;
             }
             else{
                 return redirect()->route('/home');
             }
         }
         else{
             return redirect()->route('/home');
         }
     }*/

    public static function hasPermission($role, $user_id){
        $user = User::find($user_id);

        $roles = $user->roles()->where('name', $role)->count();
        if($roles >= 1){
            return true;
        }
        return false;
    }

    public static function hasTaskPermission($task, $user_id){
        $user = User::find($user_id);

        $tasks = $user->tasks()->where('name', $task)->count();
        if($tasks >= 1){
            return true;
        }
        return false;
    }

    public function getProfilePicture($id){
        $userImage = User::find($id)->profile_picture;
        if($userImage == null){
            return 'imageFolder/user/user.png';
        }
        else{
            return $userImage;
        }
    }

    public static function getUserListForSelect(){
        return DB::table('users')
            ->select('id', 'name')
            ->where('approved', true)
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function getUserEmailListByTask($task){
        $task =  DB::table('tasks')
            ->select('id', 'name')
            ->where('name', '=', $task)
            ->orderBy('name', 'ASC')
            ->first();

        $task_id = 0;

        if($task){
            $task_id = $task->id;
        }

        $task_users = DB::table('task_user')
            ->select('user_id')
            ->where('task_id', '=', $task_id)
            ->get();

        $user_id_list = array();

        foreach ($task_users AS $users){
            array_push($user_id_list, $users->user_id);
        }


        $user_mails = DB::table('users')
            ->select('email')
            ->whereIn('id', $user_id_list)
            ->get();

        $email_lists = array();
        foreach ($user_mails AS $users){
            array_push($email_lists, $users->email);
        }

        return $email_lists;
    }
}
