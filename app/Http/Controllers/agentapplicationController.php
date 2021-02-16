<?php

namespace App\Http\Controllers;
use App\AgentApplication as ApplicationModel;
use App\AgentApplicationStatus;
use App\ApplicationStatusDocument;
use App\Comment;
use App\DocumentRequiredName;
use App\Documents;
use App\CustomClass\AgentApplication;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class agentapplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  Application::showAllApplicationList();
        return view('contents.crm.application.list',compact('data'));
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
        $application = new AgentApplication();
        $data = $application->showApplication($id);
        return json_encode($data);
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
    public function destroy($id)
    {
        //
    }
    public function updateApplicationStatusOfStudent(Request $request){

       $this->validate($request,[
            'application_id' => 'required|numeric',
            'category'       => 'required',
            'documents_id'   => 'sometimes',
            'remarks'        => 'sometimes'
        ]);
        $input = $request->all();

        $application =  new AgentApplication();
      
        return $application->updateApplicationStatusOfStudent($input);
    }
    public function university_based_on_country_id(Request $request){
        $country_id = $request->assign_country;
        $country_name = Country::find($country_id)->name;
        $type= $request->assign_type;
        if($type= "university"){
           $data = University::where('country',$country_name)->pluck('name','id')->all();
        }else{
            $data = University::where('country',$country_name)->pluck('name','id')->all();
        }
        return response()->json($data);
    }
    public function department_based_on_university_id(Request $request){
        $id = $request->university_id;
        $type = $request->type;
        if($type == 'university'){
            $data = UniversityDepartment::where('university_id',$id)->pluck('name','id');
            return response()->json($data);
        }
    }
    public function assign(Request $request){
        $this->validate($request,[
            'type'       => 'required',
            'name'       => 'required',
            'country'    => 'required',
            'department' => 'required',
            'documents'  => 'required',
            'mailto'     => 'required|email',
            'cc'         => 'sometimes',
            'subject'    => 'required',
            'message'    => 'required',
        ]);
      //  return $request->all();

        $data['type']           = $request->type;
        $data['application_id'] = $request->application_id;
        $data['country']        = $request->country;
        $data['name']           = $request->name;
        $data['department']     = $request->department;
        $data['assigned_by']      = Auth::user()->id;

        $data = AssignApplicationDB::create($data);

        if($data){
            //::to($request->mailto)
            //    ->cc($request->cc)
             //   ->send(new AssignApplication($request->all()));
            $request->session()->flash('status','Successfully Added');
        }
        return redirect('/application');
    }
    public function document_upload(Request $request){
        $student_id           = CourseApplied::find($request->course_applied_id)->student_id;
        $s3                   = \Storage::disk('s3');
        $path                 = date('Y') . '/' . $student_id;

        $input['course']      = $request->course_applied_id;
        $input['document_id'] = $request->name;
        $input['category']    = DocumentCategory::where('name', 'University Application')->first()->id;
        $input['admin']       = 1;
        $input['uploaded_by'] = 'admin';
        $input['uploaded_id'] = Auth::user()->id;
        $input['path']        = $s3->put($path, $request->document, 'public');
        $input['student_id']  = $student_id;
        $input['student_reg_id'] = StudentList::find($student_id)->stu_id;

        $resp                = StudentDocument::create($input);
        if($resp->id)
            $request->session()->flash('success','Successfully Uploaded');
        else
            $request->session()->flash('danger','Error in Uploading');

        return back();

    }
    public function send_mail(Request $request){
        $this->validate($request,[
            'type'       => 'required',
            'documents'  => 'required',
            'mailto'     => 'required|email',
            'cc'         => 'sometimes',
            'subject'    => 'required',
            'message'    => 'required',
        ]);

        //Mail::to($request->mailto)
          //  ->cc($request->cc)
            //->send(new AssignApplication($request->all()));
    }
    public function getApplicationStatusOfStudent($id){
      $application = AgentApplicationStatus::select('application_id','status','application_status_document','remarks','created_at','id')
                                          ->where('application_id',$id)
                                          ->orderBy('id','DESC')
                                          ->get();
      if($application->count() >= 0)
          return response()->json($application);
      else{
          $message = ['success' => true];
          return response()->json($message);
      }

    }
    public function getApplicationStatusDocumentOfStudent(Request $request){
        $application_id =  $request->application_id;
        $status_id      =  $request->status_id;
        $data           = ApplicationStatusDocument::where('application_status_documents.application_status_id',$status_id)
                                                    ->join('documents','documents.id','=','application_status_documents.document_id')
                                                    ->select('documents.document_id','documents.path','application_status_documents.id')
                                                    ->get();
        foreach($data as $key => $value){
            $data[$key]->document_name  =  DocumentRequiredName::where('id',$value->document_id)->first()->name;
            $data[$key]->document_path  =  Storage::disk('s3')->url($value->path);
        }
        return response()->json($data);
    }
    public function deleteApplicationStatusOfStudent($id){
        $data           = ApplicationStatusDocument::find($id);
        $resp           = $data->delete();
        if($resp){
            $message = [ 'success' => true];
        }else{
            $message = [ 'success' => false];
        }
        return response()->json($message);
    }
    public function AddApplicationStatusDocumentOfStudent(Request $request){

        $this->validate($request,[
            'application_id' => 'required|integer',
            'document_id' => 'required',
            'status_id' => 'required|integer',
        ]);
        foreach($request->document_id as $key => $value){
            ApplicationStatusDocument::create([
                'application_id' => $request->application_id,
                'document_id'    => $value,
                'application_status_id' => $request->status_id,
            ]);
        }
        $message = ['success' => true];
        return response()->json($message);
    }

    public function  remarks(Request $request){
        $id         =   $request->id;
        $comments   =   Comment::select('comments.user_id','comments.comment','comments.created_at','users.name')
                                ->where('comments.type','application-list')
                                ->where('comments.type_id',$id)
                                ->orderBy('comments.created_at','DESC')
                                ->join('users','users.id','=','comments.user_id')
                                ->get();
        return response()->json($comments);
    }

    public function submitRemarks(Request $request){
        $input            = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['type']    = 'application-list';

        $response         = Comment::create($input);
        if($response->id){
            $data = ['success' => true , 'message' => 'Successfully Inserted' ];
        }else{
            $data = ['success' => false , 'message' => 'Error in Inserting Try Again Later . Contact Admin' ];
        }
        return response()->json($data);
    }


}
