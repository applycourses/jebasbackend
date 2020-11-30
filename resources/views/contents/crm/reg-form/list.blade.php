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
                    <h1>Registration Form  List</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> <a href="{{ URL('/') }}">Home</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <span class="active">Registration Form  List</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                   
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-list"></i>Registration Form  List</div>
                            <div class="tools">
                                <a href="javascript:;" class="filter"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="enquiry">
                                <form action="" method="get" class="margin-bottom-15">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Name / Student Id / Email / Mobile" />
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control datepicker" type="text" placeholder="Date of Birth" name="dob" />
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control countries" type="text" name="country" placeholder="Country" />
                                        </div>
                                        <div class="form-group">

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
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="search" value="search" class="btn blue">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                  <!--   <label>
                                        Show :
                                        <select name="sample_1_length" aria-controls="sample_1" class="form-control input-sm input-xsmall input-inline">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="-1">All</option>
                                        </select>
                                    </label> -->
                                </div>
                                <div class="col-md-6 col-sm-12" id="daterange_container">
                                    <!-- <div class="pull-right">
                                        <input type="text" class="form-control daterange input-sm input-small input-inline" placeholder="Search by date">
                                    </div> -->
                                </div>
                            </div>
                            <div class="table-responsive">
                               @if (session('message'))
                               <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                              @endif
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="5%">Student ID</th>
                                            <th width="15%">Full Name</th>
                                            <th width="15%">Email Address</th>
                                            <th width="10%">Country</th>
                                            <th width="10%">Date Of Birth</th>
                                            <th width="10%">Mobile</th>
                                            <th width="15%">Current Stage</th>
                                            <th width="10%">Step</th>
                                            <th width="5%">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $value)
                                        <tr>
                                            <td><a href="{{ URL('/student?view=account_details&student_id=').$value->id }}">{{ $value->stu_id }}</a></td>
                                            <td>{{ $value->name }}
                                            </td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->country->name }}</td>
                                            <td>{{ $value->dob->format('d-m-Y') }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td> {{ getStageNameBased($value->stage) }}</td>
                                            <td> Step - {{ $value->reg_status }}</td>
                                            <td> <a href="{{  url('student?view=registration_form&student_id=').$value->id }}"><i class="fa fa-eye view"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    {{ $data->links() }}
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
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script>
        $(function(){$(".filter").click(function(){$(".enquiry").toggle();});});
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

        $(".countries").easyAutocomplete(options);
         $('.datepicker').datepicker();

    </script>
@endsection