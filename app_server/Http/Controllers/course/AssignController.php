<?php

namespace App\Http\Controllers\course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CourseApplied;

class AssignController extends Controller
{
    //stores assigned course id
    protected $course_id;
    //stores student id like apc/2017/23
    protected $student_id;

    public function  assignCourse(Request $request){

        $course_id                     = $request->course_id;

        $this->student_id              = $request->student_id;
        


        if(!$this->get_student_id_on_student_reg_id()){
            $request->session()->flash('status','No Student Exist with '.$this->student_id);
            return  back();
        }

        $data['course_id']      = $request->course_id;
        $data['student_id']     = $this->get_student_id_on_student_reg_id();
        $data['university_id']  = $university_course_campus_data->uni_id;
        $data['campus_id']      = get_first_campus_name($university_course_campus_data->campus_id);
        $data['status']         = 'shortlisted';
        $data['shortlisted']    =  'yes';
        $data['shortlisted_on'] = Carbon::now()->format('Y-m-d');
        dd($data);
        $response =  CourseApplied::create($this->course_id);

        if($response->id){
            $stu_data =  get_student_fname($id);
            $request->session()->flash('status','Successsfully Assigned');
            Mail::to($stu_data->email)->send(new ShortlistMail($response));
            $data = [ 'student_id' =>$this->student_id , 'activity' => "$course_name course shorlisted at $university_course_name ()" ];
            insertAdminLog($data);


            $data = [
                'category_id' => $response->id,
                'action'      => 'Shorlisted',
                'action_on'   => Carbon::now()->format('Y-m-d'),
                'action_by'   => Auth::user()->id
            ];

            $collection = array_merge($this->input, $data);
            generate_logs($collection);
            $data = [
                'category_id' => $id,
                'action'      => 'Shorlisted Mail Send',
                'action_on'   => Carbon::now()->format('Y-m-d'),
                'action_by'   => Auth::user()->id
            ];
            $collection = array_merge($this->input, $data);
            generate_logs($collection);
            return   back();
        }else{
            $request->session()->flash('status','Error in  Assigning');
            return  back();
        }

    }
}
