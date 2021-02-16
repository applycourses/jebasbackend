<?php

namespace App\Http\Controllers;

use App\EmailVerification;
use App\Mail\StudentRegistration;
use App\Stage;
use Illuminate\Http\Request;
use App\StudentList;
use App\Country;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class StudentListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if($request->search == 'search')
        {
             $query = StudentList::where('users.id','>','0')
                                 ->join('stages','stages.student_id','=','users.id');

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
             $query->select("users.created_at","users.stu_id","users.name","users.email","users.country_id","users.status","users.id","stages.stage","users.phone");
             $students = $query->paginate(20);
        }else{
             $students = StudentList::join('stages','stages.student_id','=','users.id')
                                    ->orderBy('users.created_at','DESC')
                                    ->select("users.created_at","users.stu_id","users.name","users.email","users.country_id","users.status","users.id","stages.stage","users.phone","users.dob")
                                    ->paginate(50);
        }

        return view('contents.crm.student_list.list',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name','id')->all();
        return view('contents.crm.student_list.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'fname'       => 'required',
            'lname'       => 'required',
            'email'       => 'required|email|unique:stu.users',
            'dob'         => 'required|date',
            'phone'       => 'required|max:100',
            'subscribe'   => 'required|max:100',
            'country_id'  => 'required|integer',
            'state_id'    => 'required|integer',
            'citizenship' => 'required|integer',
            'gender'      => 'required',
        ]);

        $input               = $request->except('_token');
        $input['created_by'] = '1';
        $password            = random_password(8);
        $input['password']   = bcrypt($password);
        $input['status']     = 0;
        $input['name']       = $request->fname . ' ' . $request->lname;
        $input['dob']        = date('Y-m-d',strtotime($request->dob));
        $input['stu_id']     = 'apc/'.date('Y').'/'.(StudentList::orderBy('id', 'desc')->first()->id + 1);
        $resp                = StudentList::create($input);
        if($resp->id){

            updateStage(1,$resp->id);
            $token =  str_random(64);
            EmailVerification::create(['student_id' => $resp->id ,'email_id' => $resp->email,'token' => $token,'password' => $password]);
            $email_data = [
                'email_id' => $resp->email,
                'password' => $request->password,
                'fname' => $resp->fname,
                'token' => $token
            ];
            Mail::to($request->email)->send(new StudentRegistration($email_data));
            // AdminLog
            $data = [ 'student_id' => $resp->id, 'activity' => "User Registeration Completed" ];
            insertAdminLog($data);

        }
        $request->session()->flash('success','Successfully Added');
        return redirect('/student-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $data = StudentList::find($id);

         $countries = Country::pluck('name','id')->all();

         return view('contents.crm.student_list.view',compact('data','countries','stage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        // return $request->All();
         $data         = StudentList::find($id);
         $input        = $request->except('_token','_method');

         $data->update($input);

         ($data)?   $request->session()->flash('message', 'Updated Successfully')  :  $request->session()->flash('message', 'Error in Updating') ;
         if($request->status == 1)
            $data = [ 'student_id' =>$id, 'activity' => "User Email Verified Updated" ];
         else
            $data = [ 'student_id' =>$id, 'activity' => "User Registeration Details Updated" ];

         insertAdminLog($data);
         return redirect('student-list');
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
}
