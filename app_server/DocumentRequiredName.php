<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentRequiredName extends Model
{
     protected  $table = 'document_names';
     protected $connection  = 'frontend';
}
