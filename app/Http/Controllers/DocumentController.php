<?php

namespace App\Http\Controllers;

use App\StudentDocument;
use App\StudentList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $student = StudentList::find($request->student_id);

        if($request->behalfOf == 'student'){
            $input['student'] = 1;
        }
        if($request->behalfOf == 'admin'){
            $input['admin'] = 1;
        }
        $input['student_id']     = $request->student_id;
        $input['category']       = $request->category;
        $input['course']         = $request->course;
        $input['student_reg_id'] = $student->stu_id;
        $input['document_id']    = $request->name;

        $type       = 'documents';
        $year       = Carbon::now()->year;
        $student_id = $request->student_id;
        $path       = $year . '/' . $student_id . '/' . $type;
        $s3         = \Storage::disk('s3');
        $input['path'] = $s3->put($path, $request->file, 'public');

        $input['uploaded_by'] = $request->behalfOf;
        $input['uploaded_id'] = Auth::user()->id;
        $data = StudentDocument::create($input);
        if($data->id){
            return response()->json(['message' => true]);
        }else{
            return response()->json(['message' => false]);
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
        //
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
    public function destroy($id)
    {
        //
    }
}
