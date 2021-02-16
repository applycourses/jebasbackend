<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Download extends Model
{
	protected $fillable = [
      'university_id', 'download_category_id', 'document_name', 'path_name'
    ];
	
    public function university(){
    	return $this->belongsTo('App\University');
    }

    public function download_category(){
    	return $this->belongsTo('App\DownloadCategory');
    }
}
