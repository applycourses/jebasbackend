<?php

namespace App\Http\Controllers;

use App\CountryProfile;
use App\CountryProfileImage;
use Illuminate\Http\Request;
use App\Country;
use Session;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = Country::pluck('name','name')->all();
        if($request->name){

            $data      = CountryProfile::where('country',$request->name)->paginate(50);
        }else{
            $data      = CountryProfile::paginate(50);
        }


       return view('contents.blogs.country_profile.list',compact('data','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name','name')->all();
        return view('contents.blogs.country_profile.add',compact('countries'));
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
                'country' => 'required|unique:frontend.country_profiles',
                'featured_image' => 'required',
                'country' =>'required',
                'statistics' => 'required',
                'about' => 'required|min:400',
                'image.*' => 'required',
                'content.*' => 'required',
                'source.*' => 'required',
                'image_name.*' => 'required'
       ]);

        //dd($request->all());
        $input                          = $request->all();
        $s3                             = \Storage::disk('s3');
        $filePath                       = 'countryProfile/' . $request->country;
        $path                           = $s3->put($filePath, $request->featured_image, 'public');
        $input['featuredImage']         = $path;
        $input['study_in_country']      = $request->why_study;
        $input['living_in_country']     = $request->living;
        $input['study_option']          = $request->study_option;
        $input['scholarship_money']     = $request->scholarship_money;
        $input['international_student'] = $request->international_students;
        $input['education_system']      = $request->education_system;
        $input['fb_page']               = $request->fb_page;
        $country_profile        = CountryProfile::create($input);




        $banner = [];
        foreach($request->image_name as $key => $value){
            $banner[$key]['country_profile_id'] = $country_profile->id;
            $banner[$key]['image_name'] = $request->image_name[$key];
            $banner[$key]['content']    = $request->content[$key];
            $banner[$key]['source']     = $request->source[$key];
            $filePath                   = 'countryProfile/'.$request->country;
            $path                       = $s3->put($filePath,$request->image[$key], 'public');
            $banner[$key]['image']      =   $path  ;
        }
        $response = CountryProfileImage::insert($banner);
        if($response){
            $request->session()->flash('success','Successfully Added');
        }else{
            $request->session()->flash('error','Error in adding please try again');
        }
        return redirect('/blogs');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $countries = Country::pluck('name','name')->all();
        $data =  CountryProfile::find($id);
        $banner  = CountryProfileImage::where('country_profile_id',$id)->get();
        return view('contents.blogs.country_profile.edit',compact('countries','data','banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
//        return dd($request->all());
        $this->validate($request,[
            'country'                => 'required|unique:frontend.country_profiles',
            'featured_image'         => 'sometimes|required',
            'country'                => 'required',
            'statistics'             => 'required',
            'about'                  => 'required|min:400',
            'image.*'                => 'sometimes|required',
            'content.*'              => 'sometimes|required',
            'source.*'               => 'sometimes|required',
            'image_name.*'           => 'sometimes|required',
            // 'why_study'              => 'sometimes|URL',
            // 'living'                 => 'sometimes|URL',
            // 'study_option'           => 'sometimes|URL',
            // 'scholarship_money'      => 'sometimes|URL',
            // 'international_students' => 'sometimes|URL',
            // 'education_system'       => 'sometimes|URL',
        ]);

        $country                = CountryProfile::find($id);
        $s3                     = \Storage::disk('s3');
        $filePath               = 'countryProfile/'.$request->country;
        $data                   = [];
        $path                    =     false;
        if($request->hasFile('featured_image')) {
            //return  "Hello";
            $path = $s3->put($filePath,$request->featured_image, 'public');
        }
        $country_profile_data = [
            'country'               => $request->country,
            'statistics'            => $request->statistics,
            'about'                 => $request->about,
            'study_in_country'      => $request->study_in_country,
            'living_in_country'     => $request->living_in_country,
            'study_option'          => $request->study_option,
            'scholarship_money'     => $request->scholarship_money,
            'international_student' => $request->international_student,
            'education_system'      => $request->education_system,
            'fb_page'               => $request->fb_page,
            'featuredImage'         => ($path) ? $path : $country->featuredImage,
        ];
        $country->update($country_profile_data);
        if($request->has('image_name')){
            foreach($request->image_name as $key=>$value){
                $data['country_profile_id'] = $id;
                $data['image_name']     = $request->image_name[$key];
                $data['content']        = $request->content[$key];
                $data['source']         = $request->source[$key];
                $data['image']          = $s3->put($filePath,$request->image[$key], 'public');
                CountryProfileImage::create($data);
            }
        }

        $request->session()->flash('success','Successfully Updated');
        return redirect('/blogs');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $country_profile = CountryProfile::find($id);
       $country_profile->delete();
//       return redirect('blogs');
       $banner = CountryProfileImage::where('country_profile_id',$id)->get();
       foreach($banner as $key => $value){
           \Storage::delete($value->image);
           $value->delete();
       }
       Session::flash('success','Successfully Deleted');
       return redirect('blogs');
    }

    public function deleteBannerImage($id){
        $data = CountryProfileImage::find($id);
        \Storage::delete($data->image);
        $response = $data->delete();
        if($response){
            $message = ['success' => true ,'message' => 'Successfully Deleted'];
        }else{
            $message = ['success' => false ,'message' => 'Error in Deleting'];
        }
        return response()->json($message);
    }
}
