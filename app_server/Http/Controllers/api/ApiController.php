<?php

namespace App\Http\Controllers\api;

use App\Application;
use App\Country;
use App\Course;
use App\CourseApplied;
use App\Documents;
use App\State;
use App\StudyLevel;
use App\Subject;
use App\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
     public function eligibility_criteria_by_application_id(Request $request){
         $id        = $request->id;
         $course_id = Application::find($id)->course_applied_id;
         $data      = Course::find($course_id)->additional_exam;
         return response()->json($data);
     }
     public function document_check_list_by_application_id(Request $request){
         $id        = $request->id;
         $course_id = Application::find($id)->course_applied_id;
         $data      = Course::find($course_id)->documents_id;
         return response()->json($data);
     }
     public function application_document_by_application_id(Request $request){
         if($request->ajax()){
             $id          = $request->id;
             $application         = Application::select('id','course_applied_id','student_id')->find($id);
             $course_details      = CourseApplied::find($application->course_applied_id);

             $data        = Documents::where('course',$course_details->course_id)
                                         ->where('category','12')
                                         ->where('student_id',$application->student_id)
                                         ->get();
             foreach($data as $key => $value ){
                 $data[$key]['document'] = Documents::DocumentName($value->document_id);
                 $data[$key]['download'] = Storage::disk('s3')->url($value->path);
             }
             return response()->json($data);
         }else{
             abort(404);
         }
     }
     public function paymentStatusOfStudent(Request $request){
             $id                  = $request->id;
             $application         = Application::select('tution_fee')->find($id);
             return response()->json($application);
     }
     public function updatePaymentStatusOfStudent(Request $request){
         $id            = $request->id;
         $tution_fee    = $request->tution_fee;
         $application   = Application::find($id);
         $response      = $application->update(['tution_fee' => $tution_fee]);

         if($response)
             $message = ['success' => true];
         else
             $message = ['success' => false];

         return response()->json($message);
     }
     public function viewAcceptanceLetterOfStudent(Request $request){
         $id                  = $request->id;
         $application         = Application::select('acceptance')->find($id);
         return response()->json($application);
     }
     public function updateAcceptanceStatusOfStudent(Request $request){
        $id            = $request->id;
        $acceptance    = $request->acceptance;
        $application   = Application::find($id);
        $response      = $application->update(['acceptance' => $acceptance]);

        if($response)
            $message = ['success' => true];
        else
            $message = ['success' => false];

        return response()->json($message);
    }

    public function get_all_document_for_application(Request $request){
         $this->validate($request,[
            'id' => 'required|integer'
         ]);
         $application = Application::find($request->id);
         $course      = CourseApplied::find($application->course_applied_id)->course_id;
         $documents   = Documents::where('course',$course)->where('student_id',$application->student_id)->get();
         return $documents;
    }
    public function getCourseJson(Request $request){
        $courses = Course::select('courses.name','universities.name as university-name')
                                ->join('universities','courses.university_id','=','universities.id')
                                ->where('courses.name','like','%'.$request->q.'%')
                                ->orWhere('universities.name','like','%'.$request->q.'%')
                                ->limit(3)
                                ->get();
        return response()->json($courses);
    }

    public function getSubjectsJson(Request $request){
        $subjects = Subject::select('name')
                            ->where('name','like','%'.$request->q.'%')
                            ->limit(3)
                            ->get();
        return response()->json($subjects);
    }
    public function getStudyLevelJson(Request $request){
        $study_level = StudyLevel::select('name')
            ->where('name','like','%'.$request->q.'%')
            ->limit(3)
            ->get();
        return response()->json($study_level);
    }
    public function getCountriesJson(Request $request){
        $countries = Country::select('name')
                        ->where('name','like','%'.$request->q.'%')
                        ->limit(3)
                        ->get();
        return response()->json($countries);
    }
    public function getUniversityJson(Request $request){
        $countries = University::select('name')
            ->where('name','like','%'.$request->q.'%')
            ->limit(3)
            ->get();
        return response()->json($countries);

    }
    public function getCourse(Request $request){
       $query = Course::join('universities','courses.university_id','=','universities.id')
               ->where('courses.status',0)
               ->whereNull('courses.deleted_at')
            ->join('currencies','currencies.id','=','universities.currency_id')
            ->select('courses.id','currencies.name as currency','universities.country as country_name','courses.name','universities.name as uni_name','courses.intake','courses.duration','courses.fee');

        if($request->has('course') && !empty($request->course)){
            $query->where('courses.name','like','%'.$request->course.'%');
        }
        if($request->has('university') && !empty($request->university)){
            $query->where('universities.name','like','%'.$request->university.'%');
        }
        if($request->has('subject') && !empty($request->subject)){
            $subject_id  =  Subject::where('name',$request->subject)->first()->id;
            $query->where('courses.subject_id',$subject_id);
        }
        if($request->has('study_level') && !empty($request->study_level)){
            $study_level_id  =  StudyLevel::where('name',trim($request->study_level))->first()->id;
            $query->where('courses.study_level_id',$study_level_id);
        }
        if($request->has('country')){
            $query->where('universities.country','like','%'.$request->country.'%');
        }

        $data =    $query->paginate(200);

        return response()->json($data);
    }
    public function countries(){
        return Country::pluck('name','id')->all();
    }
    public function countries_by_name(){
        return Country::pluck('name','name')->all();
    }
    public function get_state_by_country_name_pluck(Request $request){
        $country_id = Country::where('name',$request->country)->first()->id;
        $state      =  State::where('country_id',$country_id)->get();
        return $state;
    }

}
