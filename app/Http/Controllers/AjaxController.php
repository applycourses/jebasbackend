<?php

namespace App\Http\Controllers;

use App\AdditionalExam;
use App\Application;
use App\AssignApplication;
use App\Country;
use App\Course;
use App\CourseApplied;
use App\DocumentCategory;
use App\DocumentRequiredName;
use App\Documents;
use App\DownloadCategory;
use App\State;
use App\StudentList;
use App\University;
use App\UniversityDepartment;
use Illuminate\Http\Request;
use App\Enquiry;
use App\faqs;

class AjaxController extends Controller
{
    public function update_enquiry_status(Request $request){    	
    	$id       = $request->id;
    	$status   = $request->status;
        ($status == 'NULL') ? $status = null : $status;
        $response = Enquiry::where('id',$id)->update(['status' => $status]);
        $data   = ($response) ? ['success' => true , 'message' =>'Successfully Updated'] : ['success' => false , 'message' =>'Error in Updating'] ;
      	return response()->json($data);
    }

    public function sendEnquiryReply(Request $request){
    	return $request->all();
    }

    public function faqs(Request $request){
        $category = $request->category;
        $data     = faqs::where('category',$category)->get();       
        return view('contents.ajax.faqs',compact('data'));
    }

    public function allModules(){
        $allModule = Module::select('id','name')->get();
        return $allModule;
    }
    public function student_details_with_student_id(){
        return response()->json(['hey' => 'sadasdas']);
    }
    public function get_email_of_application_university_agent(Request $request){
        $email = '';
        if($request->type == 'university'){
                $data = AssignApplication::where('application_id',$request->application_id)
                                  ->first();
                if($data->type == 'university'){
                    $email = UniversityDepartment::where('university_id',$data->name)
                                                    ->where('id',$data->department)
                                                    ->first()->email;
                    return response()->json($email);
                }



        }else{
            $student_id = Application::where('id',$request->application_id)
                                        ->first()
                                        ->student_id;

            return StudentList::find($student_id)->email;

        }

    }
    public function get_state_by_country_id(Request $request){
        if($request->ajax()){
            $country_id = $request->country;
            $data = State::where('country_id',$country_id)->pluck('name','id')->all();
            return response()->json($data);
        }
        return back();
    }
    public function get_state_by_country_id_pluck(Request $request){
        $country_id = $request->country;
        $state      = State::select('id', 'name')->where('country_id', $country_id)->get();
        return response()->json($state);
    }
    public function get_exam_document_name(){
        $document_names = DocumentRequiredName::pluck('name','id')->all();
        $exam_name = AdditionalExam::pluck('name','id')->all();
        $data = [
            'document_names' => $document_names,
            'exam_name'      => $exam_name
        ];
        return response()->json($data);

    }
    public function get_state_by_country_name_pluck(Request $request){
        $country    = $request->country;
        $country_id = Country::where('name',$country)->first()->id;
        $state      = State::select('name', 'name')
                            ->where('country_id', $country_id)
                            ->get();
        return response()->json($state);
    }
    public function all_countries(){
        $countries = Country::pluck('name','name')->all();
        return $countries;
    }
    public function get_category_based_on_behalf_of(Request $request){
       $query = DocumentCategory::where('id','>',0);

        if($request->behalf == 'admin'){
           $query->where('admin','1');
        }
        if($request->behalf == 'student'){
            $query->where('student','1');
        }
        if($request->behalf == 'university'){
            $query->where('university','1');
        }
        if($request->behalf == 'sub_agent'){
            $query->where('sub_agent','1');
        }if($request->behalf == 'admin'){
            $query->where('associate_agent','1');
        }
        $data = $query->get();
        return response()->json($data);

    }
    public function documents_base_on_category(Request $request){
        $category = $request->category;
        $query = DocumentCategory::find($category);
        $documents =  json_decode($query->document_id);
        $details = [];
        foreach($documents as $key =>$value){
            $details[$key]=  DocumentRequiredName::find($value);
        }
        return response()->json($details);
    }
    public function course_based_on_student_id(Request $request){
        $student_id = $request->studentId;
        $data       =  CourseApplied::where('student_id',$student_id)->get();

        foreach($data as $key => $value){
            $course[$key] = Course::where('id',$value->course_id)->select('name','id')->get();
        }
        return response()->json($course);


    }

}
