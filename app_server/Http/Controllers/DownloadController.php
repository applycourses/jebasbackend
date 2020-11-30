<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\University;
use App\Download;
use App\DownloadCategory;
use Storage;
class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if($request->name){

    		$universites =  University::where('name','like','%'.$request->name.'%')->select('id','name')->paginate(20);
    	}else{
    		$universites =  University::select('id','name')->paginate(20);
    	}
        // return $universites;

     	return view('contents.download.list',compact('universites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $this->validate($request, [
                "university_id"        => "required",
                "university_name"      => "required",
                "document_name"        => 'required',
                "file"                 => "required|mimes:pdf,doc,docx|max:5000",
                "download_category_id" => "required",
        ]);

        $input                  = $request->all();
        $download_category_name = DownloadCategory::find($request->download_category_id)->name;

        if($request->document_name == "newcategory")
        {
           $response                      = DownloadCategory::create(['name', $request->newcategory_name]);
           $input['download_category_id'] = $response->id;
           $download_category_name        = $request->newcategory_name;
        }

        $s3                 = \Storage::disk('s3');
        $filePath           = $request->university_name.'/downloads/'.$download_category_name;
        $path               = $s3->put($filePath, $request->file, 'public');
        $input['path_name'] = $path;


        $response= Download::create($input);
        if($response->id){
            $request->session()->flash('status','Successfully Uploaded');
            return back();
        }else{
            $request->session()->flash('status','Error in uploading the Document');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data            = Download::where('university_id',$id)->get();
        $university_data = University::find($id);
        $categories      = DownloadCategory::all();
        return view('contents.download.edit',compact('data','university_data','categories'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

       $data = Download::find($request->id);
       $data->delete();


        if(Storage::disk('s3')->exists($data->path_name)) {
          $response = Storage::disk('s3')->delete($data->path_name);
        }

        if($response){
               if($response){
                    $request->session()->flash('status','Successfully Deleted');
                    $data = ['success' => true , 'message' => 'Successfully Deleted'];
               }else{
                    $request->session()->flash('status','Error in Deleting');
                    $data = ['success' => false , 'message' => 'Error in  Deleting'];
               }
        }else{
             $request->session()->flash('status','Error in Deleting');
             $data = ['success' => false , 'message' => 'Error in  Deleting'];
        }
         return response()->json($data);

    }
}
