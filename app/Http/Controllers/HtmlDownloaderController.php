<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SavedPage;
use App\Collection;
use Illuminate\Support\Facades\Storage;

class HtmlDownloaderController extends Controller
{
    public function index(){
    	$collections = Collection::all(['id', 'name_collection']);
    	return view('main', compact('collections'));
    }

    public function handlerForm(Request $request){
    	$validatedLink = $this->validate($request,['link' => 'required|url']);
    	$this->storeFile($validatedLink);
    	$this->storeDB($validatedLink);
    	return redirect('/');
    }

    public static function getCostStorage($validatedLink){
    	$name = hash_file('md5', $validatedLink['link']);
    	$byteValue = Storage::size($name);
    	$kByteValue = $byteValue/1000;
    	$cost = $kByteValue*0.001;
    	return $cost;
    }

    public static function storeDB($validatedLink){
    	$savedPage = new SavedPage();
    	$savedPage->link = $validatedLink['link'];
    	$savedPage->cost=HtmlDownloaderController::getCostStorage($validatedLink);
    	$savedPage->page_hash=HtmlDownloaderController::getHashPage($validatedLink);
    	$savedPage->save();
    }

    public static function storeFile($validatedLink){
    $url = $validatedLink['link'];
	$contents = file_get_contents($url);
	$name = hash_file('md5', $url);
	Storage::put($name, $contents);
    }

    public static function getHashPage($validatedLink){
    	$url = $validatedLink['link'];
    	$hashPage = hash_file('md5', $url);
    	return $hashPage;
    }
}
