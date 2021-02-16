<?php

namespace App\Http\Controllers;

use App\Country;
use App\Mail\RegistrationStep1Completed;
use App\Mail\RegistrationStep2Completed;
use App\Mail\RegistrationStep3Completed;
use App\Stage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\RegistrationForm;
use App\StudentList;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class RegistrationFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search == 'search')
        {
            $query = RegistrationForm::join("users", 'users.stu_id', '=', 'registration_forms.student_id');

            if($request->has('name')){
                $query->where('users.name','like','%'.$request->name.'%')
                    ->orWhere('users.stu_id','like','%'.$request->name.'%')
                    ->orWhere('users.phone',$request->name)
                    ->orWhere('users.email','like','%'.$request->name.'%');
            }
            if($request->has('dob')){
                $dob = Carbon::parse($request->dob); $dob = $dob->format('Y-m-d');
                $query->where('users.dob',$dob);
            }
            if($request->has('country')){
                $country_id = Country::where('name',$request->country)->first()->id;
                $query->where('users.country_id',$country_id);
            }
            if($request->has('status')){
                $query->where('users.status',$request->status);
            }
            if($request->has('stage')){
                $query->where('stages.stage',$request->stage);
            }
            $data =  $query->select('users.id', 'users.stu_id', 'users.name', 'users.email', 'users.dob', 'users.phone', 'users.citizenship', 'users.country_id', 'users.status', 'registration_forms.status as reg_status', 'registration_forms.id as reg_id','stages.stage')
                            ->join('stages', 'stages.student_id', '=', 'users.id')
                            ->orderBy('id', 'DESC')
                            ->paginate(50);
        }else {
            $data = RegistrationForm::join("users", 'users.stu_id', '=', 'registration_forms.student_id')
                                    ->select('users.id', 'users.stu_id', 'users.name', 'users.email', 'users.dob', 'users.phone', 'users.citizenship', 'users.country_id', 'users.status', 'registration_forms.status as reg_status', 'registration_forms.id as reg_id','stages.stage')
                                    ->join('stages', 'stages.student_id', '=', 'users.id')
                                    ->orderBy('id', 'DESC')
                                    ->paginate(60);
        }

        return view('contents.crm.reg-form.list',compact('data'));
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

    	$student_id    = StudentList::where('id',$id)->first()->stu_id;
    	$data          = RegistrationForm::where('student_id',$student_id)->first();
    	$data['step1'] = json_decode($data->step1,true);


    	if($data->step2){
    		$data['step2'] = json_decode($data->step2,true);
    	}

    	if($data->step3){
    		$data['step3'] = json_decode($data->step3,true);
    	}


    	return view('contents.crm.reg-form.view',compact('data'));
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

    public function showRegOneForm($student_id)
    {
        $countries    = Country::pluck('name','id')->all();
        $student      = StudentList::find($student_id);
        $data         = RegistrationForm::where('student_id',$student->stu_id)->first();

        $data         = json_decode($data['step1'],true);

       
        return  view('contents.crm.reg-form.includes.step1.new',compact('countries','student_id','data'));
    }
    public function showRegTwoForm($student_id){
        $countries    =  Country::pluck('name','name')->all();
        $student      = StudentList::find($student_id);
        $data         = RegistrationForm::where('student_id',$student->stu_id)->firstOrFail()->step2;
        $data         = json_decode($data,true);
        return view('contents.crm.reg-form.includes.step2.new',compact('countries','student_id','data'));
    }
    public function showRegThreeForm($student_id){
        $countries    =  Country::pluck('name','name')->all();
        $student      = StudentList::find($student_id);
        $data         = RegistrationForm::where('student_id',$student->stu_id)->firstOrFail()->step3;
        $data         = json_decode($data,true);

        return view('contents.crm.reg-form.includes.step3.new',compact('countries','student_id','data'));

    }

    public function submitRegOneForm(Request $request){
        $this->validate($request, [
            'student_id'       => 'required|numeric',
            'country_of_birth'  => 'numeric|required',
            'marital_status'    => 'required',
            'noOfDependants'    => 'required|numeric',
            'mailing_address'   => 'required|max:255',
            'mailing_city'      => 'required|max:255',
            'mailing_country'   => 'numeric|required',
            'mailing_state'     => 'numeric|required',
            'mailing_pincode'   => 'numeric|required',
            'permanent_status'  => 'required',
        ]);
        $user = StudentList::find($request->student_id);
        if(RegistrationForm::where('student_id',$user->stu_id)->count() == 0)
        {
            $data  = $request->except('_token','depedents_name','depedents_relation','depedents_take');
            ($request->has('depedents_name')) ?  $data['dependent'] = $this->createDependentJson($request) : '';
            ($request->permanent_status == 'true') ? $data = $this->copyMailingToPermanentAddress($data,$request) : '';

            $response = RegistrationForm::create([
                'step1'              => json_encode($data) ,
                'status'             => '1',
                'student_id' => $user->stu_id,
                'step1_completed_at' => Carbon::now()
            ]);
            if($response->id){
                //send email
                Mail::to($user->email)->send(new RegistrationStep1Completed($user));
                //stage update
                Stage::UpdateStage($user->id,3);
                //Admin Log

                Session::flash('message', 'Successfully completed the step 1 of registration form!');
            }
        }else{
            $request->session()->flash('message','You have Already Completed  Step 1');
        }
        return redirect('/student?view=registration_form&student_id='.$request->student_id);

    }
    public function submitRegTwoForm(Request $request){
        $data = json_encode($request->except('_token'));
        $student = StudentList::find($request->student_id);

        $response = RegistrationForm::where('student_id',$student->stu_id)
            ->update([
                'step2' => $data,
                'status' => 2 ,
                'step2_completed_at' => Carbon::now()
            ]);
        if($response){
            Mail::to($student->email)->send(new RegistrationStep2Completed($student));
            Stage::UpdateStage($student->id,4);
            Session::flash('message','Successfully updated the step 2 of registration form !');
            return redirect('/student?view=registration_form&student_id='.$request->student_id);
        }
    }
    public function updateRegThreeForm(Request $request){
        $student  = StudentList::find($request->student_id);
        $data     = json_encode($request->except('_token'));
        $response = RegistrationForm::where('student_id',$student->stu_id)
                                    ->update(['step3' => $data,
                                              'status' => '3',
                                              'step3_completed_at' => Carbon::now()]);

        if($response)
        {
            // Mail::to($student->email)->send(new RegistrationStep3Completed($student));
            // Stage::UpdateStage($student->id,5);
            $data = [ 'student_id' =>$request->student_id, 'activity' => "Registration Step 3 Updated" ];
            insertAdminLog($data);
            Session::flash('message','Successfully updated the step 2 of registration form !');
            return redirect('/student?view=registration_form&student_id='.$request->student_id);

        }
    }
    public function updateRegOneForm(Request $request){
        $this->validate($request, [
            'country_of_birth'  => 'numeric|required',
            'marital_status'    => 'required',
            'noOfDependants'    => 'required|numeric',
            'mailing_address'   => 'required|max:255',
            'mailing_city'      => 'required|max:255',
            'mailing_country'   => 'numeric|required',
            'mailing_state'     => 'numeric|required',
            'mailing_pincode'   => 'numeric|required',
            'permanent_status'  => 'required',
        ]);
        $user = StudentList::find($request->student_id);
        $data  = $request->except('_token','depedents_name','depedents_relation','depedents_take');
        ($request->has('depedents_name')) ?  $data['dependent'] = $this->createDependentJson($request) : '';
        ($request->permanent_status == 'true') ? $data = $this->copyMailingToPermanentAddress($data,$request) : '';
        $response = RegistrationForm::where('student_id',$user->stu_id)
                                    ->update(['step1'=>json_encode($data) ]);
        if($response){
            Session::flash('message', 'Successfully updated the step 1 of registration form !');
            $data = [ 'student_id' =>$user->id, 'activity' => "Registration Step 1 Updated" ];
            insertAdminLog($data);
            return redirect('/student?view=registration_form&student_id='.$request->student_id);
        }




    }
    public function updateRegTwoForm(Request $request){
        $student = StudentList::find($request->student_id);
        $data = json_encode($request->except('_token'));

        $response = RegistrationForm::where('student_id',$student->stu_id)
                                        ->update(['step2' => $data]);
        if($response){
            Session::flash('message', 'Successfully updated the step 2 of registration form !');
            $data = [ 'student_id' =>$request->student_id, 'activity' => "Registration Step 2 Updated" ];
            insertAdminLog($data);
            return redirect('/student?view=registration_form&student_id='.$request->student_id);
        }




    }
    private function createDependentJson($request){
        $dependent = [];
        foreach($request->depedents_name as $i => $value)
        {
            if(!empty($value)){
                $dependent[] = [
                    'name'     => $value ,
                    'relation' => $request->depedents_relation[$i],
                    'take'     => (isset($request->depedents_take[$i])) ? "true" : "false"
                ];
            }
        }
        return json_encode($dependent);
    }


    private function copyMailingToPermanentAddress($data,$request)
    {
        $data['permanent_address'] =  $request->mailing_address;
        $data['permanent_city']    =  $request->mailing_city;
        $data['permanent_country'] =  $request->mailing_country;
        $data['permanent_state']   =  $request->mailing_state;
        $data['permanent_pincode']  = $request->mailing_pincode;
        return $data;
    }




}
