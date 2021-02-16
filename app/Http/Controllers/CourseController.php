<?php

namespace App\Http\Controllers;

use App\Application;
use App\Download;
use App\Mail\CourseShortlist;
use App\University;
use Illuminate\Http\Request;
use App\CourseApplied;
use App\Comment;
use Auth;
use App\Course;
use App\Documents;
use Carbon\Carbon;
use App\StudentList;
use App\Logs;
use App\Stage;
use Illuminate\Support\Facades\Mail;
use App\Mail\course\shortlistMail as ShortlistMail;
use App\Mail\course\confirm as ConfirmMail;
use App\Mail\course\document_verified as DocumentVerifiedMail;
use App\Mail\course\applicationMail as ApplicationVerifiedMail;
use App\Mail\course\withdrawlConfirm ;

class CourseController extends Controller
{
    private $student_id;
    private $course_id;
    public  $course_data;

    public  $input  =  [
                 'category'       => 'course-list',
                 'action_by_type' => 'admin'
             ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course_applieds = CourseApplied::join('users','course_applieds.student_id','=','users.id')
                                        ->select('users.stu_id','users.name','course_applieds.university_id','course_applieds.campus',
                                            'course_applieds.course_id','course_applieds.shortlisted_on','course_applieds.status',
                                            'course_applieds.id','course_applieds.student_id')
                                        ->orderBy('course_applieds.created_at','DESC')
                                        ->paginate(20);

       return  view('contents.crm.course.list',compact('course_applieds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
       $courses = Course::paginate(20);
       return  view('contents.crm.course.assign',compact('courses'));
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
       $data = CourseApplied::find($id);
       $logs = Logs::where('category','course-list')->where('category_id',$id)->orderBy('id','DESC')->get();
       $documents =  Documents::where('student_id',$data->student_id)->pluck('document_id');
       $documents = $documents->toArray();
       return view('contents.crm.course.view',compact('data','logs','documents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = CourseApplied::find($id);
        return view('contents.crm.course.edit',compact('data'));
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

       $old =  CourseApplied::find($id);
//       return $request->all();
        if($request->remove_shortlisted == 'yes')
        {
             $response =  CourseApplied::course_removed($id);
                $logs_data =  [
                    'category_id' =>  $id ,
                    'action'      => 'Removed from Shortlist'
                ];

                CourseApplied::GenerateLog($logs_data);
                $data = [ 'student_id' =>$old->student_id, 'activity' => "Course Removed from shortlist" ];
                insertAdminLog($data);

            if($response){$request->session()->flash('status','Successfully Removed from Shorlist'); return redirect('course-list'); }
        }else{
             $input = $request->all();
             if($request->application_form == 'yes')
             {
                 if(!$old->application_form_on)
                 {
                     $input['application_form_on'] = Carbon::now()->format('Y-m-d');
                     $course_id = get_course_id($id);
                     $stu_data  = get_student_fname($id);
                     $this->sendApplicationVerifiedMail($course_id,$stu_data);
                     $logs_data =  [
                         'category_id' =>  $id,
                         'action'      => 'Application Form Verification '
                     ];
                     Stage::UpdateStage($stu_data->id,9);
                     CourseApplied::where('id',$id)->first()->update(['status' => 'Application Form Verified']);
                     $data = [ 'student_id' =>$old->student_id, 'activity' => "Course Application Form Verified" ];
                     insertAdminLog($data);
                     CourseApplied::GenerateLog($logs_data);
                 }

             }
             if($request->moved_to_application != 'no' && $request->moved_to_application != '')
             {
                 $stu_data  = get_student_fname($id);

                 if(!$old->moved_to_application_on){
                     $input['moved_to_application_on'] = Carbon::now()->format('Y-m-d');

                     $application['course_applied_id'] = $old->id;
                     $application['student_id'] = $old->student_id;
                     $application['status'] = 'New';
                     Application::create($application);
                     $logs_data =  [
                         'category_id' =>  $id,
                         'action'      => 'Moved to Application'
                     ];
                     CourseApplied::GenerateLog($logs_data);
                     Stage::UpdateStage($stu_data->id,10);
                     CourseApplied::where('id',$id)->first()->update(['status' => 'Moved to Application']);
                     $data = [ 'student_id' =>$old->student_id, 'activity' => "Course Moved to Application" ];
                     insertAdminLog($data);

                 }

             }

             if($request->document_verified == 'yes')
             {
                 $input['document_verified_on'] = Carbon::now()->format('Y-m-d');
                 if(!$old->document_verified_on)
                 {
                     $course_id = get_course_id($id);
                     $stu_data = get_student_fname($id);
                     $this->sendDocumentVerifiedMail($course_id, $stu_data);
                     $logs_data = [
                         'category_id' => $id,
                         'action'      => 'Document Verification Email'
                     ];
                     Stage::UpdateStage($stu_data->id,8);
                     CourseApplied::where('id',$id)->first()->update(['status' => 'Document Verified']);
                     CourseApplied::GenerateLog($logs_data);
                     $data = [ 'student_id' =>$old->student_id, 'activity' => "Document Verified to Application" ];
                     insertAdminLog($data);
                 }
             }
              $response = CourseApplied::find($id)->update($input);
              if($response){$request->session()->flash('status','Successfully Updated'); return back(); }
        }


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

    public function remarks(Request $request)
    {
      $id         = $request->id;
      $comments   =   Comment::select('comments.user_id','comments.comment','comments.created_at','users.name')
                              ->where('comments.type','course-list')
                              ->where('comments.type_id',$id)
                              ->orderBy('comments.created_at','DESC')
                              ->join('users','users.id','=','comments.user_id')
                              ->get();
      return response()->json($comments);
    }

    public function Submitremarks(Request $request)
    {
        $input            = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['type']    = 'course-list';

        $response         = Comment::create($input);
        if($response->id){
            $data = ['success' => true , 'message' => 'Succesfully Inserted' ];
        }else{
             $data = ['success' => false , 'message' => 'Error in Inserting Try Again Later . Contact Admin' ];
        }
        return response()->json($data);
    }

    public function assign_course(Request $request)
    {
        $this->course_id               = $request->course_id;
        $this->student_id              = $request->student_id;
        $university_course_campus_data = $this->get_univerisity_id_and_campus_id();


        if(!$this->get_student_id_on_student_reg_id()){
            $request->session()->flash('status','No Student Exist with '.$this->student_id);
            return  back();
        }

        $data['course_id']      = $request->course_id;
        $data['student_id']     = $this->get_student_id_on_student_reg_id();
        $data['university_id']  = $university_course_campus_data->uni_id;
        $data['campus_id']      = get_first_campus_name($university_course_campus_data->campus_id);
        $data['status']         = 'shortlisted';
        $data['shortlisted']    = 'yes';
        $data['shortlisted_on'] = Carbon::now()->format('Y-m-d');
      // return $data;
        $response =  CourseApplied::create($data);

        if($response->id){
            //return $response->id;
             $stu_data =  get_student_fname($response->id);
             $request->session()->flash('status','Successsfully Assigned');
             $stu_data = get_student_fname($response->id);

             $email_data = [
                'course_name'        =>  CourseApplied::course_name($response->id),
                'univ_name'         =>  CourseApplied::university_name($response->id),
                'first_name'       => $stu_data->fname,
                'applied_course_id' => $response->id,
                'uni_slugs' => CourseApplied::university_slug($response->id),
                'cou_slugs' => CourseApplied::course_slug($response->id)
             ];

                $logs_data =  [
                    'category_id' =>  $response->id ,
                    'action'      => 'Shorlisted'
                ];


             CourseApplied::GenerateLog($logs_data);

             Mail::to($stu_data->email)->send(new ShortlistMail($email_data));

             $logs_data =  [
                 'category_id' =>  $response->id ,
                 'action'      => 'Shorlisted Mail Send'
             ];
             CourseApplied::GenerateLog($logs_data);

             return   back();
        }else{
             $request->session()->flash('status','Error in  Assigning');
           return  back();
        }
    }

    private function get_univerisity_id_and_campus_id(){
      $data =   Course::where('courses.id',$this->course_id)
                        ->join('universities','courses.university_id','=','universities.id')
                        ->select('courses.campus_id','courses.university_id as uni_id','universities.name')
                        ->first();
      return $data;

    }
    private function get_student_id_on_student_reg_id(){
        $data = StudentList::where('stu_id',$this->student_id) ->select('id')->count();
        if($data == 1){
             $data = StudentList::where('stu_id',$this->student_id) ->select('id')->first()->id;
             return $data;
        }else{
            return false;
        }
    }

    public function sendmail(Request $request){
            $type  = $request->id;
            $id    = $request->val;

            if($type == 'shortlistMail'){
                $course_id = get_course_id($id);
                $stu_data  = get_student_fname($id);
                $response  = $this->sendShortListMail($course_id,$stu_data,$id);
                // generate logs
                $logs_data =  [
                    'category_id' =>  $id,
                    'action'      => 'Shorlisted Mail Send'
                ];
                CourseApplied::GenerateLog($logs_data);
            }

            if($type == 'applicationMail'){
                $course_id =  get_course_id($id);
                $stu_data  =  get_student_fname($id);
                $response  =  $this->sendConfirmMail($course_id,$stu_data);

                // generate logs
                $logs_data =  [
                    'category_id' =>  $id,
                    'action'      => 'Confirm Mail Send'
                ];
                CourseApplied::GenerateLog($logs_data);
            }

            if($type == 'documentVerificationMail'){

                $course_id =  get_course_id($id);
                $stu_data  =  get_student_fname($id);
                $response  =  $this->sendDocumentVerifiedMail($course_id,$stu_data);
                // generate logs
                $logs_data =  [
                    'category_id' =>  $id,
                    'action'      => 'Document Verification Email'
                ];
                CourseApplied::GenerateLog($logs_data);
            }
            if($type == 'applicationVerification'){
                $course_id =  get_course_id($id);
                $stu_data  =  get_student_fname($id);
                $response  =  $this->sendApplicationVerifiedMail($course_id,$stu_data);
                // generate logs
                $logs_data =  [
                    'category_id' =>  $id,
                    'action'      => 'Application Verified Email'
                ];
                CourseApplied::GenerateLog($logs_data);
            }
            if($response){
                $request->session()->flash('status','Successfully Send email');
                return response()->json(['success' => true]);
            }

    }
    /*
        with course_id get all this department
        First Name from database,
        Course Name
        University Name
    */
    public function sendShortListMail($course_id,$stu_data,$course_applied_id){
        $data =   Course::where('courses.id',$course_id)
                        ->join('universities','courses.university_id','=','universities.id')
                        ->select('courses.name','courses.university_id as uni_id','universities.name as uni_name')
                        ->first();
        $email_data = [
            'course_name' => $data->name,
            'univ_name'   => $data->uni_name,
            'first_name'  => $stu_data->fname,
            'applied_course_id' => $course_applied_id
        ];
        Mail::to($stu_data->email)->send(new ShortlistMail($email_data));
        return true;

    }
    public function sendConfirmMail($course_id,$stu_data){

        $data = Course::where('courses.id',$course_id)
                            ->join('universities','courses.university_id','=','universities.id')
                            ->join('currencies','currencies.id','=','universities.currency_id')
                            ->select('courses.name','courses.university_id as uni_id','universities.name as uni_name','courses.duration','courses.fee','universities.application_fee','currencies.name as cur_name')
                            ->first();

        $downloads = Download::where('downloads.university_id',$data->uni_id)
                               ->where('download_categories.name','=','Applications')
                               ->join('download_categories','download_categories.id','=','downloads.download_category_id')
                               ->get();


        $email_data = [
                        'course_name'     => $data->name,
                        'univ_name'       => $data->uni_name,
                        'duration'        => $data->duration,
                        'course_fee'      => $data->fee,
                        'application_fee' => $data->application_fee,
                        'first_name'      => $stu_data->fname,
                        'downloads'       => $downloads,
                        'currency'        => $data->cur_name,
                        'uni_slugs'       => CourseApplied::university_slug($course_id),
                        'cou_slugs'       => CourseApplied::course_slug($course_id)
        ];
        Mail::to($stu_data->email)->send(new  ConfirmMail($email_data));
        return true;
    }
    public function sendDocumentVerifiedMail($course_id,$stu_data){
        $data = Course::where('courses.id',$course_id)
                        ->join('universities','courses.university_id','=','universities.id')
                        ->select('courses.name','courses.university_id as uni_id','universities.name as uni_name','courses.duration','courses.fee','universities.application_fee')
                        ->first();
        $email_data = [
            'course_name'     => $data->name,
            'university_name' => $data->uni_name,
            'first_name'      => $stu_data->fname,
            'uni_slugs'       => CourseApplied::university_slug($course_id),
            'cou_slugs'       => CourseApplied::course_slug($course_id),
            'application_fee' => $data->application_fee
        ];

        Mail::to($stu_data->email)->send(new  DocumentVerifiedMail($email_data));
        return true;
    }
    public function sendApplicationVerifiedMail($course_id,$stu_data){
        $data = Course::where('courses.id',$course_id)
                        ->join('universities','courses.university_id','=','universities.id')
                        ->select('courses.name','courses.university_id as uni_id','universities.name as uni_name','courses.duration','courses.fee','universities.application_fee')
                        ->first();
        $email_data = [
            'course_name'     => $data->name,
            'university_name' => $data->uni_name,
            'first_name'      => $stu_data->fname,
            'uni_slugs'       => CourseApplied::university_slug($course_id),
            'cou_slugs'       => CourseApplied::course_slug($course_id),
            'application' => $data->application_fee
        ];
        Mail::to($stu_data->email)->send(new  ApplicationVerifiedMail($email_data));
        return true;
    }

    public function confirm_withdrawl($id){
        $data = CourseApplied::find($id);
        $data->update(['status' => 'Withdrawn']);
        $student_data = StudentList::find($data->student_id);

        $email_data = [
            'fname' => $student_data->fname,
            'course_name' => $data->course->name,
            'course_url' => $data->course->slugs,
            'university_name' => $data->university->name,
            'university_url' => $data->university->slugs,
        ];
        Mail::to($student_data->email)->send(new withdrawlConfirm($email_data));
        $log_data = [
            'category' => 'course-list',
            'category_id' => $id,
            'action' => 'Withdrawl Request Accepted'
        ];
        Logs::GenerateLog($log_data);
        return back();
    }

    public function shortlist(Request $request){
        $this->validate($request,[
            'course_id'  => 'required|numeric',
            'student_id' => 'required|numeric'
        ]);
        $course_id                   = $request->course_id;
        $course                      = Course::find($course_id);
        $university                  =   University::find($course->university_id);
        $student                  =   StudentList::find($request->student_id);
        $data['course_id']           = $course_id;
        $data['student_id']           = $request->student_id;
        $data['university_id']       = $course->university_id;
        $data['status']                 = "shortlisted";
        $data['campus']              = get_first_campus_name($course->campus_id);
        $data['shortlisted']         = "Yes";
        $data['shortlisted_on']      = Carbon::now()->format('Y-m-d');

        $resp = CourseApplied::create($data);
        if($resp->id){
            //send email
            $data = [
              'course_name' => $course->name,
              'univ_name' => $university->name,
              'applied_course_id' => $resp->id,
              'first_name' =>  $student->fname
            ];
            //log generation
            Mail::to($student->email)->send(new CourseShortlist($data));
            //updateStage
            $data = [ 'student_id' =>$request->student_id, 'activity' => "Course Shorlisted by Admin" ];
            insertAdminLog($data);
            insertMailLog(['student_id' =>$request->student_id,'mail_name' => "Shorlist Course of ".$course->name." Email", 'mail_type' => "system" ] );
            Stage::UpdateStage($student->id,5);
            $logs_data =  [
                'category_id' =>  $resp->id,
                'action'      => 'Course Shorlisted By Admin'
            ];
            CourseApplied::GenerateLog($logs_data);
            $message = ['success' => true];
        }else{
            $message = ['success' => false];
        }
        return response()->json($message);

    }






}
