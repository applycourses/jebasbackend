<?php

namespace App\Http\Controllers;

use App\Country;
use App\Currency;
use App\Statistics;
use App\StatisticsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stats = Statistics::select(DB::raw('count(id) as id, country,category'))
                            ->groupBy('country','category')
                            ->get();

        return view('contents.blogs.statistics.list',compact('stats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name','name')->all();
        $currencies = Currency::pluck('name','name')->all();
        $categories = StatisticsCategory::pluck('name','name')->all();
        return view('contents.blogs.statistics.new',compact('countries','categories','currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     // return $request->all();
      $this->validate($request,[
          'country'  => 'required',
          'category' => 'required',
          'name'     => 'required|array',
          'value'    => 'required|array|',
          'total'   =>  'required',

          'currency' => 'required',
      ]);

      $data = [];
      $data['total']    = $request->total;
      $data['country']  = $request->country;
      $data['category'] = $request->category;

      $data['currency']  = $request->currency;

      foreach($request->name as $key => $value){
          $data['details'][$key] = [ 'name' => $value,'value'=> $request->value[$key] ];
      }
      $data['details'] = json_encode($data['details']);


      $resp = Statistics::create($data);
      if($resp->id){
          $request->session()->flash('success','Successfully Created new statistic');
      }else{
          $request->session()->flash('danger','Error in creating');
      }
      return redirect('statistics');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

       $statistics =   Statistics::where('country',$id)
                                  ->where('category',$request->category)
                                   ->first();
       $currencies = Currency::pluck('name','name')->all();


       return view('contents.blogs.statistics.edit',compact('statistics','currencies'));
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
        $oldData = Statistics::find($id);
        $data = [];
        $data['currency']  = $request->currency;

        foreach($request->name as $key => $value){
            $data['details'][$key] = [ 'name' => $value,'value'=> $request->value[$key] ];
        }
        $data['details'] = json_encode($data['details']);
        $resp = $oldData->update([
                               'details' => $data['details'],
                               'total' => $request->total,
                                'currency' => $request->currency
                              ]);
        if($resp)
            $request->session()->flash('success','successfully updated');
        else
            $request->session()->flash('danger','error in updatign');

        return redirect('statistics');

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

    public function createCategory(Request $request){
        $this->validate($request,[
           'name' => 'required|unique:frontend.statistics_categories'
        ]);
        $resp = StatisticsCategory::create([
            'name'=> $request->name
        ]);
        if($resp->id){
            $request->session()->flash('success','Category created Successfully');
        }else{
            $request->session()->flash('danger','Error in creating the category');
        }
        return redirect('statistics');
    }
}
