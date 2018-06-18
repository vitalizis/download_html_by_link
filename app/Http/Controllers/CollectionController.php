<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use App\SavedPage;
use App\SavedApp;

class CollectionController extends Controller
{
    public function handlerFormCollection(Request $request){
    	$collection = new Collection();
    	$collection->saveCollection($request);
    	return redirect('/');
    }

    public function editCollection($id){
    $itemsPages = SavedPage::all(['id', 'link']);
    $itemsApp = SavedApp::all(['id', 'name_app']);
    return view('edit', compact('itemsPages','itemsApp','id'));
    }

    public function storeCollection(Request $request){
    $userSelect = $request->get('collection_id');
    dd($userSelect); // or dd($request->all());
    	return redirect('/');
    }
}
