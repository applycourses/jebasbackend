<?php

namespace App\Http\Controllers;

//use App\AssignApplication;
use App\CourseApplied;
use App\DocumentCategory;
use App\Documents;
use App\Logs;
use App\RegistrationForm;
use App\Stage;
use App\StudentDocument;
use App\Visa;
use App\VisaSetting;
use App\VisaStatus;
use Couchbase\Document;
use Illuminate\Http\Request;
use App\StudentList;
use App\Country;
use App\Application;
use App\Notification;
use App\FollowupMailLog;
use App\SendMailLogs;
use App\AdminEmailLog;
use App\AdminLogs;


class StudentController extends Controller
{
    public function index(Request $request){
        $student_id = $request->student_id;
        $view       = $request->view;

        if($view == 'account_details')
        {
            $data = StudentList::find($student_id);
            $stage =  Stage::where('student_id',$student_id)->first();
            $countries = Country::pluck('name','id')->all();
            return view('contents.crm.student_list.view',compact('data','countries','stage'));
        }

        if($view == 'registration_form')
        {
            $student_id    = StudentList::where('id',$student_id)->firstOrFail()->stu_id;
            $data =  RegistrationForm::where('student_id',$student_id)->count();
            if($data == 1){
                $data          = RegistrationForm::where('student_id',$student_id)->first();
                $data['step1'] = json_decode($data->step1,true);
                if($data->step2)
                    $data['step2'] = json_decode($data->step2,true);
                if($data->step3)
                    $data['step3'] = json_decode($data->step3,true);
            }else{
                $data = '';
            }

            return view('contents.crm.reg-form.view',compact('data'));
        }

        if($view == 'course_list'){
            $course_applieds = CourseApplied::join('users','course_applieds.student_id','=','users.id')
                                ->select('users.stu_id','users.name','course_applieds.university_id','course_applieds.campus','course_applieds.course_id','course_applieds.shortlisted_on','course_applieds.status','course_applieds.id','course_applieds.student_id')
                                ->where('course_applieds.student_id','=',$student_id)
                                ->orderBy('course_applieds.created_at','DESC')
                                ->paginate(20);

            return  view('contents.crm.course.student_list',compact('course_applieds'));
        }

        if($view == 'course_view'){
            $applied_id = $request->course_apply_id;
            $data = CourseApplied::find($applied_id);
            $logs = Logs::where('category','course-list')->where('category_id',$applied_id)->orderBy('id','DESC')->get();
            $documents =  Documents::where('student_id',$data->student_id)->pluck('document_id');
            $documents = $documents->toArray();
            return view('contents.crm.course.view',compact('data','logs','documents'));
        }
        if($view == 'application_list'){
          $data = Application::join('course_applieds','applications.course_applied_id','=','course_applieds.id')
                              ->join('users','users.id','=','applications.student_id')
                              ->where('applications.student_id',$student_id)
                              ->select('course_applieds.course_id','course_applieds.university_id','applications.status','applications.created_at','users.fname','users.lname','users.stu_id','applications.id as application_id','users.id as student_id','applications.course_applied_id')

                              ->paginate(100);
                            



            return  view('contents.crm.application.student_list',compact('data'));
        }

        if($view == 'document_list'){
            $documents = new \App\CustomClass\Documents();
            $data = $documents->GetStudentDocuments($student_id);

            return  view('contents.crm.documents.list',compact('data','student_id'));
        }
        
        if($view == 'application_view'){
            $data = array();
            return  view('contents.crm.application.view',compact('data'));
        }

        if($view == 'course_add'){
            return  view('contents.crm.course.add');
        }
        if($view == 'account_details_edit'){
            $data = StudentList::find($student_id);
            $countries = Country::pluck('name','id')->all();
            return view('contents.crm.student_list.edit',compact('data','countries'));
        }
        if($view == 'chat'){
            return  view('contents.crm.chats.view');
            return $student_id;
        }
        if($view == 'logs'){
          $user_activity = Notification::OrderBy('id','DESC')->where('user_id',$student_id)->get();
          $admin_activity = AdminLogs::where('student_id',$student_id)->orderBy('id','DESC')->get();
          return view('contents.crm.logs.view',compact('user_activity','admin_activity'));
        }
        if($view == 'mails'){
          $follow_up_mails = FollowupMailLog::where('student_id',$student_id)->get();
          $system_mails    = SendMailLogs::where('student_id',$student_id)->get();
          $admin_emails    = AdminEmailLog::where('student_id',$student_id)->orderBy('id','DESC')->get();
          $student_data    = StudentList::find($student_id);
          return  view('contents.crm.mails.view',compact('follow_up_mails','system_mails','admin_emails','student_data'));
        }

        if($view == "visa_view"){
            $visa_id=  $request->visa;
            $visa =     Visa::find($request->visa);
            $country =  $visa->course_applied->university->country;
            $country_visa =     VisaSetting::where('country',$country)->firstOrFail();
            $status = VisaStatus::where('visa_id',$request->visa)->where('student_id',$request->student_id)->orderBy('id','desc')->get();
            return view("contents.crm.visa.view",compact('visa','status','country_visa','student_id','visa_id'));
        }
        if($view == "visa_edit"){
            $visa_id= $request->visa;
            $visa= Visa::find($request->visa);
            $student= StudentList::find($request->student_id);
            return view("contents.crm.visa.edit",compact('visa','visa_id','visa','student_id','student'));
        }



    }
}
