<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'collections';

    public function saveCollection($data){
    	$this->name_collection = $data['name_collection'];
        $this->save();
        return 1;
    }
}
