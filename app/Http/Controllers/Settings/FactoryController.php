<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Model\Factory;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    public function index(){
        $factories = Factory::allNotDeleteFactories();
       // return $factories;
        return view('settings.factory', compact('factories'));
    }

    public function save(Request $request){
        //return $request->all();
        if($request->id != null){
            return Factory::updateFactory($request);
        }
        else{
            return Factory::insertFactory($request);
        }
    }

    public function edit(Request $request){
        return Factory::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return Factory::returnDelete($request->id);
    }

    public function activate(Request $request){
        return Factory::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return Factory::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        if($request->check == 1){
            $DropDownData = Factory::getDropDownList();
            return json_encode($DropDownData);
        }

        return null;
    }

}
