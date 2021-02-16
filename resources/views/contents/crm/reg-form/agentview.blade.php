@extends('contents.layouts.app')
@section('title','Registration Form List')

@section('css')
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
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
            <li> <a href="">Registration Form List</a> <i class="fa fa-circle"></i>
            </li>
            <li> <span class="active">Registration Form View</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                @include('contents.crm.includes.agent_view_bar')
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"> <i class="fa fa-eye"></i>Registration Form View</div>
                        <div class="tools">
                            <a href="{{ url('/agent-registration-form/step1/'.app('request')->input('student_id')).'?student_id='.app('request')->input('student_id') }}" class="edit"></a>
                            <a href="{{ URL::previous() }}" class="go_back"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix">
                            @if(empty($data))
                                <h1>No Data</h1>
                            @else
                                <div class="tabbable-bordered">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#step1" data-toggle="tab"> Step 1</a>
                                        </li>
                                        <li>
                                            <a href="#step2" data-toggle="tab"> Step 2</a>
                                        </li>
                                        <li>
                                            <a href="#step3" data-toggle="tab"> Step 3</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="step1">
<?php 
    // if($data->step1){
    //     dd($data->step1);
    //     //echo $data->step1['mailing_state'];
    //     die();
    // }
?>
                                            @if($data->step1)
                                                <div class="clearfix">
                                                    <div class="col-md-12">
                                                        <h4 class="bold">Mailing Address And Personal Information</h4>
                                                        <h5 class="bold bg-blue-text">Personal Information</h5>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Country Of Birth</th>
                                                                <td colspan="2">{{  get_country_name($data->step1['country_of_birth']) }}</td>
                                                                <th>Marital Status</th>
                                                                <td>{{ $data->step1['marital_status']}}</td>
                                                                <th>No of  Dependants</th>
                                                                <td colspan="2">{{ $data->step1['noOfDependants']}}</td>
                                                            </tr>


                                                        </table>
                                                    </div>

                                                    @if( $data->step1['noOfDependants'] > 0 )
                                                        <div class="col-md-12">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <th>Sl. No.</th>
                                                                    <th>Full Name</th>
                                                                    <th>Relationship with the Dependant</th>
                                                                    <th>Wanna Take ?</th>
                                                                </tr>
                                                                @foreach(($data->step1['dependent']) as $key => $value)

                                                                    <tr>
                                                                        <td> {{ ++$key }}</td>
                                                                        <td>{{ $value['name'] }}</td>
                                                                        <td>{{ $value['relation'] }}</td>
                                                                        <td> {{ ($value['take'] == "true") ? 'Yes' : 'No'}} </td>
                                                                    </tr>
                                                                @endforeach

                                                            </table>
                                                        </div>
                                                    @endif

                                                    <div class="col-md-6">
                                                        <h5 class="bold bg-blue-text">Mailing Address</h5>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Full Address</th>
                                                                <td>{{ $data->step1['mailing_address'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>City</th>
                                                                <td>{{ $data->step1['mailing_city'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>State</th>
                                                                <td>{{ get_state_name($data->step1['mailing_state']) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Country</th>
                                                                <td>{{ get_country_name($data->step1['mailing_country']) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Postal Code</th>
                                                                <td>{{ $data->step1['mailing_pincode'] }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <?php //print_r($data); die(); ?>
                                                    <div class="col-md-6">
                                                        <h5 class="bold bg-blue-text">Permanent Address</h5>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Full Address</th>
                                                                <td>{{ $data->step1['permanent_addres'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>City</th>
                                                                <td>{{ $data->step1['permanent_city'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Country</th>
                                                                <td>{{ get_country_name($data->step1['permanent_country']) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>State</th>
                                                                <td>{{ get_state_name($data->step1['permanent_state']) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Postal Code</th>
                                                                <td>{{ $data->step1['permanent_pincode'] }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            @else
                                                <h1> Step Not Completed</h1>
                                            @endif
                                        </div>
                                        <div class="tab-pane" id="step2">
                                            @if($data->step2)
                                                <div class="clearfix">
                                                    <div class="col-md-12">
                                                        <h4 class="bold">Student Qualification</h4>

                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Highest Qualification</th>
                                                                <th>Status of the Qualification</th>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ $data->step2['highest_qualification'] }}</td>
                                                                <td>{{ $data->step2['qualification_status'] }}</td>
                                                            </tr>
                                                        </table>

                                                        <h5 class="bold bg-blue-text">Secondary Education ( Year 10 | O Level | Secondary School Examination )</h5>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Name Of University/School/College</th>
                                                                <th>Subjects</th>
                                                                <th>Country</th>
                                                                <th>State</th>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ $data->step2['secondary']['institution'] }}</td>
                                                                <td>{{ $data->step2['secondary']['subjects'] }}</td>
                                                                <td>{{ get_country_name($data->step2['secondary']['country']) }}</td>
                                                                <td>{{ get_state_name($data->step2['secondary']['state']) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
                                                                <th>Name Of Examination</th>
                                                                <th>%age or Aggregate or grade</th>
                                                            </tr>

                                                            <tr>
                                                                <td>{{ $data->step2['secondary']['start_date'] }}</td>
                                                                <td>{{ $data->step2['secondary']['end_date'] }}</td>
                                                                <td>{{ $data->step2['secondary']['name_of_examination'] }}</td>
                                                                <td>{{ $data->step2['secondary']['percentage_of_marks'] }}</td>
                                                            </tr>
                                                        </table>

                                                        @if($data['step2']['hs_status'] == 1)
                                                            <h5 class="bold bg-blue-text">Higher Secondary Education ( Year 12 | A Level | Higher Secondary School Examination )</h5>
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <th>Name Of University/School/College</th>
                                                                    <th>Subjects</th>
                                                                    <th>Country</th>
                                                                    <th>State</th>
                                                                </tr>

                                                                <tr>
                                                                    <td>{{ $data->step2['higher_secondary']['institution'] }}</td>
                                                                    <td>{{ $data->step2['higher_secondary']['subjects'] }}</td>
                                                                    <td>{{ get_country_name($data->step2['higher_secondary']['country']) }}</td>
                                                                    <td>{{ get_state_name($data->step2['higher_secondary']['state']) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Start Date</th>
                                                                    <th>End Date</th>
                                                                    <th>Name Of Examination</th>
                                                                    <th>%age or Aggregate or grade</th>
                                                                </tr>

                                                                <tr>
                                                                    <td>{{ $data->step2['higher_secondary']['start_date'] }}</td>
                                                                    <td>{{ $data->step2['higher_secondary']['end_date'] }}</td>
                                                                    <td>{{ $data->step2['higher_secondary']['name_of_examination'] }}</td>
                                                                    <td>{{ $data->step2['higher_secondary']['percentage_of_marks'] }}</td>
                                                                </tr>
                                                            </table>
                                                        @endif
                                                        @if($data['step2']['ad_status'] > 0)
                                                            <h5 class="bold bg-blue-text">Certificate | Diploma | Advanced Diploma</h5>
                                                            @foreach($data['step2']['diploma_edu'] as $key => $value)
                                                                <div class="bold margin-bottom-10"><i class="fa fa-book"></i> Course {{ $key }}</div>
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <th>Course / Programme Name</th>
                                                                        <th>University of Course / Programme</th>
                                                                        <th>Country</th>
                                                                        <th>State</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ $data->step2['diploma_edu'][$key]['course'] }}</td>
                                                                        <td>{{ $data->step2['diploma_edu'][$key]['institution'] }}</td>
                                                                        <td>{{ get_country_name($data->step2['diploma_edu'][$key]['country']) }}</td>
                                                                        <td>{{ get_state_name($data->step2['diploma_edu'][$key]['state']) }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Start Date</th>
                                                                        <th>End Date</th>
                                                                        <th>Course Type</th>
                                                                        <th>%age or Aggregate or grade</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ $data->step2['diploma_edu'][$key]['start_date'] }}</td>
                                                                        <td>{{ $data->step2['diploma_edu'][$key]['end_date'] }}</td>
                                                                        <td>{{ $data->step2['diploma_edu'][$key]['type_of_course'] }}</td>
                                                                        <td>{{ $data->step2['diploma_edu'][$key]['percentage_of_marks'] }}</td>
                                                                    </tr>
                                                                </table>
                                                            @endforeach
                                                        @endif
                                                        @if($data['step2']['ug_status'] > 0)
                                                            <h5 class="bold bg-blue-text">Bachelor Degree</h5>
                                                            @foreach($data['step2']['ug_edu'] as $key => $value)
                                                                <div class="bold margin-bottom-10"><i class="fa fa-book"></i> Course {{ $key }} </div>
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <th>Course / Programme Name</th>
                                                                        <th>University of Course / Programme</th>
                                                                        <th>Country</th>
                                                                        <th>State</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ $value['course'] }}</td>
                                                                        <td>{{ $value['institution'] }}</td>
                                                                        <td>{{ get_country_name($value['country']) }}</td>
                                                                        <td>{{ get_state_name($value['state']) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Start Date</th>
                                                                        <th>End Date</th>
                                                                        <th>Course Type</th>
                                                                        <th>%age or Aggregate or grade</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ $value['start_date'] }}</td>
                                                                        <td>{{ $value['end_date'] }}</td>
                                                                        <td>{{ $value['type_of_course'] }}</td>
                                                                        <td>{{ $value['percentage_of_marks'] }}</td>
                                                                    </tr>
                                                                </table>
                                                            @endforeach
                                                        @endif
                                                        @if($data['step2']['pg_status'] > 0)
                                                            <h5 class="bold bg-blue-text">Post Graduate Certificate | Post Graduate Diploma | Masters</h5>
                                                            @foreach($data['step2']['pg_edu'] as $key => $value)
                                                                <div class="bold margin-bottom-10"><i class="fa fa-book"></i> Course {{ $key }}</div>
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <th>Course / Programme Name</th>
                                                                        <th>University of Course / Programme</th>
                                                                        <th>Country</th>
                                                                        <th>State</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ $value['course'] }}</td>
                                                                        <td>{{ $value['institution'] }}</td>
                                                                        <td>{{ get_country_name($value['country']) }}</td>
                                                                        <td>{{ get_state_name($value['state']) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Start Date</th>
                                                                        <th>End Date</th>
                                                                        <th>Course Type</th>
                                                                        <th>%age or Aggregate or grade</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ $value['start_date'] }}</td>
                                                                        <td>{{ $value['end_date'] }}</td>
                                                                        <td>{{ $value['type_of_course'] }}</td>
                                                                        <td>{{ $value['percentage_of_marks'] }}</td>
                                                                    </tr>
                                                                </table>
                                                            @endforeach
                                                        @endif
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Have you taken any admission test? (eg. IELTS,TOEFL,GRE etc.)</th>
                                                                <td>{{ $data['step2']['extra_test'] }}</td>
                                                            </tr>
                                                        </table>
                                                        @if($data['step2']['extra_test'] == 'yes')
                                                            <table class="table table-bordered">

                                                                <tr>
                                                                    <th>Admission Test</th>
                                                                    <th>Overall</th>
                                                                    <th>Listening</th>
                                                                    <th>Reading</th>
                                                                    <th>Writing</th>
                                                                    <th>Speaking</th>
                                                                </tr>
                                                                @if(!empty($data['step2']['extra_test_name']))
                                                                    @foreach($data['step2']['extra_test_name'] as $key => $value)
                                                                        @if($value == 'ielts' || $value == 'toefl_ibt' || $value == 'toefl_pbt' || $value == 'pte' )
                                                                            <tr>
                                                                                <th> {{ strtoupper($value) }}</th>
                                                                                <td>{{ $data['step2'][$value]['overall'] }}</td>
                                                                                <td>{{ $data['step2'][$value]['listening'] }}</td>
                                                                                <td>{{ $data['step2'][$value]['reading'] }}</td>
                                                                                <td>{{ $data['step2'][$value]['writing'] }}</td>
                                                                                <td>{{ $data['step2'][$value]['speaking'] }}</td>
                                                                            </tr>
                                                                        @elseif($value == 'gre' || $value == 'gmat' ||  $value == 'sat' )
                                                                            <tr>
                                                                                <th> {{ strtoupper($value) }}</th>
                                                                                <td> {{ $data['step2'][$value]['exam_score'] }} </td>
                                                                            </tr>
                                                                        @else
                                                                            <tr>
                                                                                <th> {{ strtoupper($value) }}</th>
                                                                                <td> {{ $data['step2'][$value]['exam_name'] }} </td>
                                                                                <td> {{ $data['step2'][$value]['exam_score'] }} </td>
                                                                            </tr>

                                                                        @endif
                                                                    @endforeach
                                                                @endif

                                                            </table>
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                                <h1>Step Not Completed</h1>
                                            @endif
                                        </div>
                                        <div class="tab-pane" id="step3">
                                            @if($data['step3'])
                                                <div class="clearfix">
                                                    <div class="col-md-12">
                                                        <h4 class="bold">Employment Info</h4>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Do you have any work experience ?</th>
                                                                <td>{{ $data->step3['work_experience'] }}</td>
                                                            </tr>
                                                        </table>
                                                        @if($data['step3']['work_experience'] == 'yes')
                                                            @if(!empty($data['step3']['employment']))
                                                               @foreach($data['step3']['employment'] as $key => $value)
                                                                <div class="bold margin-bottom-10 bg-blue-text">
                                                                    <i class="fa fa-briefcase"></i> Employment History 1
                                                                </div>
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <th>Organisation</th>
                                                                        <td>{{ $value['organisation'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Position</th>
                                                                        <td>{{ $value['position'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th width="25%">Job Description</th>
                                                                        <td>{{ $value['job_description'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Country</th>
                                                                        <td>{{ get_country_name($value['country']) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>State</th>
                                                                        <td>{{ get_state_name($value['state']) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Start Date</th>
                                                                        <td>{{ $value['joining_date'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>End Date</th>
                                                                        <td>{{ $value['resigning_date'] }}</td>
                                                                    </tr>
                                                                </table>
                                                            @endforeach
                                                            @endif
                                                        @endif
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Would you be able to fund your studies without any scolarship?</th>
                                                                <td>{{ $data->step3['education_funding'] }}</td>
                                                            </tr>
                                                        </table>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th width="15%">Other Info</th>
                                                                <th width="15%">Status</th>
                                                                <th>Details</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Disablity</td>
                                                                <td>{{ $data->step3['disability'] }}</td>
                                                                @if(strtolower($data->step3['disability']) == 'yes')
                                                                    <td> {{ $data->step3['disability_details'] }}</td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td>Criminal Record</td>
                                                                <td>{{ $data->step3['criminal_record'] }}</td>
                                                                @if(strtolower($data->step3['criminal_record']) == 'yes')
                                                                    <td> {{ $data->step3['criminal_record_details'] }}</td>
                                                                @endif

                                                            </tr>
                                                        </table>
                                                        <?php 
                                                           // dd($data['step3']['funds']); die();
                                                        ?>
                                                        <h4 class="bold">Visa Information</h4>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th colspan="4">Where are you sourcing your funds to meet the financial commitment of studies in overseas ?</th>
                                                            </tr>
                                                            <tr>
                                                                <td><i class="{{ ($data['step3']['funds'] == 'selfFunded') ? 'fa fa-check-square-o' : 'glyphicon glyphicon-unchecked'}}"></i>
                                                                    Self-Funded
                                                                </td>
                                                                <td>
                                                                    <i class="{{ ($data['step3']['funds'] == 'parents') ? 'fa fa-check-square-o' : 'glyphicon glyphicon-unchecked' }} "></i>
                                                                    Parents
                                                                </td>
                                                                <td>
                                                                    <i class="{{ ($data['step3']['funds'] == 'bankLoan') ? 'fa fa-check-square-o' : 'glyphicon glyphicon-unchecked' }}"></i> Bank Loan
                                                                </td>
                                                                <td><i class="{{ ($data['step3']['funds'] == 'employer') ? 'fa fa-check-square-o' : 'glyphicon glyphicon-unchecked' }}"></i> Employer</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <i class="{{ ($data['step3']['funds'] == 'scholarship') ? 'fa fa-check-square-o' : 'glyphicon glyphicon-unchecked' }}"></i>
                                                                    Scholarship
                                                                </td>
                                                                <td>
                                                                    <i class="{{ ($data['step3']['funds'] == 'parentsInLaw') ? 'fa fa-check-square-o' : 'glyphicon glyphicon-unchecked' }}"></i>
                                                                    Parents-In-Law
                                                                </td>
                                                                <td colspan="2">
                                                                    <i class="{{ ($data['step3']['funds'] == 'otherRelative') ? 'fa fa-check-square-o' : 'glyphicon glyphicon-unchecked' }}""></i> Other Relative(s)
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Have you been refused a visa for any country?</th>
                                                                <td width="10%">{{ $data['step3']['visa_refused'] }}</td>
                                                            </tr>
                                                            @if($data['step3']['visa_refused'] == 'yes')
                                                                <tr>
                                                                    <td colspan="2">
                                                                        {{ $data['step3']['visa_refused_details'] }}
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </table>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Have any of your family members been refused a visa for any country?</th>
                                                                <td width="10%">{{ $data['step3']['visa_refused_family'] }}</td>
                                                            </tr>
                                                            @if($data['step3']['visa_refused_family'] == 'yes')
                                                                @if(!empty($data['step3']['visa_refused_family_details']) )
                                                                <tr>
                                                                    <td colspan="2">
                                                                        {{ $data['step3']['visa_refused_family_details'] }}
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                            @endif
                                                        </table>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Are you currently studying or have you previously studied in any country?</th>
                                                                <td width="10%">{{ $data['step3']['overseas_studied'] }}</td>
                                                            </tr>
                                                            @if($data['step3']['overseas_studied'] == 'yes')
                                                                <tr>
                                                                    <td colspan="2">
                                                                        {{ $data['step3']['overseas_studied_details'] }}
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </table>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Are you currently awaiting a decision on another country visa application?</th>
                                                                <td width="10%">{{ $data['step3']['visa_previous_status'] }}</td>
                                                            </tr>
                                                            @if($data['step3']['visa_previous_status'] == 'yes')
                                                                <tr>
                                                                    <td colspan="2">
                                                                        {{ $data['step3']['visa_previous_status_details'] }}
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </table>
                                                    </div>
                                                </div>
                                            @else
                                                <h1>Step Not Completed</h1>
                                            @endif
                                        </div>
                                        <div class="tab-pane" id="step4">

                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')

    <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script>



         $('.datepicker').datepicker();

    </script>


@endsection
