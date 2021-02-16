<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enquiry;
use Carbon\Carbon;
use Auth;
use App\EnquiryReply;
use App\Mail\EnquiryReplyMail;
use Mail;
use App\StudyLevel;
use App\faqs;

use App\Mail\FirstEnquiryEmail;


class EnquiryController extends Controller
{
    
     public function index(Request $request)
    {
        
        $levels = StudyLevel::pluck('name','name')->all();
        $per_page  = ($request->show) ? $request->show : 20;

        if($request->search == 'search')
        {        
           
            $query = Enquiry::where('id','>','0');
             // name Request is present
             if($request->has('name')){        
                $query->where('enquiry_no', 'like', '%'.$request->name.'%');
                $query->orWhere('name', 'like', '%'.$request->name.'%');
                $query->orWhere('email', 'like', '%'.$request->name.'%');
                $query->orWhere('contact', 'like', '%'.$request->name.'%');
             } 

             if($request->has('citizenship')){ 
                 $query->where('citizenship', 'like', '%'.$request->citizenship.'%');
             }  
            
             if($request->has('desired_country')){ 
                $query->where('willing_country', 'like', '%'.$request->desired_country.'%');
             }   

             if($request->has('country_living')){ 
                $query->where('country_from', 'like', '%'.$request->country_living.'%');
             }   

            
             if($request->has('study_level')){
                 $query->where('study_level_id',$request->study_level);
             }    
            
             if($request->has('status')){
                $s = $request->status;
                if($s == 'NULL'){$s = null; }
                 $query->where('status',$s);
             }    

             if($request->has('type')){ 
                 $query->where('type', 'like', '%'.$request->type.'%');
             }   

             if($request->has('daterangepicker_start') && $request->has('daterangepicker_end')){ 
                  $start = Carbon::parse($request->daterangepicker_start)->format('Y-m-d');
                  $end =   Carbon::parse($request->daterangepicker_end)->format('Y-m-d');
                  $query ->whereBetween('date', [$start, $end]);
             }  
             
            $query->orderBy('updated_at', 'desc');                             
            $enquiries = $query->paginate($per_page);
           
        }else{
             $enquiries = Enquiry::orderBy('updated_at', 'desc')->paginate($per_page);
            
        }    

          
        return view('contents.enquiry.list',compact('enquiries','levels'));
    }

    public function get_data(Request $request){
        $per_page  =  ($request->show) ? $request->show : 20;
        $enquiries = Enquiry::orderBy('updated_at', 'desc')->paginate($per_page);
        return response()->json([$enquiries]);
    }
    public function show($id){
          $data       = Enquiry::findOrFail($id);
          $faqs       = faqs::distinct()->get(['category']);
          $categories = $faqs->pluck('category','category')->all();
          $replies =  EnquiryReply::where('enquiry_id',$id)->orderby('created_at','desc')->get();

          return view('contents.enquiry.view',compact('data','replies','categories'));         
    }

     public function sendEnquiryReply(Request $request)
     { 
        $enquiry_details     = Enquiry::where('id',$request->id)->first();
        $enquiry_no          = $enquiry_details->enquiry_no;
        $email               = $enquiry_details->email;
        $input               = $request->except('_token');
        $input['enquiry_id'] = $request->id;
        $input['user_id']    = Auth::user()->email;
        $input['name']       = Auth::user()->name;
        $input['enquiry_no'] = $enquiry_no;
        $response            = EnquiryReply::create($input);
        
        if($response->id){
            Mail::to($enquiry_details->email)->send(new EnquiryReplyMail($response));      
            $request->session()->flash('message', 'Mail Sent Successfully');
            return back();
       }          
        else
            echo "fail";
    }

    public function create(){
        $levels = StudyLevel::pluck('name','name')->all();
        return view('contents.enquiry.new',compact('levels'));
    }

    public function store(Request $request){
         $this->validate($request, [
            'name'            => 'required|max:191',
            'skype'           => 'required|max:191',
            'phone'           => 'required',
            'email'           => 'required|email',
            'current_country' => 'required',
            'willing_country' => 'required',
            'citizenship'     => 'required',
            'study_level_id'  => 'required',
            'query'           => 'required'
        ]);

        $social_name              = [];
        $input                    = $request->except('_token');
        $input['contact']         = $request->phone;
        $input['date']            = date('Y-m-d');
        $input['country_from']    = $request->current_country;
        $input['willing_country'] = $request->willing_country;
        $enquiry                  = Enquiry::all();
        $enquiry_no               = $enquiry->count();
        $input['enquiry_no']      = 'AC/ENQ/'.date('Y').'/'.($enquiry_no+1);
        $input['type']            = 'Office Enquiry';
        $input['student_id']      = (Auth::check())? Auth::user()->stu_id : 'NO';


        foreach($request->social_account_name as $key=> $value){        
        if($value)
                $social_name[$key] =  [ 'name' => $value ,'id' => $request->social_account_id[$key] ];
        }
           
        $input['web_contact'] = json_encode($social_name);
        $enquiry              = Enquiry::create($input);


        if($enquiry->id){
             Mail::to($request->email)->send(new FirstEnquiryEmail($enquiry));           
           $request->session()->flash('status', 'Successfully Registered!');
        }else{
           $request->session()->flash('status', 'Error in Registering!');
        }

        return redirect('enquiry');

             
    }

}
