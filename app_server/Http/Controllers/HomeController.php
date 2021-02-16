<?php

namespace App\Http\Controllers;

use App\Application;
use App\Enquiry;
use App\Notification;
use App\RequestFreeInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\DeparmentModule;
use App\Module;
use Session;
use App\StudentList;
use App\AdminEmailLog;
use Illuminate\Support\Facades\Mail;

use App\Mail\SendMail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $module = [];
    public  $email;
    public $subject;
    public $body;
    public $paths;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        $this->generateSidebar();
        $enquiry       = Enquiry::count();
        $request_info  = RequestFreeInfo::count();
        $students      = StudentList::count();
        $applications      = Application::count();
        return view('contents.home',compact('enquiry','request_info','students','applications'));
    }

    public function generateSidebar()
    {
        $department_id = Auth::user()->department_id;
        $module_id  = DeparmentModule::select('module_id')->where('department_id',$department_id)->get();
        foreach($module_id as $key => $value){
           array_push($this->module,$value->module_id);
        }
        $modules = Module::select('name','url','icon')->whereIn('id',$this->module)->orderBy('order','asc')->get();
        Session::put('sidebar', $modules);
    }

    public function notifications(Request $request){
        $query = Notification::OrderBy('id','DESC');
        if($request->has('queryString')) {
          $user =  StudentList::Where('users.stu_id', $request->queryString)
                ->orWhere('users.fname','like', '%' . $request->queryString . '%')
                ->orWhere('users.lname','like', '%' . $request->queryString . '%')
                ->orWhere('users.phone','=', $request->queryString )
                ->orWhere('users.email','=',  $request->queryString)
                ->get();
          if($user->count() == 1)
            $query->where('user_id',$user[0]->id);
        }
        if($request->has('date')) {
            $date = Carbon::parse($request->date);
            $query->whereDay('created_at', '=', $date->format('d'));
            $query->whereMonth('created_at', '=',  $date->format('m'));
            $query->whereYear('created_at', '=',  $date->format('Y'));
        }

      $notifications = $query->OrderBy('id','DESC')->paginate(50);
      return view('contents.notifications.index',compact('notifications'));


    }
    public function send_email(Request $request)
    {
      $this->email   = $request->email;
      $this->subject = $request->subject;
      $this->body    = $request->body;
      $total_file    = $request->no_of_files;

      $i = 1;

      for($i =1;$i <= $total_file;$i++)
      {
          //dd("Inside for Loop");
          $s3  = \Storage::disk('s3');
          //dd('files'.$i);
          if($request->hasFile('files'.$i))
          {
              //dd('files'.$i);
              //dd("File has File");
              $files = $request->file('files'.$i);


                  //dd("I am  uploading");
              $filePath        = '/email/attachment';
              $this->paths[$i] = $s3->put($filePath, $file, 'public');
              $i++;

          }
      }

      dd($this->paths);

      $resp = AdminEmailLog::create([
          'email'      => $this->email,
          'subject'    => $this->subject,
          'body'       => $this->body,
          'student_id' => $request->student_id,
          'user'       => Auth::user(),
          'paths'      => $this->paths
      ]);


      Mail::to($request->email)->send(new SendMail($resp,$this->paths));

      $data = [ 'student_id' =>$request->student_id, 'activity' => "Course Shorlisted by Admin" ];
            insertAdminLog($data);





      $request->session()->flash('success','Successfuly Send email');
      return back();


      //send Email

      /*insert in the database
           fields
           1.student_id
           2 Email_id
           3 body
           4.send_by
       */
    }




}
