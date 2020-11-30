<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected  $connection = 'frontend';
    protected $fillable = [ 'type', 'notifiable_id', 'notifiable_type', 'data', 'read_at'];
    protected  $table = 'users_activities';

}
