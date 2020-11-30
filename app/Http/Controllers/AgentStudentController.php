<?php
namespace App\Http\Controllers;
//use App\AssignApplication;
use App\AgentCourseApplied;
use App\DocumentCategory;
use App\Documents;
use App\Logs;
use App\AgentRegistrationForm;
use App\AgentStage;
use App\StudentDocument;
use App\Visa;
use App\VisaSetting;
use App\VisaStatus;
use Couchbase\Document;
use Illuminate\Http\Request;
use App\AgentStudentList;
use App\Country;
use App\AgentApplication;
use App\Notification;
use App\FollowupMailLog;
use App\SendMailLogs;
use App\AdminEmailLog;
use App\AdminLogs;

class AgentStudentController extends Controller
{
    public function index(Request $request){
        $student_id = $request->student_id;
        $view       = $request->view;

        if($view == 'account_details')
        {
            $data = AgentStudentList::find($student_id);  
            $stage =  AgentStage::where('student_id',$student_id)->first();
            return view('contents.crm.student_list.agentview',compact('data','stage'));
        }

        if($view == 'registration_form')
        {
            $student_id    = AgentStudentList::where('id',$student_id)->firstOrFail()->id;
            $data =  AgentRegistrationForm::where('student_id',$student_id)->count();
            if($data == 1){
                $data          = AgentRegistrationForm::where('student_id',$student_id)->first();
                $data['step1'] = json_decode($data->step1,true);
                if($data->step2)
                    $data['step2'] = json_decode($data->step2,true);
                if($data->step3)
                    $data['step3'] = json_decode($data->step3,true);
            }else{
                $data = '';
            }
            return view('contents.crm.reg-form.agentview',compact('data'));
        }

        if($view == 'course_list'){
            $course_applieds = AgentCourseApplied::join('students','students_courses.student_id','=','students.id')
                                ->select('students.student_id','students.name','students_courses.university_id','students_courses.campus','students_courses.course_id','students_courses.shortlisted_on','students_courses.status','students_courses.id')
                                ->where('students_courses.student_id','=',$student_id)
                                ->orderBy('students_courses.created_at','DESC')
                                ->paginate(20);
            return  view('contents.crm.course.agentstudent_list',compact('course_applieds'));
        }

        if($view == 'course_view'){
            $applied_id = $request->course_apply_id;
            $data = AgentCourseApplied::find($applied_id);
            $logs = Logs::where('category','course-list')->where('category_id',$applied_id)->orderBy('id','DESC')->get();
            $documents =  Documents::where('student_id',$data->student_id)->pluck('document_id');
            $documents = $documents->toArray();
            return view('contents.crm.course.agentview',compact('data','logs','documents'));
        }
        
        if($view == 'application_list'){
          $data = AgentApplication::join('students_courses','students_applications.course_applied_id','=','students_courses.id')
                              ->join('students','students.id','=','students_applications.student_id')
                              ->where('students_applications.student_id',$student_id)
                              ->select('students_courses.course_id','students_courses.university_id','students_applications.status','students_applications.created_at','students.fname','students.lname','students.student_id','students_applications.id as application_id','students.id as main_student_id','students_applications.course_applied_id')
                              ->paginate(100);
            return  view('contents.crm.application.agent_student_list',compact('data'));
        }

        if($view == 'document_list'){
            $documents = new \App\CustomClass\Documents();
            $data = $documents->GetStudentDocuments($student_id);

            return  view('contents.crm.documents.list',compact('data','student_id'));
        }
        
        if($view == 'application_view'){
            $data = array();
            return  view('contents.crm.application.agentview',compact('data'));
        }

        if($view == 'course_add'){
            return  view('contents.crm.course.add');
        }
        if($view == 'account_details_edit'){
            $data = AgentStudentList::find($student_id);
            $countries = Country::pluck('name','id')->all();
            return view('contents.crm.student_list.agentedit',compact('data','countries'));
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
          $student_data    = AgentStudentList::find($student_id);
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
            $student= AgentStudentList::find($request->student_id);
            return view("contents.crm.visa.edit",compact('visa','visa_id','visa','student_id','student'));
        }
    }
}
