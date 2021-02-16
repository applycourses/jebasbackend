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
                        <h1>Courses List</h1>
                    </div>
                </div>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <a href="">Home</a>  <i class="fa fa-circle"></i></li>
                    <li> <span class="active">Courses List</span>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"> <i class="fa fa-bars"></i>Courses List</div>
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

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label>
                                            Show :
                                            <select name="sample_1_length" aria-controls="sample_1" class="form-control input-sm input-xsmall input-inline">
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
                                </div>
                                @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Student ID</th>
                                                <th>Full Name</th>
                                                <th>University</th>
                                                <th>Course</th>
                                                <th>Campus</th>
                                                <th>Shortlisted On</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                <th>Remarks</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         @if($course_applieds->count() > 0 )
                                             @foreach($course_applieds as $key => $value)
                                                     @if($value->status == 'shortlisted')
                                                         <tr class="active">
                                                     @elseif($value->status == 'withdrawl request')
                                                         <tr class="success">
                                                     @elseif($value->status == 'confirmed')
                                                         <tr class="warning">
                                                     @elseif($value->status == 'Document Verified')
                                                         <tr class="info">
                                                     @elseif($value->status == 'Application Form Verified')
                                                         <tr class="success">
                                                     @elseif($value->status == 'Moved to Application')
                                                         <tr style="background:rgba(126, 247, 126, 0.52)">
                                                     @elseif($value->status == 'removed')
                                                         <tr class="danger">
                                                     @elseif($value->status = 'withdrawn')
                                                         <tr class="warning">
                                                     @endif

                                                    <td> {{ $value->stu_id }}</td>
                                                    <td> {{ $value->name }} </td>
                                                    <td> {{ ($value->university_id)  ? $value->university->name :'N.A' }}</td>
                                                    <td> {{ ($value->course_id) ? $value->course->name : 'N.A' }}</td>
                                                    <td> {{ ($value->campus) ? $value->campus : "N.A" }}</td>
                                                    <td> {{ $value->shortlisted_on }}</td>
                                                    <td> {{ ucfirst($value->status) }}</td>
                                                    <td>
                                                        <a href="{{ url('/student?view=course_view&student_id='.$value->student_id.'&course_apply_id='.$value->id) }}" data-toggle="tooltip" title="View" class="btn btn-xs btn-primary">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="" value="{{ $value->id }}" data-toggle="modal" data-target="#remarks" title="View" class="btn btn-xs btn-primary remarks">
                                                            <i class="fa fa-eye"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                              @endforeach
                                         @else
                                              <tr>
                                                  <td colspan="9"> No Data</td>
                                              </tr>
                                         @endif


                                        </tbody>
                                    </table>
                                    <div>
                                        {{ $course_applieds->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="remarks" tabindex="-1" role="remarks" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <form action="/api/remarks/course-list" method="POST" id="AddComment">
            {{ csrf_field() }}
            <input type="hidden" name="type_id" id="type_id">
                <div class="modal-header">
                    <button type="submit" class="btn btn-primary btn-xs pull-right">Add Comment</button>
                    <h4 class="modal-title">Remarks For AC Team</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <textarea name="comment" id="" placeholder="Please write your comments here." class="form-control"></textarea>
                        </div>
            
                    <table class="table table-bordered">
                      <div id="message"></div>
                        <thead>                            
                            <th>Remarks</th>
                            <th>Users</th>
                            <th>Date&time</th>
                        </thead>
                        <tbody id="RemarksTable">

                            <tr>                               
                                <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</td>
                                <td>sadsadasd</td>
                                <td>dasd</td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
   
@endsection


@section('js')
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/moment.min.js') }}"></script>   
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/daterangepicker.js') }}"></script>
   
    <script>
        $(function() {
            $(".filter").click(function() {
                $(".enquiry").toggle();
            });
        });
        $('.daterange').daterangepicker();
        $('[data-toggle="popover"]').popover({
            html: true
        }); 
        $('.remarks').click(function(e){
            e.preventDefault();
            var id = $(this).attr('value');           
            $('#type_id').val(id);
            $.ajax({
                url      : '/api/remarks/details/course-list',
                type     : 'GET',
               dataType : 'JSON',
                data:   { id: id },
                beforeSend:function(){
                    $('#RemarksTable').empty();
                },
                success:function(response){                   
                   $.each(response,function(key,value){
                     $('#RemarksTable').append('<tr><td>'+value.comment+'</td><td>'+value.name+'</td><td>'+value.created_at+'</td></tr>');
                   });
                }
            });
        });
        $('#AddComment').submit(function(e){
             e.preventDefault();
             var dataString =  $(this).serialize();
             $.ajax({
                url      : '/api/remarks/course-list',
                type     : 'POST',
                data     : dataString,
                dataType : 'JSON',               
                success:function(response){
                    console.log(response);
                    $('#message').html('<div class="alert alert-success"> <strong>Success!</strong> '+ response.message+'. </div> '); if(response.success){location.reload(); }
                }
             });
        });

        </script>
@endsection