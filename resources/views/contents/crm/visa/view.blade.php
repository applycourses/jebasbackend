@extends('contents.layouts.app')
@section('title','Course Applied By the User List')

@section('css')
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Visa View</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> <a href="/">Home</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <a href="/pages/crm/visa/visa.php">Visa List</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <span class="active">Visa View</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    @include('contents.crm.includes.view_bar')
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-eye"></i>Visa View</div>
                            <div class="tools">
                                <a href="{{ url('student?view=visa_edit&student_id='.app('request')->input('student_id').'&visa='.app('request')->input('visa')) }}" class="edit"></a>
                                <a href="javascript:history.back()" class="go_back"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <h4 class="bold">Basic Details</h4>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="12%">Student Id.</th>
                                    <th>Course</th>
                                    <th>University </th>
                                    <th>Country</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $visa->student->stu_id }}</td>
                                    <td>{{ $visa->course_applied->course->name }}</td>
                                    <td>{{ $visa->course_applied->university->name }}</td>
                                    <td>{{ $visa->course_applied->university->country }}</td>

                                </tr>
                                </tbody>
                            </table>

                            <h4 class="bold">Visa Applicants</h4>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th width="15%">Relationship</th>
                                    <th width="10%">Date of Birth</th>
                                    <th width="12%">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $total = 0 ?>
                                @if(count($visa->dependents) > 0)

                                @foreach($visa->dependents as  $key => $value)
                                <tr>
                                    <td>{{ $value['name'] }}</td>
                                    <td>{{ $value['relationship'] }}</td>
                                    <td>{{ $value['dob'] }}</td>
                                    <?php $total += $value['price'] ?>
                                    <td class="price">{{ $value['price'] }}</td>
                                </tr>
                                @endforeach
                                @endif
                                <tr>
                                    <td colspan="3" align="right"> <b>Sub Total : </b></td>
                                    <th align="left">{{ $total }}</th>
                                </tr>
                                </tbody>

                            </table>

                            <div class="panel with-nav-tabs">
                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab2" data-toggle="tab">Visa Guidelines</a></li>
                                    <li><a href="#tab3" data-toggle="tab">Document Checklist</a></li>
                                    <li><a href="#tab4" data-toggle="tab">Visa Forms</a></li>
                                    <li><a href="#tab5" data-toggle="tab">Visa Fees</a></li>
                                    <li><a href="#tab6" data-toggle="tab">Medical Test</a></li>
                                    <li><a href="#tab7" data-toggle="tab">Police Clearance</a></li>
                                    <li><a href="#tab8" data-toggle="tab">Sop Guidelines</a></li>
                                </ul>
                                <div class="panel-body">
                                    <div class="tab-content">

                                        <div class="tab-pane fade in active" id="tab2">
                                            <div class="text-justify">
                                                {!! $country_visa->description !!}
                                                <a href="{{ $country_visa->url }}" target="_blank" class="btn btn-xs blue">Click to view link</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab3">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th width="8%">Sl. No.</th>
                                                    <th>Document Name</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($country_visa->documents as $key => $value)
                                                        <tr>
                                                            <td>{{ 1 + $key }}.</td>
                                                            <td>{{ $value['name'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab4">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th width="8%">Sl. No.</th>
                                                    <th>Document Name</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($country_visa->visa_forms as $key => $value)
                                                    <tr>
                                                        <td>{{ 1 + $key }}.</td>
                                                        <td>{{ $value['name'] }}</td>
                                                        <td>
                                                            <a href="{{ $value['path'] }}" class="btn btn-xs blue" download>Download <i class="fa fa-download"></i></a>
                                                        </td>

                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab5">
                                            <div class="text-justify">
                                                <h2>{{ $country_visa->visa_fees_currency }} {{ $country_visa->visa_fees_amount }}</h2>
                                                 {!! $country_visa->visa_fees_details !!}
                                                <a href="{{ $country_visa->visa_fees_urls }}" target="_blank" class="btn btn-xs blue">Click to view link</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab6">
                                            <div class="text-justify">
                                                 {!! $country_visa->medical_test_details !!}
                                                 <a href="{{ $country_visa->medical_test_url }}" target="_blank" class="btn btn-xs blue">Click to view link</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab7">
                                            <div class="text-justify">
                                                {!! $country_visa->police_clearance_details !!}
                                                 <a href="{{ $country_visa->police_clearance_url }}" target="_blank" class="btn btn-xs blue">Click to view link</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab8">
                                            <div class="text-justify">
                                                {!!  $country_visa->sop_details !!}
                                                 <a href="{{ $country_visa->sop_urls }}" target="_blank" class="btn btn-xs blue">Click to view link</a>
                                                <a href="{{ $country_visa->sop_doc }}"  class="btn btn-xs green" download>Download Sample Sop</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="bold">Status
                                @if(!empty($visa->processed_by))
                                <div class="pull-right">
                                    <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#update">Update</button>
                                </div>
                                @endif
                            </h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="20%">Status Type</th>
                                    <th width="12%">Updated On</th>
                                    <th width="5%">Attachment</th>
                                    <th>Remarks</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($status as $key => $value)
                                    <tr>
                                        @if($key >= 1)
                                            @if($status[$key-1]->category== $value->category)
                                            <td></td>
                                            @else
                                                <td>{{ $value->category }}</td>
                                            @endif
                                        @else
                                            <td>{{ $value->category }}</td>
                                        @endif
                                        <td>{{ $value->created_at }}</td>
                                        <td><button data-toggle="modal" data-target="#modal{{ $key }}"  data-src="" class="btn btn-xs btn-primary">View</button></td>
                                        <td>{{ $value->remarks }}</td>
                                    </tr>
                                 @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="update" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update</h4>
                    </div>
                    {{ Form::open(array('url' => '/visa/status','method' => 'post', 'files' => true)) }}
                    <div class="modal-body">
                            {{ Form::hidden('student_id',$student_id ) }}
                            {{ Form::hidden('visa_id',$visa_id ) }}
                            <div class="form-group">
                                <select name="category" id="" class="form-control">
                                    <option value="">Select Category</option>
                                    <option >Visa Document Pending</option>
                                    <option>Visa Document Verified</option>
                                    <option >Other Visa Formalities Pending</option>
                                    <option>Other Visa Formalities Completed</option>
                                    <option>Visa Fees Pending</option>
                                    <option>Visa Fees Paid</option>
                                    <option>Visa Under Process</option>
                                    <option>Visa Decision Rejected</option>
                                    <option>Visa Decision Granted</option>
                                    <option>Refund Under Process</option>
                                    <option>Refund Completed</option>
                                    <option>Withdrawn</option>
                                    <option>Moved to Pre Departure</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control" name="img[]" multiple>
                            </div>
                            <div class="form-group">
                                <textarea type="text" class="form-control" name="remarks" placeholder="Remarks"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
    @foreach($status as $key => $value)
    <div id="modal{{ $key }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update
                        </h4>
                    </div>
                    <div class="modal-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="10%">Sl. No.</th>
                                    <th width="26%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(!empty($value->attachment))
                                @foreach($value->attachment as $key => $value)
                                <tr>
                                    <td>{{ 1 + $key }}.</td>
                                    <td>
                                        <a href="https://dyd92sbig5xg1.cloudfront.net/{{$value}}"  download class="btn btn-xs btn-success" ><i class="fa fa-download"></i></a>

                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach

@endsection


@section('js')
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/daterangepicker.js') }}"></script>


@endsection