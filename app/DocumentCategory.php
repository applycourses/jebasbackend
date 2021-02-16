<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
   protected $table = 'download_categories';
   protected $connection = 'frontend';
}
