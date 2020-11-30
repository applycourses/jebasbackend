<?php
/**
 * Created by PhpStorm.
 * User: deepankar
 * Date: 7/11/17
 * Time: 10:22 AM
 */
namespace App\CustomClass;

use App\AgentApplication as ApplicationModel;
use App\AgentApplicationStatus;
use App\AgentApplicationStatusDocument;
use App\AgentStudentList;
use App\AgentStage;
use App\Visa;
use Auth;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Psr7\Request;

class AgentApplication
{
    private $application_id;
    private $applicationStatus;
    private $currentStage;

    public static function  showAllApplicationList(){
        $data = ApplicationModel::join('course_applieds','applications.course_applied_id','=','course_applieds.id')
                                ->join('users','users.id','=','applications.student_id')
                                ->select('course_applieds.course_id','course_applieds.university_id','applications.status','applications.created_at','users.fname','users.lname','users.stu_id','applications.id as application_id','users.id as student_id','applications.course_applied_id')
                                ->orderBy('applications.id','DESC')
                                ->paginate(100);
        return $data;
    }
    public function showApplication($id){

        $this->application_id = $id;
        $student = AgentStudentList::get_student_id_from_application_id($this->application_id);
        $data = ApplicationModel::where('students_applications.student_id',$student->id)
                                    ->where('students_applications.id', $this->application_id)
                                    ->join('students_courses', 'students_courses.id', '=', 'students_applications.course_applied_id')
                                    ->select('students_courses.course_id','students_courses.university_id','students_courses.campus')
                                    ->first();
        $data['course_name']     = get_course_name($data->course_id);
        $data['university_name'] = get_university_name($data->university_id);
        return $data;
    }
    // update student application  status
    public function updateApplicationStatusOfStudent($data){
        $this->applicationStatus = [
            'application_id' => $data['application_id'],
            'status'         => $data['category'],
            'remarks'        => $data['remarks']
        ];
        if(!empty($data['documents_id'])){
             $this->applicationStatus['application_status_document'] = 1;
        }
        if($data['category'] == 'Ready to File Visa'){
            $this->insertInVisaTable($data);
        }
        //$this->sendEmail($data);
        $resp =  AgentApplicationStatus::create($this->applicationStatus);
        if($resp->id){
            // Assign Documents To status
            if(!empty($data['documents_id'])){
                $this->AssignDocumentsToStatus($resp->id,$data['application_id'],$data['documents_id']);
            }
            //$this->sendEmail($data);
            $message= ['success' => true ];
            $this->checkStatusUpdate();
            \App\AgentApplication::UpdateStatus($data['application_id'],$data['category']);
        }else
            $message= ['success' => false];

        return response()->json($message);
    }

    private function sendEmail($data){
        $application        = \App\Application::find($data['application_id']);
        $course_applied     = $application->course_applied;

        $studentDetails     = $application->student;
        $course_details     = $course_applied->course;
        $university_details = $course_applied->university;

        $category   = $data['category'];

        if($data['category'] == 'Application Forwarded')
          Mail::to($studentDetails->email)->send(new \App\Mail\application\ForwardApplication($studentDetails,$course_details,$university_details));


        if($data['category'] == 'Rejection')
          Mail::to($studentDetails->email)->send(new \App\Mail\application\Rejection($studentDetails,$course_details,$university_details));


        if($data['category'] == 'Conditional Offer')
          Mail::to($studentDetails->email)->send(new \App\Mail\application\ConditionalOffer($studentDetails,$course_details,$university_details));


        if($data['category'] == 'Unconditional Offer')
          Mail::to($studentDetails->email)->send(new \App\Mail\application\UnconditionalOffer($studentDetails,$course_details,$university_details));


        if($data['category'] == 'Accepted')
          Mail::to($studentDetails->email)->send(new \App\Mail\application\Accepted($studentDetails,$course_details,$university_details));


        if($data['category'] == 'Withdrawn')
          Mail::to($studentDetails->email)->send(new \App\Mail\application\Withdrawn($studentDetails,$course_details,$university_details));

        if($data['category'] == 'Request for Payment')
          Mail::to($studentDetails->email)->send(new \App\Mail\application\RequestforPayment($studentDetails,$course_details,$university_details));

        if($data['category'] == 'Fees Paid')
          Mail::to($studentDetails->email)->send(new \App\Mail\application\FeesPaid($studentDetails,$course_details,$university_details));

        if($data['category'] == 'Refunded')
          Mail::to($studentDetails->email)->send(new \App\Mail\application\Refunded($studentDetails,$course_details,$university_details));

        if($data['category'] == 'Visa Letter')
          Mail::to($studentDetails->email)->send(new \App\Mail\application\VisaLetter($studentDetails,$course_details,$university_details));

//        if($data['category'] == 'Ready to File Visa')
//          Mail::to($studentDetails->email)->send(new \App\Mail\application\ReadytoFileVisa($studentDetails,$course_details,$university_details));

        $string = "$course_details->name at  $university_details->name  $category" ;
        $data1 = [ 'student_id' => $studentDetails->id, 'activity'   => $string." Status Changed" ];
        insertAdminLog($data1);

        if($data['category'] != 'Ready to File Visa')
            insertMailLog([ 'student_id'=>  $studentDetails->id, 'mail_name' => $string, 'mail_type' => "system" ]);






    }

    private function checkStatusUpdate()
    {
        $new_status = $this->applicationStatus['status'];
        //check update of stage is required for the current status
        if($new_status == 'Application Forwarded' || $new_status == 'Unconditional Offer' || $new_status == 'Ready to File Visa' ||
            $new_status == 'Accepted' || $new_status == 'Visa Letter')
        {
            $this->currentStage  = AgentStudentList::current_stage('application_id',$this->applicationStatus['application_id']);
            $current_id          = $this->GetCurrentStatusId();
            //check if current stage of student is less than update stage id
            if($this->currentStage < $current_id){
                // update status
                 $student = AgentStudentList::get_student_id_from_application_id( $this->applicationStatus['application_id']);
                 $stage      = AgentStage::where('student_id', $student->id)->update(['stage' => $current_id]);
                // stage update
                if($stage)
                    return true;
                else
                    return false;
            }else
                return true;

        }else
            return true;
    }
    private function GetCurrentStatusId()
    {
        $status =  $this->applicationStatus['status'];

        if($status == 'Application Forwarded')
            return 11;

        if($status == 'Unconditional Offer')
            return 12;

        if($status == 'Accepted')
            return 13;

        if($status == 'Visa Letter')
            return 14;
        if($status == 'Ready to File Visa')
            return 15;
    }

    private function AssignDocumentsToStatus($application_status_id,$application_id,$documents){
        foreach($documents as $key => $value){
            $data['application_status_id'] = $application_status_id;
            $data['application_id']        = $application_id;
            $data['document_id']           = $value;
            AgentApplicationStatusDocument::create($data);
        }
    }
    // application id //

    private function insertInVisaTable($data){
       $application = ApplicationModel::find($data['application_id']);
       $insertData = [
               'application_id'    => $application->id,
               'student_id'        => $application->student_id,
               'course_applied_id' => $application->course_applied_id,
               'status'            => "New",
       ];
       $count = Visa::where('application_id',$application->id)->count();
       if($count == 0){
           $resp = Visa::create($insertData);
           return ($resp->id) ?  true : false;
       }else{
           return true;
       }
    }

}
