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
                                            <div class="tab-pane active " id="step1">
                                                <form name="step_2" action="/registration-form/step3" method="post" id="Step3Form" >
                                                    {{ csrf_field() }}
                                                    {{ Form::hidden('student_id', $student_id) }}
                                                    <div class="form-group">
                                                        <label>Do you have any work experience ?</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" class="work_experience" value="yes" name="work_experience"  {{ ($data['work_experience'] == 'yes') ? 'checked': '' }}   required>Yes
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" class="work_experience" value="no" name="work_experience" {{ ($data['work_experience'] == 'no') ? 'checked': '' }} required>No
                                                        </label>
                                                    </div>
                                                    <input type="hidden" name="no_employment" id="no_employment" value="{{ $data['no_employment'] }}">
                                                    <div class="employmentHistory">
                                                        @if($data['work_experience'] == 'yes')
                                                            @if(!empty($data['employment']))
                                                             @foreach($data['employment'] as $key => $value)
                                                                <div id="employmentRow">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <h3>Employment History</h3></div>
                                                                        <div class="col-lg-6">
                                                                            <button type="button" name="remove_history" class="btn btn-danger btn-xs pull-right removeBtn">Remove</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-20">

                                                                        <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label>Organisation</label>
                                                                                <input type="text" name="employment[{{$key}}][organisation]" class="form-control" placeholder="Name of the Organisation"  value="{{ $value['organisation'] }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label>Position</label>
                                                                                <input type="text" name="employment[{{$key}}][position]" class="form-control" placeholder="Position held in the Organisation" value="{{ $value['position'] }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label>Country</label>
                                                                                {{ Form::select('number', [ '' => 'Select Country'] + $countries, $value['country'], ['class' => 'form-control country','name' => 'employment['.$key.'][country]','required' => true,'id' => 'sec_country']) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label>State</label>

                                                                                {{ Form::select('number',getStateNamesWithCountryName($data['employment'][$key]['country'])  , $value['state'], ['class' => 'form-control','name' => 'employment['.$key.'][state]','required' => true,'id' => 'sec_state']) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label>Start Date</label>
                                                                                <input type="text" placeholder="Date of joining" data-provide="datepicker" name="employment[{{$key}}][joining_date]" class="form-control" data-provide="datepicker"  value="{{ $value['joining_date'] }}"> </div>
                                                                        </div>

                                                                        <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label>End Date</label>
                                                                                <input type="text" placeholder="Date of resigning" data-provide="datepicker" name="employment[{{$key}}][resigning_date]" class="form-control" data-provide="datepicker"  value="{{ $value['joining_date'] }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <label>Job Description</label>
                                                                            <textarea name="employment[{{$key}}][job_description]" class="form-control" rows="4" placeholder="Job Description">{{ $value['job_description'] }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            @endforeach
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="historyBtns">
                                                        @if($data['work_experience'] == 'yes')
                                                            <div class="mb-20"><button type="button" name="add_history" id="add_history" class="btn btn-success input-sm">+ Add Employment History</button></div>
                                                        @endif
                                                    </div>
                                                    <h3>Other Info</h3>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>Would you be able to fund your studies without any scholarship?</label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" class="education_funding" value="yes" name="education_funding" {{ ($data['education_funding'] == 'yes') ? 'checked': '' }} required>Yes
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" class="education_funding" value="no" name="education_funding" {{ ($data['education_funding'] == 'no') ? 'checked': '' }} required>No
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Do you have a disability?</label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" class="disability" value="yes" name="disability" {{ ($data['disability'] == 'yes') ? 'checked': '' }}   required>Yes
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" class="disability" value="no" name="disability" {{ ($data['disability'] == 'no') ? 'checked': '' }}  required>No
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label >Do you have criminal convictions?</label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" class="criminal_record" value="yes" name="criminal_record"  {{ ($data['criminal_record'] == 'yes') ? 'checked': '' }} required>Yes
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" class="criminal_record" value="no" name="criminal_record" {{ ($data['criminal_record'] == 'no') ? 'checked': '' }}  required>No
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6" id="disabilityDetails">
                                                            @if($data['disability'] == 'yes')
                                                                <div class="form-group">
                                                                    <textarea name="disability_detail" class="form-control" rows="4" placeholder="Please enter your details Of disability" required> {{ $data['disability_detail'] }} </textarea>
                                                                </div>

                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6" id="criminalDetails">
                                                            @if($data['criminal_record'] == 'yes')
                                                                <textarea name="criminal_detail" class="form-control" rows="4" placeholder="Please enter your details Of criminal convictions" required>{{ $data['criminal_detail'] }}</textarea>

                                                            @endif
                                                        </div>
                                                    </div>
                                                    <h3>Visa Information</h3>
                                                    <div class="row">
                                                        {{--<div class="col-lg-12">--}}
                                                        {{--<div class="form-group">--}}
                                                        {{--<label>Would be able to fund your studies without any scolarship?</label>--}}
                                                        {{--<label class="radio-inline">--}}
                                                        {{--<input type="radio" class="scholarship_status" value="yes" name="scholarship_status" required>Yes--}}
                                                        {{--</label>--}}
                                                        {{--<label class="radio-inline">--}}
                                                        {{--<input type="radio" class="scholarship_status" value="no" name="scholarship_status" required>No--}}
                                                        {{--</label>--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        <div class="col-lg-12">
                                                            <div class="form-group funds_label">
                                                                <label>Where are you sourcing your funds to meet the financial commitment of studies in overseas ?</label>
                                                            </div>
                                                            @if(!empty($data['funds']))
                                                            <div class="row">

                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="funds[]" class="fund" value="selfFunded"
                                                                               {{ (in_array('selfFunded',$data['funds'])) ? 'checked': '' }} >
                                                                        >
                                                                        <label> Self-Funded</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="funds[]" class="fund"  value="parents"
                                                                                {{ (in_array('parents',$data['funds'])) ? 'checked': '' }}
                                                                        >
                                                                        <label> Parents</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="funds[]" class="fund"  value="bankLoan"
                                                                                {{ (in_array('bankLoan',$data['funds'])) ? 'checked': '' }}
                                                                        >
                                                                        <label> Bank Loan</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="funds[]" class="fund"  value="employer"
                                                                                {{ (in_array('employer',$data['funds'])) ? 'checked': '' }}
                                                                        >
                                                                        <label> Employer</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="funds[]" class="fund"  value="scholarship"
                                                                                {{ (in_array('scholarship',$data['funds'])) ? 'checked': '' }}>
                                                                        <label> Scholarship</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="funds[]" class="fund" value="parentsInLaw"
                                                                                {{ (in_array('parentsInLaw',$data['funds'])) ? 'checked': '' }}>
                                                                        <label> Parents-In-Law</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="funds[]" class="fund"  value="otherRelative"
                                                                                {{ (in_array('otherRelative',$data['funds'])) ? 'checked': '' }}>

                                                                        <label> Other Relative(s) </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                                <div class="row">

                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <input type="checkbox" name="funds[]" class="fund" value="selfFunded">
                                                                            <label> Self-Funded</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <input type="checkbox" name="funds[]" class="fund"  value="parents">
                                                                            <label> Parents</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <input type="checkbox" name="funds[]" class="fund"  value="bankLoan">
                                                                            <label> Bank Loan</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <input type="checkbox" name="funds[]" class="fund"  value="employer">
                                                                            <label> Employer</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <input type="checkbox" name="funds[]" class="fund"  value="scholarship">
                                                                            <label> Scholarship</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <input type="checkbox" name="funds[]" class="fund" value="parentsInLaw">
                                                                            <label> Parents-In-Law</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <input type="checkbox" name="funds[]" class="fund"  value="otherRelative">

                                                                            <label> Other Relative(s) </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <label>Have you been refused a visa for any country?</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <input type="radio" class="visa_refused" name="visa_refused" value="yes" required
                                                                        {{ ($data['visa_refused'] == 'yes') ? 'checked': '' }}
                                                                >
                                                                <label> Yes</label>
                                                                <input type="radio" class="visa_refused" name="visa_refused" value="no" required
                                                                        {{ ($data['visa_refused'] == 'no') ? 'checked': '' }}>
                                                                <label> No</label>
                                                            </div>
                                                        </div>
                                                        <div class="visa_refused_div">
                                                            @if($data['visa_refused'] == 'yes')
                                                                <div class="form-group"> <label>If yes, please provide details and copies of any related documents.</label> <textarea class="form-control" name="visa_refused_details" id="visaRefusalDetails" required="">{{ $data['visa_refused_details'] }}</textarea> </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <label>Have any of your family members been refused a visa for any country?</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <input
                                                                        type="radio"
                                                                        name="visa_refused_family"
                                                                        class="visa_refused_family"
                                                                        value="yes" required
                                                                        {{ ($data['visa_refused_family'] == 'yes') ? 'checked': '' }} >
                                                                <label> Yes</label>
                                                                <input type="radio" name="visa_refused_family" class="visa_refused_family" value="no" required  {{ ($data['visa_refused_family'] == 'no') ? 'checked': '' }}>
                                                                <label> No</label>
                                                            </div>
                                                        </div>
                                                        <div class="visa_refused_family_div">
                                                            @if($data['visa_refused_family'] == 'yes')
                                                                <div class="form-group">
                                                                    <label>If yes, please provide details.</label>
                                                                    <textarea class="form-control" name="visa_refused_family_detais" required=""> {{ $data['visa_refused_family_detais'] }} </textarea> </div>
                                                            @endif
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <label>Are you currently studying or have you previously studied in any country?</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <input type="radio" name="overseas_studied" class="overseas_studied" value="yes"  {{ ($data['overseas_studied'] == 'yes') ? 'checked': '' }}
                                                                required>
                                                                <label> Yes</label>
                                                                <input type="radio" name="overseas_studied" class="overseas_studied" value="no" required
                                                                        {{ ($data['overseas_studied'] == 'no') ? 'checked': '' }}
                                                                >
                                                                <label> No</label>
                                                            </div>
                                                        </div>
                                                        <div class="overseas_studied_div">
                                                            @if($data['overseas_studied'] == 'yes')
                                                                <div class="form-group">
                                                                    <label>If yes, please provide details below of all Confirmation of Enrolments(COE's) for the duration of your visa. Copies must also be included with your application.</label>
                                                                    <textarea class="form-control" name="overseas_studied_details" id="overseaStudyStatusDetails" required="">{{ $data['visa_refused_details'] }}</textarea>
                                                                </div>

                                                            @endif
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <label>Are you currently awaiting a decision on another country visa application?</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <input type="radio" name="visa_previous_status" class="visa_previous_status" id="visaAppStatus" value="yes"
                                                                       {{ ($data['visa_previous_status'] == 'yes') ? 'checked': '' }}
                                                                       required>
                                                                <label> Yes</label>
                                                                <input type="radio" name="visa_previous_status" class="visa_previous_status" id="visaAppStatus" value="no"  {{ ($data['visa_previous_status'] == 'no') ? 'checked': '' }} required>
                                                                <label> No</label>
                                                            </div>
                                                        </div>
                                                        <div class="visa_previous_status_div">
                                                            @if($data['visa_previous_status'] == 'yes')
                                                                <div class="form-group">
                                                                    <label>If yes, please give details of the type of visa.</label>
                                                                    <textarea class="form-control" name="visa_previous_status_details" id="visaAppStatusDetails" required="">{{ $data['visa_previous_status_details'] }}</textarea>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>

                                                    <button class="btn btn-success btn-icon btn-icon-right fa-arrow-right" type="submit" name="step3">
                                                        <span>Save</span>
                                                    </button>
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
        var ADD_HISTORY = '<div class="mb-20"><button type="button" name="add_history" id="add_history" class="btn btn-success input-sm">+ Add Employment History</button></div>';
        var VISA_REFUSED         = '<div class="col-lg-12"> <div class="form-group"> <label>If yes, please provide details and copies of any related documents.</label> <textarea class="form-control" name="visa_refused_details" id="visaRefusalDetails" required></textarea> </div> </div>';
        var VISA_REFUSED_FAMILY  = '<div class="col-lg-12"> <div class="form-group"> <label>If yes, please provide details.</label> <textarea class="form-control" name="visa_refused_family_detais" required></textarea> </div> </div>';
        var OVERSEAS_STUDIES     = '<div class="col-lg-12"> <div class="form-group"> <label>If yes, please provide details below of all Confirmation of Enrolments(COE\'s) for the duration of your visa. Copies must also be included with your application.</label> <textarea class="form-control" name="overseas_studied_details" id="overseaStudyStatusDetails" required></textarea> </div> </div>';
        var VISA_PREVIOUS_STATUS = '<div class="col-lg-12"> <div class="form-group"> <label>If yes, please give details of the type of visa.</label> <textarea class="form-control" name="visa_previous_status_details" id="visaAppStatusDetails" required></textarea> </div> </div>';
        var DISABLITY = '<div class="form-group"> <textarea name="disability_detail" class="form-control" rows="4" placeholder="Please enter your details Of disability" required></textarea> </div>';
        var CRIMINAL = '<textarea name="criminal_detail" class="form-control" rows="4" placeholder="Please enter your details Of criminal convictions" required></textarea>';
        var COUNTRIES;

        $(function(){ get_countries(); });
        function get_countries(){ $.getJSON("/api/get-countries", function(response){ countries_option(response); }); }

        function countries_option(country_name){
            var options = '<option value="">Select Country</option>';
            $.each(country_name,function(id,name){options +="<option value ='"+id+"'>"+name+"</option>"});
            COUNTRIES = options;
            $('.country').append(COUNTRIES);
        }

        $(document).on('change','.country',function(){
            var state = $(this).parent().parent().next().find('select');
            var country_id = $(this).val();
            get_state(country_id,state)
        });

        function get_state(country,append_in){
            alert(country);
            $.ajax({
                url: '/api/get-state-by-country-name-pluck',
                type: 'GET',
                data : {country: country},
                dataType: 'JSON',
                beforeSend:function(){
                    $(append_in).empty();
                    $(append_in).append('<option value="">Loading...</option>');
                },
                success:function(response){
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

        $('.disability').click(function(){
            value = $(this).val();
            $('#disabilityDetails').empty();
            (value == 'yes') ? $('#disabilityDetails').append(DISABLITY) : '';
        });


        $('.criminal_record').click(function(){
            var value = $(this).val();
            $('#criminalDetails').empty();
            (value == 'yes') ? $('#criminalDetails').append(CRIMINAL) : '';
        });

        $('.work_experience').click(function(){
            var value = $(this).val();
            $('.historyBtns').empty();
            (value == 'yes') ? $('.historyBtns').append(ADD_HISTORY) : $('.employmentHistory').empty() ;
            (value == 'no') ? $('#no_employment').val(0) : '' ;
        });

        $(document).on('click','#add_history',function(){
            var HISTORY_COUNT = $('#no_employment').val();
            HISTORY_COUNT ++;
            $('#no_employment').val(HISTORY_COUNT);
            if (HISTORY_COUNT >= 4) return;
            var history_row = '<div id="employmentRow'+ HISTORY_COUNT +'"><div class="row"><div class="col-lg-6"><h3>Employment History</h3></div> <div class="col-lg-6"> <button type="button" name="remove_history" class="btn btn-danger btn-xs pull-right removeBtn">Remove</button></div></div><div class="row mb-20"><div class="col-lg-4"><div class="form-group"> <label>Organisation</label> <input type="text" name="employment['+HISTORY_COUNT+'][organisation]" class="form-control" placeholder="Name of the Organisation" required></div></div><div class="col-lg-4"><div class="form-group"> <label>Position</label> <input type="text" name="employment['+HISTORY_COUNT+'][position]" class="form-control" placeholder="Position held in the Organisation" required></div></div><div class="col-lg-4"><div class="form-group"> <label>Country</label> <select required="" class="form-control country" name="employment['+HISTORY_COUNT+'][country]"> '+COUNTRIES+' </select></div></div><div class="col-lg-4"><div class="form-group"> <label>State</label> <select id="expstate1" name="employment['+HISTORY_COUNT+'][state]" class="form-control" required=""><option value="">Select State</option> </select></div></div><div class="col-lg-4"><div class="form-group"> <label>Start Date</label> <input type="text" placeholder="Date of joining" data-provide="datepicker" name="employment['+HISTORY_COUNT+'][joining_date]" class="form-control" data-provide="datepicker" required></div></div><div class="col-lg-4"><div class="form-group"> <label>End Date</label> <input type="text" placeholder="Date of resigning" data-provide="datepicker" name="employment['+HISTORY_COUNT+'][resigning_date]" class="form-control" data-provide="datepicker" required></div></div><div class="col-lg-12"><div class="form-group"> <label>Job Description</label><textarea name="employment['+HISTORY_COUNT+'][job_description]" class="form-control" rows="4" placeholder="Job Description" required></textarea></div></div></div></div>';
            $('.employmentHistory').append(history_row);
        });

        $('.visa_refused').click(function(){
            var value = $(this).val();
            $('.visa_refused_div').empty();
            (value == 'yes') ? $('.visa_refused_div').append(VISA_REFUSED) :'' ;
        });

        $('.visa_refused_family').click(function(){
            var value = $(this).val();
            $('.visa_refused_family_div').empty();
            (value == 'yes') ? $('.visa_refused_family_div').append(VISA_REFUSED_FAMILY) :'' ;
        });
        $('.overseas_studied').click(function(){
            var value = $(this).val();
            $('.overseas_studied_div').empty();
            (value == 'yes') ? $('.overseas_studied_div').append(OVERSEAS_STUDIES) :'' ;
        });
        $('.visa_previous_status').click(function(){
            var value = $(this).val();
            $('.visa_previous_status_div').empty();
            (value == 'yes') ? $('.visa_previous_status_div').append(VISA_PREVIOUS_STATUS) :'' ;
        });

        $('#Step3Form').validate({
            rules: {
                'funds[]': {
                    require_from_group: [1, ".fund"]
                },
            },
            messages: {
                'funds[]' : "Please Tick One of the Below field"
            },
            errorElement: 'span',
            errorClass: "has-error",
            errorPlacement: function (error, element) {
                if(element.attr("type") == 'radio')
                    $(element).closest('.form-group').append(error);
                else if(element.attr("type") == 'checkbox')
                    $(element).parent().parent().parent().parent().find('.funds_label').append(error);
                else
                    $(element).closest('.form-group').append(error);
            }
        });

        $(document).on('click','.removeBtn',function(){
            var old_value = $('#no_employment').val();
            if(old_value != 1){
                var new_value = old_value -  1;
                $(this).parent().parent().parent().remove();
                $('#no_employment').val(new_value);
            }
        });
    </script>
@endsection