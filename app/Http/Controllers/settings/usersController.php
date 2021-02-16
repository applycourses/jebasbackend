<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Deparment;
use Illuminate\Support\Facades\Storage;
use App\Mail\UsersRegistration;
use Illuminate\Support\Facades\Mail;
use App\User;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dep  =  Deparment::pluck('name','id')->all();
        $data = User::orderBy('id', 'desc')->paginate(20);       
        return view('contents.settings.users.list',compact('dep','data'));
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
        $data             = $request->except('_token');       
        $password         = random_password(8);
        $data['password'] = bcrypt($password);

        if($request->avatar){          
            $path = Storage::disk('s3')->put('staff/avatars', $request->avatar, 'public');
            $data['image_path'] = $path;
        }

        $response = User::create($data);

        if($response->id){
             Mail::to($request->email)->send(new UsersRegistration($data['email'],$password));
             $request->session()->flash('status','Successfully Account Created');
             return redirect('users');
        }
            
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
       $user = User::find($id);
       return view('contents.settings.users.view',compact('user'));
      // return response()->json($user);
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
        $user = User::find($id);
        $status = $user->toggleFlag()->save();
        return  ($status) ?  response()->json(['success' => true]) : response()->json(['success' => false]);
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
