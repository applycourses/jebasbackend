<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Deparment;
use App\DeparmentModule;
use App\Module;
use DB;

class departmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $module_id= [];
    public  $department_name;
    public function index()
    {
        $data = Deparment::select('id','name')->paginate(20);
        return view('contents.settings.department.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create the Department id
        $dep= Deparment::create(['name' => $request->name]);
        //create the Department  Module data
        foreach($request->module_id as $key => $value)            
            $response = DeparmentModule::create(['department_id' => $dep->id,'module_id' => $value ]);

       $data = ($response->id) ? ['success' => true , 'message' => 'Successfully Created' ] :  ['success' => false , 'message' => 'Error in  Creating'] ;
       $request->session()->flash('status','Department Created Successfully !');
       return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return $id;
        $data = DB::table('deparments')
                     ->where('deparments.id',$id)
                     ->join('deparment_modules','deparments.id','=','deparment_modules.department_id')                        
                     ->select('deparments.name','deparment_modules.module_id','deparments.id')      
                     ->get();
        
        $this->department_name = $data[0]->name;                
        foreach($data as $key => $value){
            $this->module_id[] = $value->module_id;
        } 
        $data = [
                'id'        =>  $data[0]->id,
                'name'      => $this->department_name,
                'module_id' => json_encode($this->module_id)
        ];  

       return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dep_id = $request->department_id;
        $response = Deparment::where('id',$dep_id)->update(['name'=>$request->name]);
        $delete   = DeparmentModule::where('department_id',$dep_id)->delete();
       // return;
        //$delete->destroy();

        foreach($request->module_id as $key => $value)            
            $response = DeparmentModule::create(['department_id' => $dep_id,'module_id' => $value ]);
            
        $data = ($response) ? ['success' => true , 'message' => 'Successfully Updated' ] :  ['success' => false , 'message' => 'Error in  Updating'] ;
        
        $request->session()->flash('status','Successfully Updated !');
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
