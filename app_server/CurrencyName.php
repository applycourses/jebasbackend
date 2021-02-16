<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyName extends Model
{
    protected $connection = 'frontend';
    protected $table = 'currencies';
}
