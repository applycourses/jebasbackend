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
                    <h1>Visa List</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> <a href="/">Home</a>  <i class="fa fa-circle"></i></li>
                <li> <span class="active">Visa List</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-bars"></i>Visa List</div>
                            <div class="tools">
                                <a href="javascript:;" class="filter"></a>
                                <a href="javascript:history.back()" class="go_back"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="enquiry">
                                <form action="#" class="margin-bottom-15">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Name / Student Id / Course" />
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control date-picker" type="text" placeholder="Date of Shortlist" />
                                        </div>
                                        <div class="form-group">
                                            <select name="University" class="form-control">
                                                <option value="">University</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option value="">Course Status</option>
                                                <option value="">Verified</option>
                                                <option value="">Not Verified</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn blue">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                           {{-- <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label>
                                        Show :
                                        <select class="form-control input-sm  input-inline">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="-1">All</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-12" id="daterange_container">
                                    <div class="pull-right">
                                        <input type="text" class="form-control daterange input-sm input-small input-inline" placeholder="Search by date">
                                    </div>
                                </div>
                            </div>--}}
                            <div >
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>

                                        <th>Student ID</th>
                                        <th>Full Name</th>
                                        <th>University</th>
                                        <th>Course</th>
                                        <th>Duration</th>
                                        <th>Visa Fees Paid</th>
                                        <th>Processed by</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Option</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $value)
                                    <tr>
                                        <td>{{ $value->student->stu_id }}</td>
                                        <td>{{ $value->student->name }}</td>
                                        <td>{{ $value->course_applied->university->name }}</td>
                                        <td>{{ $value->course_applied->course->name }}</td>
                                        <td>{{ $value->course_applied->course->duration }}</td>
                                        <td> @if(empty($value->visa_fees))
                                                 Not Paid
                                             @else
                                                Paid
                                             @endif
                                        </td>
                                        <td>
                                            @if(empty($value->visa_fees))
                                                Not Processed
                                            @else
                                                Paid
                                            @endif
                                        </td>
                                        <td>{{ $value->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $value->status }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ url('student?view=visa_view&student_id='.$value->student_id.'&visa='.$value->id) }}">View</a></li>
                                                    <li><a href="#" onclick="deleteVisa({{$value->id}})">Delete</a></li>
                                                    <li><a href="#">Remarks</a></li>

                                                </ul>
                                            </div>
                                        </td>

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
    </div>
    <div id="confim-made" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="margin-bottom-20">
                        <div class="confim-made">
                            <div class="confirm-made-icon">
                                <i class="fa fa-exclamation-triangle fa-3x"></i>
                            </div>
                            <div class="confirm-made-title">
                                <h3>
                                    Are you sure ?
                                </h3>
                                <small>This action cannot be done.</small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="button" class="btn btn-success" id="confirmationYes">Yes</button>
                    <button type="button" class="btn btn-default" id="confirmationNo">No</button>
                </div>
            </div>

        </div>
    </div>

@endsection


@section('js')
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/daterangepicker.js') }}"></script>
    <script>
        var VISAID;
        function deleteVisa(visa_id){
            VISAID = visa_id;
            $('#confim-made').modal('show');
        }
        $('#confirmationYes').click(function(){
            var token = $("meta[name=csrf-token]").attr("content");
            $.ajax(
            {
                url: "/visa/"+VISAID,
                type: 'DELETE',
                dataType: "JSON",
                data: {
                    "_token" : token
                },
                success: function (response)
                {
                    console.log(response);
                    if(response.success)
                    window.location.href = '/visa';
                }
            });

        })
        $('#confirmationNo').click(function(){
            $('#confim-made').modal('hide');
            alert(VISAID);
        })


    </script>

@endsection