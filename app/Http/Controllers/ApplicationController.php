<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SavedApp;

class ApplicationController extends Controller
{
    public function handlerFormApp(Request $request){
    	$this->storeDB($request);
    	return redirect('/');
    }

        public static function storeDB($request){
    	$savedApp = new SavedApp();
    	$savedApp->name_app = $request->name_app;
    	$savedApp->cost=$request->cost;
    	$savedApp->save();
    }
}
