<?php

namespace App\Http\Middleware\auth;

use Closure;
use App\DeparmentModule;
use Auth;

class preDeparture
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $id = 9;
    public function handle($request, Closure $next)
    {
        $check = DeparmentModule::where('department_id',Auth::user()->department_id)->where('module_id',$this->id)->get();
        if($check->count() == 1){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}
