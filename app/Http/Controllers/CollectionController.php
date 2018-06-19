<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use App\SavedPage;
use App\SavedApp;
use App\ContentCollection;
use DB;

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
		$all_collection = CollectionController::tableAppsAndPages($id);
		$cost = CollectionController::sumByCost($id);
		return view('edit', compact('itemsPages','itemsApp','id','all_collection', 'cost'));
	}

	public function storeCollection(Request $request){
		$userSelect = $request->get('item_id');
		$collectionId= $request->get('collection_id');
		$pageList = [];
		$appList = [];
		foreach($userSelect as $key => $value) {
			if(substr($value,0,4)=='page'){
				$value = str_replace("page", "", $value);
				$pageList[] = $value;
			}

			if(substr($value,0,3)=='app'){
				$value = str_replace("app", "", $value);
				$appList[] = $value;
			}
		}
		foreach ($pageList  as $key => $value) {
			$contentCollection = new ContentCollection();
			$contentCollection->saved_page_id =$value; 
			$contentCollection->collection_id = $collectionId;
			$contentCollection->save();
		}
		foreach ($appList as $key => $value) {
	# code...
			$contentCollection = new ContentCollection();
			$contentCollection->saved_app_id = $value;
			$contentCollection->collection_id = $collectionId;
			$contentCollection->save();
		}

// $all_collection = DB::union($collection_app);
    // dd($pageList, $appList); // or dd($request->all());
		return redirect('/');
	}

	public static function tableAppsAndPages($id){
		$collection_app = DB::table('content_collections')
		->join('saved_apps', 'content_collections.saved_app_id', '=', 'saved_apps.id')
		->select('saved_apps.name_app as name', 'saved_apps.cost as cost')
		->where('collection_id','=',$id);

		$all_collection = DB::table('content_collections')
		->join('saved_pages', 'content_collections.saved_page_id', '=', 'saved_pages.id')
		->select('saved_pages.link as name', 'saved_pages.cost as cost')
		->union($collection_app)
		->where('collection_id','=',$id)
		->get();
		return $all_collection;
	}

	public static function sumByCost($id){

		$sum_app =  DB::table('content_collections')
		->join('saved_apps', 'content_collections.saved_app_id', '=', 'saved_apps.id')
		->where('collection_id','=',$id)
		->sum('saved_apps.cost');
		$sum_page = DB::table('content_collections')
		->join('saved_pages', 'content_collections.saved_page_id', '=', 'saved_pages.id')
		->where('collection_id','=',$id)
		->sum('saved_pages.cost');
		$sum = $sum_app+$sum_page;
		return $sum;
	}
}
