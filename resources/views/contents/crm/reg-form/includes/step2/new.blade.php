@extends('contents.layouts.app')
@section('title','Registration Form Step2')

@section('css')
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <style>
       .mb-10{
           margin-bottom:10px;
       }
    </style>
@endsection

@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Registration Form View</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> <a href="">Home</a> <i class="fa fa-circle"></i>
                </li>
                <li> <a href="pages/crm/registration_form/registration.php">Registration Form List</a> <i class="fa fa-circle"></i>
                </li>
                <li> <span class="active">Registration Form View</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    @include('contents.crm.includes.view_bar')
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-eye"></i>Registration Form View</div>
                            <div class="tools">

                                <a href="{{ URL::previous() }}" class="go_back"></a>
                            </div>
                        </div>
                        <div class="portlet-body" id="app">
                            <div class="clearfix ">
                                <div class="col-md-12">
                                    <div class="tabbable-bordered margin-bottom-15">
                                        @include('contents.crm.reg-form.includes.navbar')
                                        <div class="tab-content">
                                            <div class="tab-pane active row" id="step1">
                                                @if($data)
                                                    {{ Form::model($data, array('url' => 'registration-form/step2/edit','id'=>'step2Form','method'=>'PUT')) }}
                                                @else
                                                    <form name="step_2" action="{{ URL('/registration-form/step2')}}" method="post" id="step2Form">
                                                    {{ csrf_field() }}
                                                @endif
                                                    {{ Form::hidden('student_id', $student_id) }}
                                                    <div class="col-md-12">
                                                        <h4 class="bold">Student Qualification</h4>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Highest Qualification</th>
                                                                <th>Status of the Qualification</th>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    {{ Form::select('number', [
                                                                        '' => 'Select Qualification',
                                                                        'secondary' => 'Secondary Education',
                                                                        'higher_secondary' => 'Senior Secondary Education',
                                                                        'diploma' => 'Certificate / Diploma / Advanced Diploma',
                                                                        'ug_edu' => 'Under Graduate Education',
                                                                        'pg_edu' => 'Post Graduate Education'
                                                                    ], $data['highest_qualification'], ['class' => 'form-control','name' => 'highest_qualification','required' => true]) }}

                                                                </td>
                                                                <td>
                                                                    {{ Form::select('number', [
                                                                         '' => 'Select Status',
                                                                         'pursuing' => 'Pursuing',
                                                                         'completed' => 'Completed',
                                                                     ], $data['qualification_status'], ['class' => 'form-control','name' => 'qualification_status','required' => true]) }}

                                                                </td>
                                                            </tr>
                                                        </table>
                                                        {{--Secondary --}}

                                                        <div class="row">
                                                            <div class=" col-md-12">
                                                                <h5 class="bold bg-blue-text">
                                                                    Secondary Education ( Year 10 | O Level | Secondary School Examination )
                                                                </h5>
                                                                <div class="row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Institution Name</label>
                                                                            {{ Form::text('first_name', $data['secondary']['institution'], array('class' => 'form-control','name' =>'secondary[institution]','placeholder' => 'Name of the institution','required' => true)) }}

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Subjects</label>
                                                                            {{ Form::text('first_name', $data['secondary']['subjects'], array('class' => 'form-control','name' =>'secondary[subjects]','placeholder' => 'Name of the subject','required' => true)) }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Country</label>
                                                                            {{ Form::select('number', [ '' => 'Select Country'] + $countries, $data['secondary']['country'], ['class' => 'form-control country','name' => 'secondary[country]','required' => true,'id' => 'sec_country']) }}

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>State</label>
                                                                            {{ Form::select('number',  getStateNamesWithCountryName($data['secondary']['country']), $data['secondary']['state'], ['class' => 'form-control','name' => 'secondary[state]','required' => true,'id' => 'sec_state']) }}

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Start Date</label>
                                                                            {{ Form::text('first_name', $data['secondary']['start_date'], array('class' => 'form-control datepicker','name' =>'secondary[start_date]','placeholder' => 'Date of Admission','required' => true,'data-provide' => 'datepicker')) }}

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>End Date</label>
                                                                            {{ Form::text('first_name', $data['secondary']['end_date'], array('class' => 'form-control datepicker','name' =>'secondary[end_date]','placeholder' => 'Date of Completion','required' => true,'data-provide' => 'datepicker')) }}

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Name Of Examination</label>
                                                                            {{ Form::text('first_name', $data['secondary']['name_of_examination'], array('class' => 'form-control','name' =>'secondary[name_of_examination]','placeholder' => 'Examination name','required' => true)) }}

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Percentage or Aggregate or grade</label>
                                                                            {{ Form::text('first_name', $data['secondary']['percentage_of_marks'], array('class' => 'form-control','name' =>'secondary[percentage_of_marks]','placeholder' => '% of Marks','required' => true)) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <h5 class="bold bg-blue-text">
                                                            Higher Secondary Education ( Year 12 | A Level | Higher Secondary School Examination )
                                                        </h5>
                                                        <div>
                                                            <button type="button" name="add_hs" id="add_hs" class="btn btn-danger input-sm hs" onclick="AddRow('HS')">+ Higher Secondary</button>
                                                        </div>
                                                        <input type="hidden" name="hs_status" id="hs_status" value="{{ $data['hs_status']}}">
                                                        <div id="hs_container">
                                                            @if($data['hs_status'] == 1)
                                                                <div id="hs_div" >
                                                                    <h6>H.S.E<span class="pull-right">   <button type="button" class="btn btn-danger btn-xs removeBtn" value="hs">Remove</button></span></h6>
                                                                    <input type="hidden" name="ad_status" id="hs_status" value="{{ $data['hs_status'] }}">
                                                                    <div class="row">
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>Name Of University/School/College</label>
                                                                                {{ Form::text('first_name', $data['higher_secondary']['institution'], array('class' => 'form-control hs','name' =>'higher_secondary[institution]','placeholder' => 'Name of the institution','required' => true)) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>Subjects</label>
                                                                                {{ Form::text('first_name', $data['higher_secondary']['subjects'], array('class' => 'form-control hs','name' =>'higher_secondary[subjects]','placeholder' => 'Name of the subject','required' => true)) }}

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>Country</label>
                                                                                {{ Form::select('number', [ '' => 'Select Country'] + $countries, $data['higher_secondary']['country'], ['class' => 'form-control hs country','name' => 'higher_secondary[country]','required' => true,'id' =>'hs_country']) }}

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>State</label>
                                                                                {{ $data['higher_secondary']['country'] }}
                                                                                {{ Form::select('number',getStateNamesWithCountryName($data['higher_secondary']['country'])  ,$data['higher_secondary']['state'], ['class' => 'form-control','name' => 'higher_secondary[state]','required' => true,'id' => 'hs_state']) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>Start Date</label>
                                                                                {{ Form::text('first_name', $data['higher_secondary']['start_date'], array('class' => 'form-control ','name' =>'higher_secondary[start_date]','placeholder' => 'Date of Admission','required' => true,'data-provide' => 'datepicker')) }}

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>End Date</label>
                                                                                {{ Form::text('first_name', $data['higher_secondary']['end_date'], array('class' => 'form-control ','name' =>'higher_secondary[end_date]','placeholder' => 'Date of Completion','required' => true,'data-provide' => 'datepicker')) }}

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>Name Of Examination</label>
                                                                                {{ Form::text('first_name', $data['higher_secondary']['name_of_examination'], array('class' => 'form-control hs','name' =>'higher_secondary[name_of_examination]','placeholder' => 'Examination name','required' => true)) }}



                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>%age or Aggregate or grade</label>
                                                                                {{ Form::text('first_name', $data['higher_secondary']['percentage_of_marks'], array('class' => 'form-control hs','name' =>'higher_secondary[percentage_of_marks]','placeholder' => '% of Marks','required' => true)) }}

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>


                                                        <h5 class="bold bg-blue-text">Certificate | Diploma | Advanced Diploma</h5>
                                                        <input type="hidden" name="ad_status" id="ad_status" value="{{ $data['ad_status'] }}">
                                                        <div id="diploma_container">
                                                            @if($data['ad_status'] != 0 )
                                                                @foreach($data['diploma_edu'] as $i => $value)
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <h6 class="ad_row">Course <span class="pull-right"><button type="button" class="btn btn-danger btn-xs removeBtn" value="ad">Remove</button></span></h6></div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>Course / Programme Name</label>
                                                                                {{ Form::text('first_name', $data['diploma_edu'][$i]['course'], array('class' => 'form-control','name' =>'diploma_edu['.$i.'][course]','placeholder' => 'Name of the Course','required' => true)) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>University of Course / Programme</label>
                                                                                {{ Form::text('first_name', $data['diploma_edu'][$i]['institution'], array('class' => 'form-control','name' =>'diploma_edu['.$i.'][institution]','placeholder' => '"Name of the institution','required' => true)) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>Country</label>
                                                                                {{ Form::select('number', [ '' => 'Select Country'] + $countries, $data['diploma_edu'][$i]['country'], ['class' => 'form-control hs country','name' => 'diploma_edu['.$i.'][country]','required' => true,'id' => 'ad_country']) }}

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>State</label>
                                                                                {{ Form::select('number',getStateNamesWithCountryName($data['diploma_edu'][$i]['country'])  , $data['diploma_edu'][$i]['state'], ['class' => 'form-control hs ','name' => 'diploma_edu['.$i.'][state]','required' => true,'id' => 'ad_state']) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>Start Date</label>
                                                                                {{ Form::text('first_name', $data['diploma_edu'][$i]['start_date'], array('class' => 'form-control datepicker','name' =>'diploma_edu['.$i.'][start_date]','placeholder' => 'Date of Admission','required' => true,'data-provide' => 'datepicker')) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>End Date</label>
                                                                                {{ Form::text('first_name', $data['diploma_edu'][$i]['end_date'], array('class' => 'form-control datepicker','name' =>'diploma_edu['.$i.'][end_date]','placeholder' => 'Date of completion','required' => true,'data-provide' => 'datepicker')) }}
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>Select Course Type</label>
                                                                                {{ Form::select('number', [
                                                                                          '' => 'Select Course Type',
                                                                                          'Advance Diploma' => 'Advance Diploma',
                                                                                          'Diploma' => 'Diploma',
                                                                                          'Certificate' => 'Certificate',
                                                                                ], $data['diploma_edu'][$i]['type_of_course'], ['class' => 'form-control','name' => 'diploma_edu['.$i.'][type_of_course]','required' => true]) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>%age or Aggregate or grade</label>
                                                                                {{ Form::text('first_name', $data['diploma_edu'][$i]['percentage_of_marks'], array('class' => 'form-control','name' =>'diploma_edu['.$i.'][percentage_of_marks]','placeholder' => '% of Marks','required' => true)) }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="mb-20">
                                                            <button type="button" name="add_diploma" id="add_ad" class="btn btn-danger input-sm" onclick="AddRow('AD')">+ Diploma/Certificate Course</button>
                                                        </div>

                                                        <h5 class="bold bg-blue-text">Bachelor Degree</h5>
                                                        <input type="hidden" name="ug_status" id="ug_status"  value="{{ $data['ug_status'] }}">
                                                        <div id="ug_container">
                                                            @if($data['ug_status'] != 0 )
                                                                @foreach($data['ug_edu'] as $i => $value)
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <h6 class="ad_row">Course <span class="pull-right"><button type="button" class="btn btn-danger btn-xs removeBtn" value="ug">Remove</button></span></h6></div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>Course / Programme Name</label>
                                                                                {{ Form::text('first_name', $data['ug_edu'][$i]['course'], array('class' => 'form-control','name' =>'ug_edu['.$i.'][course]','placeholder' => 'Name of the Course','required' => true)) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>University of Course / Programme</label>
                                                                                {{ Form::text('first_name', $data['ug_edu'][$i]['institution'], array('class' => 'form-control','name' =>'ug_edu['.$i.'][institution]','placeholder' => '"Name of the institution','required' => true)) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>Country</label>
                                                                                {{ Form::select('number', [ '' => 'Select Country'] + $countries, $data['ug_edu'][$i]['country'], ['class' => 'form-control hs country','name' => 'ug_edu['.$i.'][country]','required' => true,'id' => 'ad_country']) }}

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>State</label>
                                                                                {{ Form::select('number',getStateNamesWithCountryName($data['ug_edu'][$i]['country'])  ,$data['ug_edu'][$i]['state'], ['class' => 'form-control hs ','name' => 'ug_edu['.$i.'][state]','required' => true,'id' => 'ad_state']) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>Start Date</label>
                                                                                {{ Form::text('first_name', $data['ug_edu'][$i]['start_date'], array('class' => 'form-control datepicker','name' =>'ug_edu['.$i.'][start_date]','placeholder' => 'Date of Admission','required' => true,'data-provide' => 'datepicker')) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>End Date</label>
                                                                                {{ Form::text('first_name', $data['ug_edu'][$i]['end_date'], array('class' => 'form-control datepicker','name' =>'ug_edu['.$i.'][end_date]','placeholder' => 'Date of completion','required' => true,'data-provide' => 'datepicker')) }}
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>Select Course Type</label>
                                                                                <label>Select Course Type</label>
                                                                                {{ Form::select('number', [
                                                                                          '' => 'Select Course Type',
                                                                                          'Bachelor' => 'Bachelor',
                                                                                ], $data['ug_edu'][$i]['type_of_course'], ['class' => 'form-control','name' => 'ug_edu['.$i.'][type_of_course]','required' => true]) }}
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label>%age or Aggregate or grade</label>
                                                                                {{ Form::text('first_name', $data['ug_edu'][$i]['percentage_of_marks'], array('class' => 'form-control','name' =>'ug_edu['.$i.'][percentage_of_marks]','placeholder' => '"Name of the institution','required' => true)) }}

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="mb-20">
                                                            <button type="button" name="add_ug" id="add_ug" class="btn btn-danger input-sm" onclick="AddRow('UG')">+ Ug Course</button>
                                                        </div>

                                                        <h5 class="bold bg-blue-text">Post Graduate Certificate | Post Graduate Diploma | Masters</h5>
                                                            <input type="hidden" name="pg_status" id="pg_status" value="{{ $data['pg_status'] }}">
                                                            <div id="pg_container">
                                                                @if($data['pg_status'] != 0 )
                                                                    @foreach($data['pg_edu'] as $i => $value)
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <h6 class="ad_row">Course <span class="pull-right"><button type="button" class="btn btn-danger btn-xs removeBtn" value="pg">Remove</button></span></h6></div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Course / Programme Name</label>
                                                                                    {{ Form::text('first_name', $data['pg_edu'][$i]['course'], array('class' => 'form-control','name' =>'pg_edu['.$i.'][course]','placeholder' => 'Name of the Course','required' => true)) }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>University of Course / Programme</label>
                                                                                    {{ Form::text('first_name', $data['pg_edu'][$i]['institution'], array('class' => 'form-control','name' =>'pg_edu['.$i.'][institution]','placeholder' => '"Name of the institution','required' => true)) }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Country</label>
                                                                                    {{ Form::select('number', [ '' => 'Select Country'] + $countries, $data['pg_edu'][$i]['country'],['class' => 'form-control hs country','name' => 'pg_edu['.$i.'][country]','required' => true,'id' => 'ad_country']) }}

                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>State</label>
                                                                                    {{ Form::select('number',getStateNamesWithCountryName($data['pg_edu'][$i]['country'])  , $data['pg_edu'][$i]['state'], ['class' => 'form-control hs ','name' => 'pg_edu['.$i.'][state]','required' => true,'id' => 'ad_state']) }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Start Date</label>
                                                                                    {{ Form::text('first_name', $data['pg_edu'][$i]['start_date'], array('class' => 'form-control datepicker','name' =>'pg_edu['.$i.'][start_date]','placeholder' => 'Date of Admission','required' => true,'data-provide' => 'datepicker')) }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>End Date</label>
                                                                                    {{ Form::text('first_name', $data['pg_edu'][$i]['end_date'], array('class' => 'form-control datepicker','name' =>'pg_edu['.$i.'][end_date]','placeholder' => 'Date of completion','required' => true,'data-provide' => 'datepicker')) }}

                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Select Course Type</label>
                                                                                    {{ Form::select('number', [
                                                                                                     '' => 'Select Course Type',
                                                                                                     'Post Graduate Diploma' => 'Post Graduate Diploma',
                                                                                                     'Post Graduate Certificate' => 'Post Graduate Certificate',

                                                                                    ], $data['pg_edu'][$i]['type_of_course'], ['class' => 'form-control','name' => 'pg_edu['.$i.'][type_of_course]','required' => true]) }}

                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>%age or Aggregate or grade</label>
                                                                                    {{ Form::text('first_name', $data['pg_edu'][$i]['percentage_of_marks'], array('class' => 'form-control','name' =>'pg_edu['.$i.'][percentage_of_marks]','placeholder' => '"Name of the institution','required' => true)) }}

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            <div class="mb-20">
                                                                <button type="button" id="add_pg" class="btn btn-danger input-sm" onclick="AddRow('PG')">+ Pg Course</button>
                                                            </div>
                                                        <div class="row additional_error">
                                                            <div class="form-group">
                                                                <label class="radio-inline">Have you taken any admission test? (eg. IELTS,TOEFL,GRE etc.)</label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" class="admission_test" value="yes" name="extra_test"  {{ ($data['extra_test'] == "yes") ? 'checked' : '' }}>Yes
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" class="admission_test" value="no" name="extra_test" {{ ($data['extra_test'] == "no") ? 'checked' : '' }}>No
                                                                </label>
                                                                <p class="error-test"></p>
                                                            </div>
                                                        </div>
                                                    <div class="additional_exam_names">
                                                        @if($data['extra_test'] == "yes")
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" id="ielts" name="extra_test_name[]" value="ielts"  class="add_exam_names"
                                                                            {{ ( in_array('ielts',$data["extra_test_name"]) )? "checked" : ''}} >
                                                                    <label for="ielts"> IELTS</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" id="toefl_ibt" name="extra_test_name[]" value="toefl_ibt"  class="add_exam_names"
                                                                            {{ ( in_array('toefl_ibt',$data["extra_test_name"]) )? "checked" : ''}} >
                                                                    <label for="toefl_ibt"> TOEFL IBT</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" id="toefl_pbt" name="extra_test_name[]" value="toefl_pbt"  class="add_exam_names"
                                                                            {{ ( in_array('toefl_pbt',$data["extra_test_name"]) )? "checked" : ''}} >
                                                                    <label for="toefl_pbt"> TOEFL(PBT)</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" id="pte"  name="extra_test_name[]"  class="add_exam_names"  value="pte" {{ ( in_array('pte',$data["extra_test_name"]) )? "checked" : ''}} >
                                                                    <label for="pteid"> PTE</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" id="gre" name="extra_test_name[]" value="gre"   class="add_exam_names" {{ ( in_array('gre',$data["extra_test_name"]) )? "checked" : ''}} >
                                                                    <label for="gre">GRE</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" id="gmat" name="extra_test_name[]"   class="add_exam_names" value="gmat"{{ ( in_array('gmat',$data["extra_test_name"]) )? "checked" : ''}} >
                                                                    <label for="gmatid">GMAT</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" id="sat" name="extra_test_name[]" value="sat"{{ ( in_array('sat',$data["extra_test_name"]) )? "checked" : ''}} >
                                                                    <label for="sat">SAT</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" id="others" name="extra_test_name[]" value="others"{{ ( in_array('others',$data["extra_test_name"]) )? "checked" : ''}} >
                                                                    <label for="others">OTHERS</label>
                                                                </div>
                                                            </div>

                                                            @foreach($data['extra_test_name'] as $key => $value)

                                                                @if( $value  === 'gre' || $value === 'gmat' || $value === 'sat')
                                                                    <div class="{{ $value }} clearfix mb-10">
                                                                        <div class="col-lg-2"><b>{{ strtoupper($value) }} </b></div>
                                                                        <div class="col-lg-2">
                                                                            <input class="form-control" type="text" name="{{ $value }}[exam_score]" placeholder="Score" required="" value=" {{ $data[$value]['exam_score'] }}">
                                                                        </div>
                                                                        <div class="col-lg-8"></div>
                                                                    </div>

                                                                @elseif($value === 'others')
                                                                    <div class="{{ $value }} clearfix mb-10">
                                                                        <div class="col-lg-2"><b>{{ strtoupper($value) }}</b></div>
                                                                        <div class="col-lg-2">
                                                                            <input class="form-control" type="text" name="{{ $value }}[exam_name]" placeholder="Exam Name" required="" value=" {{ $data[$value]['exam_name'] }}">
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <input class="form-control" type="text" name="{{ $value }}[exam_score]" placeholder="Score" required="" value=" {{ $data[$value]['exam_score'] }}">
                                                                        </div>
                                                                        <div class="col-lg-6"></div>
                                                                    </div>
                                                                @else
                                                                    <div class="{{ $value }} clearfix mb-10">
                                                                        <div class="col-lg-2"><b>{{ strtoupper($value) }}</b></div>
                                                                        <div class="col-lg-2">
                                                                            <input class="form-control" type="text" name="{{ $value }}[overall]" placeholder="Overall" required="" value=" {{ $data[$value]['overall'] }}">
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <input class="form-control" type="text" name="{{ $value }}[listening]" placeholder="Listening" required=""  value=" {{ $data[$value]['listening'] }}">
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <input class="form-control" type="text" name="{{ $value }}[reading]" placeholder="Reading" required=""  value=" {{ $data[$value]['reading'] }}">
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <input class="form-control" type="text" name="{{ $value }}[writing]" placeholder="Writting" required=""  value=" {{ $data[$value]['writing'] }}">
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <input class="form-control" type="text" name="{{ $value }}[speaking]" placeholder="Speaking" required=""  value=" {{ $data[$value]['speaking'] }}">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div id="exam_marks"></div>
                                                    <button class="btn btn-success" type="submit">Insert</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script>
    var COUNTRIES;
    var DATA;
    $(function(){get_countries();});
    function get_countries(){
        $.getJSON("/api/get-countries", function(response){ countries_option(response); });
    }
    $(document).on('change','.country',function(){
        var state = $(this).parent().parent().next().find('select');
        var country_id = $(this).val();
        get_state(country_id,state)
    });
    function get_state(country_id,append_in)
    {
        $.ajax({
            url: '/api/get-state-by-country-name-pluck',
            type: 'GET',
            data : {country: country_id},
            dataType: 'JSON',
            beforeSend:function(){
                $(append_in).empty();
                $(append_in).append('<option value="">Loading...</option>');
            },
            success:function(response){
                console.log(response);
                var options;
                $(append_in).empty();
                $(append_in).append('<option value="">Please Select State</option>');
                $.each(response,function(i,value){
                    options += '<option value="'+value.name+'">'+value.name+'</option>'
                });
                $(append_in).append(options);
            }
        });
    }

    function countries_option(country_name){
        var options = '<option value="">Select Country</option>';
        $.each(country_name,function(id,name){options +="<option value ='"+id+"'>"+name+"</option>"});
        COUNTRIES = options;
        $('.country').append(COUNTRIES);
    }

    function AddRow(type){
        switch (type){
            case 'HS':
                AddHS();
                break;
            case 'AD':
                AddAD();
                break;
            case 'UG':
                AddUG();
                break;
            case 'PG':
                AddPG();
                break;
            default:
                alert("Dont Try to be Smart");
        }
    }
    function AddHS(){
        var count = 	$('#hs_status').val();
        if(count < 1 && count == 0){
            $('#add_hs').attr('disabled',true);
            $('#hs_status').val(++count);
            $('#hs_container').append('<div class="row"> <div class="col-lg-12"> <h6>Course <span class="pull-right"><button type="button" class="btn btn-danger btn-xs removeBtn" value="hs">Remove</button></h6> </div><div class="col-lg-3"> <div class="form-group"> <label>Institution Name</label> <input class="form-control" type="text" name="higher_secondary[institution]" placeholder="Name of Institution" value="" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Subjects</label> <input class="form-control" type="text" name="higher_secondary[subjects]" placeholder="Name of the subjects" value="" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Country</label> <select class="form-control country" name="higher_secondary[country]" required="">'+COUNTRIES+' </select> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>State</label> <select id="statesc" name="higher_secondary[state]" class="form-control" required="required"> <option value="">Select State</option> </select> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Start Date</label> <input type="text" placeholder="Date of Admission" data-provide="datepicker" name="higher_secondary[start_date]" class="form-control" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>End Date</label> <input type="text" placeholder="Date of completion" data-provide="datepicker" name="higher_secondary[end_date]" class="form-control" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Name Of Examination</label> <input type="text" name="higher_secondary[name_of_examination]" value="" class="form-control" placeholder="Examination name" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Percentage or Aggregate or grade</label> <input type="text" name="higher_secondary[percentage_of_marks]" class="form-control" placeholder="GPA" value="" required="required"> </div> </div> </div>');
        }
    }
    function AddAD(){
        var  count = ($('#ad_status').val()) ? $('#ad_status').val() : 0;
        (count == 3) ? $('#add_ad').prop('disabled',true) : '';
        if(count < 4){
            count++;
            $('#diploma_container').append('<div class="row"> <div class="col-lg-12"> <h6 class="ad_row">Course <span class="pull-right"><button type="button" class="btn btn-danger btn-xs removeBtn" value="ad">Remove</button></span></h6></div>  <div class="col-lg-3"> <div class="form-group"> <label>Course / Programme Name</label> <input class="form-control" type="text" name="diploma_edu['+count+'][course]" placeholder="Name of the course" required="required"> </div> </div><div class="col-lg-3"> <div class="form-group"> <label>University of Course / Programme</label> <input class="form-control" type="text" name="diploma_edu['+count+'][institution]" placeholder="Name of the institution" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Country</label> <select class="form-control country" name="diploma_edu['+count+'][country]" required=""> '+COUNTRIES+'</select> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>State</label> <select id="statesc" name="diploma_edu['+count+'][state]" class="form-control" required="required"> <option value="">Select State</option> </select> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Start Date</label> <input type="text" data-provide="datepicker" placeholder="Date of admission" name="diploma_edu['+count+'][start_date]" class="form-control" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>End Date</label> <input type="text" data-provide="datepicker" placeholder="Date of completion" name="diploma_edu['+count+'][end_date]" class="form-control" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Select Course Type</label> <select name="diploma_edu['+count+'][type_of_course]" class="form-control" required=""> <option value="">Select Course Type</option>  <option value="Advance Diploma">Advance Diploma</option> <option value="Diploma">Diploma</option> <option value="Certificate">Certificate</option><option value="Foundation">Foundation</option> <option value="Graduate Diploma">Graduate Diploma</option> <option value="Graduate Certificate">Graduate Certificate</option>  </select> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Percentage or Aggregate or grade</label> <input type="text" name="diploma_edu['+count+'][percentage_of_marks]" class="form-control" placeholder="GPA" value="" required="required"> </div> </div> </div>');
            $('#ad_status').val(count);
        }
    }
    function AddUG(){
        var  count = ($('#ug_status').val()) ? $('#ug_status').val() : 0;
        (count == 3) ? $('#add_ug').prop('disabled',true) : '';
        if(count < 4) {
            count++;
            $('#ug_container').append('<div class="row"> <div class="col-lg-12"> <h6>Course<span class="pull-right"><button type="button" class="btn btn-danger btn-xs removeBtn" value="ug">Remove</button></span></h6></div> <div class="col-lg-3"> <div class="form-group"> <label>University of Course / Programme</label> <input class="form-control" type="text" name="ug_edu['+count+'][institution]" placeholder="Name of the institution" required="required"> </div> </div><div class="col-lg-3"> <div class="form-group"> <label>Course / Programme Name</label> <input class="form-control" type="text" name="ug_edu['+count+'][course]" placeholder="Name of the course" required="required"> </div> </div>  <div class="col-lg-3"> <div class="form-group"> <label>Country</label> <select class="form-control country" name="ug_edu['+count+'][country]" required=""> '+COUNTRIES+' </select> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>State</label> <select id="statesc" name="ug_edu['+count+'][state]" class="form-control" required="required"> <option value="">Select State</option> </select> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Start Date</label> <input type="text" data-provide="datepicker" placeholder="Date of admission" name="ug_edu['+count+'][start_date]" class="form-control" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>End Date</label> <input type="text" data-provide="datepicker" placeholder="Date of completion" name="ug_edu['+count+'][end_date]" class="form-control" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Select Course Type</label> <select name="ug_edu['+count+'][type_of_course]" class="form-control" required=""> <option value="Bachelor">Bachelor</option> <option value="Associate Degree">Associate Degree</option> </select> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Percentage or Aggregate or grade</label> <input type="text" name="ug_edu['+count+'][percentage_of_marks]" class="form-control" placeholder="GPA" value="" required="required"> </div> </div> </div>');
            $('#ug_status').val(count);
        }
    }
    function AddPG(){
        var  count = ($('#pg_status').val()) ? $('#pg_status').val() : 0;
        (count == 3) ? $('#add_pg').prop('disabled',true) : '';
        if(count < 4) {
            count++;
            $('#pg_container').append('<div class="row"> <div class="col-lg-12"> <h6>Course <span class="pull-right"><button type="button" class="btn btn-danger btn-xs removeBtn" value="pg">Remove</button></h6> </div>  <div class="col-lg-3"> <div class="form-group"> <label>University of Course / Programme</label> <input class="form-control" type="text" name="pg_edu['+count+'][institution]" placeholder="Name of the institution" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Course / Programme Name</label> <input class="form-control" type="text" name="pg_edu['+count+'][course]" placeholder="Name of the Course" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Country</label> <select class="form-control country" name="pg_edu['+count+'][country]" required=""> '+COUNTRIES+' </select> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>State</label> <select id="statesc" name="pg_edu['+count+'][state]" class="form-control" required="required"> <option value="">Select State</option> </select> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Start Date</label> <input type="text" data-provide="datepicker" placeholder="Date of admission" name="pg_edu['+count+'][start_date]" class="form-control" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>End Date</label> <input type="text" data-provide="datepicker" placeholder="Date of completion" name="pg_edu['+count+'][end_date]" class="form-control" required="required"> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Select Course Type</label> <select name="pg_edu['+count+'][type_of_course]" class="form-control" required=""> <option value="Masters">Masters</option> <option value="Post Graduate Diploma">Post Graduate Diploma</option> <option value="Post Graduate Certificate">Post Graduate Certificate</option> </select> </div> </div> <div class="col-lg-3"> <div class="form-group"> <label>Percentage or Aggregate or grade</label> <input type="text" name="pg_edu['+count+'][percentage_of_marks]" class="form-control" placeholder="GPA" value="" required="required"> </div> </div> </div>');
            $('#pg_status').val(count);
        }
    }

    $(document).on('click','.removeBtn', function() {
        var value = $(this).val();
        var  status = $('#'+value+'_status').val();
        status--;
        (status <= 3) ? $('#add_'+value).prop("disabled",false) : '';
        $('#'+value+'_status').val(status);
        $(this).parent().parent().parent().parent().remove();
    });

    $('.admission_test').click(function(){
        var value = $(this).val();
        $('.additional_exam_names').empty();
        (value == 'yes') ?  $('.additional_exam_names').append('<div class="col-lg-3"> <div class="form-group"> <input type="checkbox" id="ielts" class="add_exam_names" name="extra_test_name[]" value="ielts"> <label for="ielts"> IELTS</label> </div> </div> <div class="col-lg-3"> <div class="form-group"> <input type="checkbox" id="toefl_ibt" name="extra_test_name[]" value="toefl_ibt" class="add_exam_names"> <label for="toefl_ibt"> TOEFL IBT</label> </div> </div> <div class="col-lg-3"> <div class="form-group"> <input type="checkbox" id="toefl_pbt" name="extra_test_name[]" value="toefl_pbt" class="add_exam_names"> <label for="toefl_pbt"> TOEFL(PBT)</label> </div> </div> <div class="col-lg-3"> <div class="form-group"> <input type="checkbox" id="pte" name="pte" value="pte" class="add_exam_names"> <label for="pteid"> PTE</label> </div> </div> <div class="col-lg-3"> <div class="form-group"> <input type="checkbox" id="gre" name="extra_test_name[]" value="gre" class="add_exam_names"> <label for="gre">GRE</label> </div> </div> <div class="col-lg-3"> <div class="form-group"> <input type="checkbox" id="gmat" name="extra_test_name[]" value="gmat" class="add_exam_names"> <label for="gmatid">GMAT</label> </div> </div> <div class="col-lg-3"> <div class="form-group"> <input type="checkbox" id="sat" name="extra_test_name[]" value="sat" class="add_exam_names"> <label for="sat">SAT</label> </div> </div> <div class="col-lg-3"> <div class="form-group"> <input type="checkbox" id="others" name="extra_test_name[]" value="others" class="add_exam_names"> <label for="others">OTHERS</label> </div> </div>') : '' ;
    });


    $(document).on('change','.additional_exam_names input[type="checkbox"]',function(){
        var name = $(this).attr('id');
        if(this.checked){
            console.log(name);
            if( name === 'gre' || name === 'gmat' || name === 'sat'){
                $('#exam_marks').append(' <div class="'+ name +' clearfix mb-10"> <div class="col-lg-2"><b>'+ name.toUpperCase() +'</b></div> <div class="col-lg-2"> <input class="form-control" type="text" name="'+name+'[exam_score]" placeholder="Score" required=""> </div> <div class="col-lg-8"></div> </div>')
            }else if(name === 'others'){
                $('#exam_marks').append('<div class="'+ name +' clearfix mb-10"> <div class="col-lg-2"><b>'+ name.toUpperCase() +'</b></div> <div class="col-lg-2"> <input class="form-control" type="text" name="'+name+'[exam_name]" placeholder="Exam Name" required=""> </div> <div class="col-lg-2"> <input class="form-control" type="text" name="'+name+'[exam_score]" placeholder="Score" required=""> </div> <div class="col-lg-6"></div> </div>')
            }else{
                $('#exam_marks').append('<div class="'+ name +' clearfix mb-10"> <div class="col-lg-2"><b>'+ name.toUpperCase() +'</b></div> <div class="col-lg-2"> <input class="form-control" type="text" name="'+name+'[overall]" placeholder="Overall" required=""></div> <div class="col-lg-2"> <input class="form-control" type="text" name="'+name+'[listening]" placeholder="Listening" required=""></div> <div class="col-lg-2"> <input class="form-control" type="text" name="'+name+'[reading]" placeholder="Reading" required=""></div> <div class="col-lg-2"> <input class="form-control" type="text" name="'+name+'[writing]" placeholder="Writting" required=""></div> <div class="col-lg-2"> <input class="form-control" type="text" name="'+name+'[speaking]" placeholder="Speaking" required=""></div> </div>');
            }
        }else{
            $('.'+name).remove();
        }
    });

    $('#step2Form').validate({
        rules: {
            'extra_test_name[]': {
                require_from_group: [1, ".add_exam_names"]
            },
        },
        messages: {
            'extra_test_name[]' : "Please Tick One of the Below field"
        },
        errorClass: 'animated shake input-error',
        errorPlacement: function (error, element) {
            if (element.attr("type") == "checkbox") {
                $(element).append(error);
            }
        }
    });
</script>
@endsection