<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseApplied;
use App\RequestFreeInfo;
use App\RequestFreeInfoReply;
use App\StudentList;
use App\University;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class RequestFreeInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $university  = University::pluck('name','id')->where('status',0)->all();

        if($request->has('search'))
        {
           $query = RequestFreeInfo::where('id','>','1');
           if($request->has('name'))
           {
               $student_detail = StudentList::where('name','like','%'.$request->name.'%')
                                            ->orWhere('stu_id','like','%'.$request->name.'%')
                                            ->get();

               if($student_detail->count() > 0)
                   $query->where('student_id',$student_detail[0]->id);
           }

           if($request->has('university_id')){

               $query->where('university_id',$request->university_id);
           }
           /*if($request->has('daterangepicker_start') && $request->has('daterangepicker_end'))
           {
               $start_date = Carbon::parse($request->daterangepicker_start)->format('Y-m-d H:m:s');
               $end_date   = Carbon::parse($request->daterangepicker_end)->format('Y-m-d H:m:s');
               $query->where('created_at','<=',$start_date)->where('created_at','>=',$end_date);
           }*/

           $data = $query->orderBy('id','DESC')->paginate(50);

           return view('contents.request-free-info.list',compact('data','university'));

        }else{
            $data = RequestFreeInfo::orderBy('id','DESC')->paginate(50);
            return view('contents.request-free-info.list',compact('data','university'));
        }

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

        $enquiry_no = $request->enquiry_no;
        $message    = $request->message;

        $enquiry_details         = RequestFreeInfo::where('enquiry_no',$enquiry_no)->first();
        $data['student_id']      = $enquiry_details->student_id;
        $data['university_id']   = $enquiry_details->university_id;
        $data['course_id']       = $enquiry_details->course_id;
        $data['message']         = $message;
        $data['ip']              = $request->ip();

        $data['admin'] = 1;
        $data['enquiry_no'] =$enquiry_no;
        $response = RequestFreeInfoReply::create($data);
        if($response)
            $request->session()->flash('success','Successfully Sent the message');
        else
            $request->session()->flash('danger','Error in sending message');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $data =  RequestFreeInfoReply::where('enquiry_no',$id)->get();
       return view('contents.request-free-info.view',compact('data'));
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
