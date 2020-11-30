<?php

use App\Enquiry;
use App\Notification;
use App\Stage;
use App\State;
use App\Country;
use App\Module;
use App\AdditionalExam;
use App\DocumentRequiredName;
use App\CurrencyName;
use App\Logs;
use App\User;
use App\StudentList;
use App\Frontend\Campus;
use App\CourseApplied;
use App\AgentCourseApplied;
use App\University;
use App\AdminLogs;
use App\SendMailLogs;
use App\Course;

function prev_enquiry($email_id){
  $enquiries = Enquiry::where('email',$email_id)->get();
  if($enquiries->count() >0)
  {
  	 $data = [];
  	 foreach($enquiries as $key => $value){
	  		$data[] = [
	  			'url' => $value->id,
	  			'no'   => $value->enquiry_no
	  		];
	  }
	  return $data;
	}else{
		return false;
	}
}
function getStateNamesWithCountryId($country_id){
    if($country_id){
         $states     = State::where('country_id',$country_id)->pluck('name','id')->all();
    }else{
        $states = ['' => 'Select State'];
    }
    return $states;
}

function allModules(){
        $allModule = Module::select('id','name')->get();
        return $allModule;
}

function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}
function get_additional_exam_name_with_id($id){
    $name= AdditionalExam::where('id',$id)->first()->name;
    return $name;
}
function get_document_name_with_id($id){
    $count = DocumentRequiredName::where('id',$id)->count();
    if($count == 1){
        $name= DocumentRequiredName::where('id',$id)->first()->name;
        return $name;
    }else {
        return 'N.A';
    }
}
function  currency_name_with_id($id){
      return CurrencyName::where('id',$id)->first()->name;
}
function get_first_campus_name($campus_id){
     $campus_id = json_decode($campus_id);
     return $campus_id[0];
}

function generate_logs($input){

}

function get_proccessed_by($action_by,$action_by_type){

  if($action_by_type == 'admin'){
     return User::find($action_by);
  }else{
      return studentList::find($action_by);
  }
}

function generate_campus_option($university,$selected_campus){
    $university_id = University::where('name',$university)->first()->id;
    $all_campuses =  Campus::select('name')->where('university_id',$university_id)->get();
    $options ='';

    foreach($all_campuses as  $key => $value){
        if($selected_campus == $value->name){
            $options .= '<option value="'.$value->name.'" selected>'.$value->name.'</option>';
        }else{
            $options .= '<option value="'.$value->name.'">'.$value->name.'</option>';
        }

    }
    return $options;
}

function get_course_id($id){
    $course_applied = CourseApplied::where('id',$id)->first();
    return $course_applied->course_id;
}
function get_agent_course_id($id){
    $course_applied = AgentCourseApplied::where('id',$id)->first();
    return $course_applied->course_id;
}
    /*
     *  Get student first name based on the course applied
     */
function get_student_fname($id){
    $course_applied = CourseApplied::where('course_applieds.id',$id)
                                    ->join('users','users.id','=','course_applieds.student_id')
                                    ->select('users.fname','users.email','users.id')
                                    ->first();
    return $course_applied;

}

function get_agent_student_fname($id){
    $course_applied = AgentCourseApplied::where('students_courses.id',$id)
                                    ->join('students','students.id','=','students_courses.student_id')
                                    ->select('students.fname','students.email','students.id')
                                    ->first();
    return $course_applied;

}

    function notification($type) {
        if($type == 'count')
             return Notification::count();
        if($type == 'limit')
            return Notification::limit(3)->orderBy('created_at','DESC')->get();

    }
    function  updateStage($stage,$id = false){

        if($id){
            $user_id =$id;
            $previous = Stage::where('student_id',$id)->count();
            if($previous == 0){
                Stage::create(['student_id' =>  $user_id,'stage' => 1]);
            }else{
                Stage::where('student_id',$user_id)
                    ->update(['stage' => $stage]);
            }

        }else{
            $user_id = Auth::user()->id;
            return Stage::where('student_id',$user_id)
                ->update(['stage' => $stage]);
        }
    }
    function getState($country_id){
        if($country_id)
            $states = State::where('country_id',$country_id)->pluck('name','id')->all();
        else
            $states = ['' => 'Please Select State'];
        return $states;
    }
    function getStateNamesWithCountryName($country_name){
        
        if($country_name){
            $country_id = Country::where('name',$country_name)->first()->id;
            $states     = State::where('country_id',$country_id)->pluck('name','name')->all();
        }else{
            $states = ['' => 'Select State'];
        }

        return $states;
    }
    function get_country_name($country_id){
        $data =  Country::where('id',$country_id)->get();
        if($data->count() == 0){
            return $country_id;
        }else{
          return  Country::where('id',$country_id)->first()->name;
        }

    }
    function get_state_name($state_id){
        if(is_numeric($state_id)){
        $data =  State::where('id',$state_id)->get();
        if($data->count() == 0){
            return $state_id;
        }else{
          return  State::where('id',$state_id)->first()->name;
        }
        }else{
            return $state_id;
        }
    }

    function getStageNameBased($stageId){
        if($stageId == 1){
            return "Registration Completed";
        }

        if($stageId == 2){
            return "Email Verified";
        }
        if($stageId == 3){
            return "Registration Form ( Step 1)";
        }
        if($stageId == 4){
           return  "Registration Form ( Step 2)";
        }
        if($stageId == 5){
            return  "Registration Form ( Step 3)";
        }
        if($stageId == 6){
            return  "Course Shortlisted";
        }
        if($stageId == 7){
            return  "Confirmation";
        }
        if($stageId == 8){
            return  "Document Verification";
        }
        if($stageId == 9){
            return  "Application Form Verified";
        }
        if($stageId == 10){
            return  "Ready to Process";
        }
        if($stageId == 11){
            return  "Application Forwarded";
        }
        if($stageId == 12){
            return  "Offer Letter Received";
        }
        if($stageId == 13){
            return  "Offer Letter Accepted";
        }

        if($stageId == 14){
            return  "Visa Letter Received";
        }
        if($stageId == 15){
            return  "Ready to File Visa";
        }
        if($stageId == 16){
            return  "Visa Document Checklist Status";
        }
        if($stageId == 17){
            return  "Other Visa Formalities Status";
        }
        if($stageId == 18){
            return  "Visa Fee Paid";
        }
        if($stageId == 19){
            return  "Visa Under Process";
        }
        if($stageId == 20){
            return  "Visa Decision";
        }
        if($stageId == 21){
            return  "Accommodation";
        }
        if($stageId == 22){
            return  "Flight Ticket";
        }
        if($stageId == 23){
            return  "Forex";
        }
        if($stageId == 24){
            return  "Feedback";
        }
    }

    function insertAdminLog($data){
     $data =   AdminLogs::create( [ 'student_id' => $data['student_id'], 'activity'   => $data['activity'], 'user'       => Auth::user() ] );
    }
    function insertMailLog($data){
      $resp = SendMailLogs::create($data);
    }

    #Start Of  Jebas Functions
    function get_course_name($id){
        if(is_numeric($id)){
        $data =  Course::where('id',$id)->get();
        if($data->count() == 0){
            return $id;
        }else{
          return  Course::where('id',$id)->first()->name;
        }
        }else{
            return $id;
        }
    }

    function get_university_name($id){
        if(is_numeric($id)){
        $data =  University::where('id',$id)->get();
        if($data->count() == 0){
            return $id;
        }else{
          return  University::where('id',$id)->first()->name;
        }
        }else{
            return $id;
        }
    }

?>
