@extends('contents.layouts.app')
@section('title','Enquiry List')

@section('css')   
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('body')
   <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-head">
                    <div class="page-title">
                        <h1>Account Details View</h1>
                    </div>
                </div>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <a href="{{ URL('/') }}">Home</a>  <i class="fa fa-circle"></i>
                    </li>
                    <li> <a href="">Student List</a>  <i class="fa fa-circle"></i>
                    </li>
                    <li> <span class="active">Account Details View</span>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                         @include('contents.crm.includes.view_bar')
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"> <i class="fa fa-list"></i>Account Details View</div>
                                <div class="tools">
                                    <a href="{{ URL('/student?view=account_details_edit&student_id=').app('request')->input('student_id') }}" class="edit"></a>
                                    <a href="{{ URL::previous() }}" class="go_back"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="clearfix">
                                        <div class="col-md-12 margin-bottom-20">
                                            @if(session('status'))
                                                <div class="alert alert-info">
                                                        {{ session('status') }}
                                                </div>
                                            @endif
                                            <h4 class="bold">Student Profile
                                                <div class="pull-right">
                                                   {{ Form::model($stage, array('route' => array('stage.update',$stage->id),'class' => 'form-inline')) }}
                                                        {{ Form::hidden('_method','PUT') }}
                                                        <label for="" class="">Current Step</label>
                                                        <div class="input-group ">
                                                            {{ Form::select('stage', [''=> 'Please Select stage']
                                                            + [
                                                                "1"  => "Registration Completed",
                                                                "2"  => "Email Verified",
                                                                "3"  => "Registration Form ( Step 1)",
                                                                "4"  => "Registration Form ( Step 2)",
                                                                "5"  => "Registration Form ( Step 3)",
                                                                "6" => "Course Shortlisted",
                                                                "7" => "Confirmation",
                                                                "8" => "Document Verification",
                                                                "9" => "Application Form Verified",
                                                                "10" => "Ready to Process",
                                                                "11" => "Application Forwarded",
                                                                "12" => "Offer Letter Received",
                                                                "13" => "Offer Letter Accepted",
                                                                "14" => "Visa Letter Received",
                                                                "15" => "Ready to File Visa",
                                                                "16" => "Visa Document Checklist Status",
                                                                "17" => "Other Visa Formalities Status",
                                                                "18" => "Visa Fee Paid",
                                                                "19" => "Visa Under Process",
                                                                "20" => "Visa Decision",
                                                                "21" => "Accommodation",
                                                                "22" => "Flight Ticket",
                                                                "23" => "Forex",
                                                                "24" => "Feedback",
                                                             ]
                                                            , null, ['class' => 'form-control']) }}

                                                            <div class="input-group-btn ">
                                                                <button class="btn btn-primary btn-sm " type="submit">Update</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </h4>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">                                                    
                                                        <tr>
                                                            <th>Student Id</th>
                                                            <td>{{ $data->stu_id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Country</th>
                                                             <td>{{ $data->country->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email</th>
                                                              <td>{{ $data->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Date of Birth</th>
                                                             <td>{{ $data->dob }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Phone</th>
                                                             <td>{{ $data->phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Subscribed</th>
                                                              <td>{{ ($data->subscribe) ? "YES" : "NO" }}</td>
                                                        </tr>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    
                                                        <tr>
                                                            <th>Member Since</th>
                                                             <td>{{ $data->created_at }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Full Name</th>
                                                              <td>{{ $data->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>State</th>
                                                              <td>{{ $data->state->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Citizenship</th>
                                                            <td>{{ $data->citizenship($data->citizenship) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Gender</th>
                                                              <td>{{ $data->gender }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status</th>
                                                            <td> {{ ($data->status == '0') ? 'Not Verified' : 'Verified' }}</td>
                                                        </tr>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4 class="bold">Additional Contact Details</h4>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">                                                    
                                                        <tbody>
                                                        <tr>
                                                            <th>Skype</th>
                                                            <td>{{ $data->skype }}</td>

                                                        </tr>
                                                        <tr>
                                                            <th>Facebook</th>
                                                            <td>{{ $data->facebook }}</td>

                                                        </tr>
                                                        <tr>
                                                            <th>Twitter</th>
                                                            <td>{{ $data->twitter }}</td>

                                                        </tr>
                                                        <tr>
                                                            <th>Instagram</th>
                                                            <td>{{ $data->instagram }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>LinkedIn</th>
                                                            <td>{{ $data->linkedin }}</td>

                                                        </tr>
                                                    
                                                </tbody></table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">                                                    
                                                        <tbody><tr>
                                                            <th>Whatsapp</th>
                                                            <td>{{ $data->whatsapp }}</td>

                                                        </tr>
                                                        <tr>
                                                            <th>Viber</th>
                                                            <td>{{ $data->viber }}</td>

                                                        </tr>
                                                        <tr>
                                                            <th>WeChat</th>
                                                            <td>{{ $data->wechat }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Line</th>
                                                            <td>{{ $data->line }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Google Hangouts</th>
                                                            <td>{{ $data->hangout }}</td>
                                                        </tr>                                                   
                                                </tbody></table>
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
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/pages/scripts/enquiry.js') }}" type="text/javascript"></script>
    <script>
        $(function(){$(".filter").click(function(){$(".toggleFilter").toggle();});});
        $('.daterange').daterangepicker();
        var options = {
            url: "/data/json/countries.json",
            getValue: "name",
            list: { 
                match: {
                    enabled: true
                }
            },
            theme: "square"
        };

        $(".name").easyAutocomplete(options);

    </script>


@endsection