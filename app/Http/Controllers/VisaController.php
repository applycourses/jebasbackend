<?php

namespace App\Http\Controllers;

use App\StudentList;
use App\Visa;
use App\VisaSetting;
use App\VisaStatus;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Visa::orderBy('id','DESC')->paginate(50);
        return view("contents.crm.visa.list",compact('data'));
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
        //
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
        return view("contents.crm.visa.edit",compact('data'));
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
       $data =  Visa::find($id);
       $resp = $data->delete();
       if($resp)
           return response()->json('success',true);
       else
           return response()->json('success',false);
    }

    public function updateProcessBy(Request $request){
        $this->validate($request,[
            'visa_id'       => 'required',
            'student_id'    => 'required',
            'processed_by'  => 'required',
        ]);
       $data =  Visa::where('student_id',$request->student_id)
                        ->where('id',$request->visa_id)
                        ->firstOrFail();

       $resp = $data->update(['processed_by' => $request->processed_by]);
       if($resp){

           return response()->json(['success' => true]);
       }else{
           return response()->json(['success' => false]);
       }

    }
    public function updateWithdrawnStatus(Request $request){
        $this->validate($request,[
            'visa_id'       => 'required',
            'student_id'    => 'required',
            'status'        => 'required',
        ]);
        $status = (bool)$request->status;


        $data =  Visa::where('student_id',$request->student_id)
                        ->where('id',$request->visa_id)
                        ->firstOrFail();
        $updateData = [
            'withdrawn_status' => $status,
            'withdrawn_type' => $request->type,
            'withdrawn_reason' => $request->reason,
        ];

        $resp = $data->update($updateData);
        if($resp){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
    public function updateDependent(Request $request){
        $data = [];
        foreach($request->name as $key => $value){
            $data[$key]['name'] = $value;
            $data[$key]['relationship'] = $request->relationship[$key];
            $data[$key]['dob'] = $request->dob[$key];
            $data[$key]['price'] = $request->price[$key];
        }
        $old = Visa::find($request->visa_id);

        $resp =$old->update(['dependents' => $data]);
        if($resp){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
    public function statusUpdate(Request $request){
      $this->validate($request,[
          'student_id' => 'required',
          'visa_id' => 'required',
          'category' => 'required',
      ]);
      // Stage
      $state_change = ['Visa Document Verified','Other Visa Formalities Completed','Visa Fees Paid','Visa Under Process','Visa Decision Rejected','Visa Decision Granted','Moved to Pre Departure'];
      // Email send
      $email_change = [
                        'Visa Document Pending',
                        'Visa Document Verified',
                        'Other Visa Formalities Pending',
                        'Other Visa Formalities Completed',
                        'Visa Fees Pending',
                        'Visa Fees Paid',
                        'Visa Under Process',
                        'Visa Decision Rejected',
                        'Visa Decision Granted',
                        'Refund Under Process',
                        'Refund Completed',
                        // 'Withdrawn',
                        'Moved to Pre Departure'
                      ];

      if(in_array($request->category,$email_change)){
        $this->sendEmail($request->all());
      }
      if(in_array($request->category,$state_change)){
          $this->updateStage($request);
      }
      $attachment = [];
      if($request->hasFile('img')){
          foreach($request->file('img') as $key => $value){
              $s3                          = Storage::disk('s3');
              $filePath                    = 'visa/'.$request->student_id.'/'.uniqid().$request->image;
              $image_path                  = $s3->put($filePath,$request->img[$key], 'public');
              $attachment[$key]    =  $image_path;
          }
      }

      $data =[
          'student_id' => $request->student_id,
          'visa_id'    => $request->visa_id,
          'category'   => $request->category,
          'remarks'    => $request->remarks,
          'attachment' => $attachment
      ];

      $data = VisaStatus::create($data);
        if($data->id){

            $data = Visa::find($request->visa_id);
            $data->update(['status'=>$request->category]);
            //admin log
            $data = [ 'student_id' =>$request->student_id, 'activity' => "Visa Status Updated to $request->category" ];
            insertAdminLog($data);
            return back();
        }else{
            return back();
        }
    }
    //update Stage of the student and send email
    private function updateStage($request){
        $category = $request->category;
        $student = StudentList::find($request->student_id);
        $email_data = [
            'name' => $student->name,
            'email' => $student->email,
            'course_name' => $student->email,
        ];
        if($category == 'Visa Document Pending') {
            updateStage(16,$request->student_id);
        }elseif($category == 'Visa Document Verified'){
            updateStage(17,$request->student_id);
        }elseif($category == 'Other Visa Formalities Completed'){
            updateStage(18,$request->student_id);
        }elseif($category == 'Visa Under Process'){
            updateStage(19,$request->student_id);
        }elseif($category == 'Visa Decision Rejected'){
            updateStage(20,$request->student_id);
        }elseif($category == 'Visa Decision Granted'){
            updateStage(20,$request->student_id);
        }elseif($category = 'Moved to Pre Departure'){
            updateStage(21,$request->student_id);
        }

    }
    // Student Id as input
    private function sendEmail($data){
      $student_id = $data['student_id'];
      $category   = $data['category'];
      $visa_id    = $data['visa_id'];
      //retrive student details
      $student_detail    = StudentList::find($student_id);
      $visa_detail       = Visa::find($visa_id);
      $course_detail     = $visa_detail->course_applied->course;
      $university_detail = $visa_detail->course_applied->course;

      if($category == 'Visa Document Pending')
        Mail::to($student_detail->email)->send(new \App\Mail\visa\documentPending($student_detail));
      if($category == 'Visa Document Verified')
         Mail::to($student_detail->email)->send(new \App\Mail\visa\documentVerified($student_detail));
      if($category == 'Other Visa Formalities Pending')
         Mail::to($student_detail->email)->send(new \App\Mail\visa\otherFormalitiesPending($student_detail));
      if($category == 'Other Visa Formalities Completed')
          Mail::to($student_detail->email)->send(new \App\Mail\visa\otherFormalitiesCompleted($student_detail));
      if($category == 'Visa Fees Pending')
          Mail::to($student_detail->email)->send(new \App\Mail\visa\feesPending($student_detail));
      if($category == 'Visa Fees Paid')
        Mail::to($student_detail->email)->send(new \App\Mail\visa\feesPaid($student_detail));
      if($category == 'Visa Under Process')
        Mail::to($student_detail->email)->send(new \App\Mail\visa\underProces($student_detail));
      if($category == 'Visa Decision Rejected')
        Mail::to($student_detail->email)->send(new \App\Mail\visa\decisionRejected($student_detail,$university_detail));
      if($category == 'Visa Decision Granted')
        Mail::to($student_detail->email)->send(new \App\Mail\visa\decisionGranted($student_detail,$university_detail,$course_detail));
      if($category == 'Refund Under Process')
        Mail::to($student_detail->email)->send(new \App\Mail\visa\refundUnderProcess($student_detail,$university_detail,$course_detail));
      if($category == 'Refund Completed')
        Mail::to($student_detail->email)->send(new \App\Mail\visa\refundCompleted($student_detail,$university_detail,$course_detail));

          // 'Visa Fees Paid',
          //               'Visa Under Process',
          //               'Visa Decision Rejected',
          //               'Visa Decision Granted',
          //               'Refund Under Process',
          //               'Refund Completed',





    }
}
