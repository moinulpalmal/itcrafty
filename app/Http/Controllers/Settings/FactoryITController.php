<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Model\FactoryIt;
use Illuminate\Http\Request;

class FactoryITController extends Controller
{
    public function index(){
        $factories = FactoryIt::allNotDeleteFactoryIts();
        return view('settings.factory-it', compact('factories'));
    }

    public function save(Request $request){
        //return $request->all();
        if($request->id != null){
            return FactoryIt::updateFactoryIt($request);
        }
        else{
            return FactoryIt::insertFactoryIt($request);
        }
    }

    public function edit(Request $request){
        return FactoryIt::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return FactoryIt::returnDelete($request->id);
    }

    public function activate(Request $request){
        return FactoryIt::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return FactoryIt::returnDeActivate($request->id);
    }
}
