<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Logs extends Model
{
    protected $fillable = [
        'category', 'category_id', 'action', 'action_on', 'action_by', 'action_by_type',
    ];


    public static function GenerateLog($data){
        $insert_data = [
            'category'       => 'course-list',
            'action_by_type' => 'admin',
            'action_on'      => Carbon::now()->format('Y-m-d'),
            'action_by'      => Auth::user()->id,
            'category_id'    => $data['category_id'],
            'action'         => $data['action']
        ];

        $response = Logs::create($insert_data);
        return ($response->id) ? true : false;
    }

}
