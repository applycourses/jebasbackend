<?php

namespace App\Http\Middleware\auth;

use Closure;
use App\DeparmentModule;
use Auth;

class enquiryMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $enquiry_id = 2;
    
    public function handle($request, Closure $next)
    {
        $check = DeparmentModule::where('department_id',Auth::user()->department_id)->where('module_id',$this->enquiry_id)->get();
        if($check->count() == 1){
            return $next($request);
        }else{
            return redirect('/');
        }
        
    }
}
