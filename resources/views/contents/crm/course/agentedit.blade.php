@extends('contents.layouts.app')
@section('title','Edit Course Applied')

@section('css')    
  
@endsection

@section('body')
<div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-head">
                    <div class="page-title">
                        <h1>Course Edit</h1>
                    </div>
                </div>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <a href="/">Home</a>  <i class="fa fa-circle"></i>
                    </li>
                    <li> <a href="/pages/crm/courses/courses.php">Course List</a>  <i class="fa fa-circle"></i>
                    </li>
                    <li> <a href="/pages/crm/courses/view.php">Course View</a>  <i class="fa fa-circle"></i>
                    </li>
                    <li> <span class="active">Course Edit</span>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                        @include('contents.crm.includes.view_bar')
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"> <i class="fa fa-pencil-square-o"></i>Course Edit</div>
                                <div class="tools">                                  
                                    <a href="javascript:history.back()" class="go_back"></a>                                    
                                </div>
                            </div>
                            
                            <div class="portlet-body">

                                <div id="info">
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                </div>
                             {{ Form::model($data, ['route' => ['agent-course-list.update', $data->id], 'method' => 'patch']) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="bold">{{ $data->course->name }}</h4>
                                        <h5 class="bold bg-blue-text">Course Overview</h5>
                                        <table class="table table-bordered" id="course_overview">

                                            <tbody>
                                                <tr>
                                                    <th width="16%">University Name</th>
                                                    <td colspan="3">
                                                        <input type="text" value="{{ $data->university->name }}" class="form-control" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="16%"> Campus </th>
                                                    <td colspan="3">
                                                        <select name="campus" id="campus_id" class="form-control">
                                                            {!! generate_campus_option($data->university->name,$data->campus) !!}
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="16%">Remove from Shortlist ?</th>
                                                    <td colspan="3">
                                                        <div class="clearfix pl-5">
                                                            <div class="col-md-12">
                                                                <label class="radio-inline  pl-0">
                                                                    <input <?php if($data->status=='removed'){ ?> checked <?php } ?> type="radio" name="remove_shortlisted" value="yes">Yes
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="remove_shortlisted" value="no" <?php if($data->status!='removed'){ ?> checked <?php } ?>>No
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                        <h5 class="bold bg-blue-text">Quick Resend Mails</h5>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Sl. No.</th>
                                                    <th>Mail Type</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Course Shortlist Mail</td>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-xs" id="shortlistMail" value="{{ $data->id }}">Send</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td>Course Confirmation & Application Form</td>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-xs" id="applicationMail" value="{{ $data->id }}">Send</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td>Documents Verified Mail</td>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-xs" id="documentVerificationMail" value="{{ $data->id }}">Send</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4.</td>
                                                    <td>Application Verfied Mail</td>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-xs" id="applicationVerification" value="{{ $data->id }}">Send</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table class="table table-bordered">
                                            <tbody id="payment_status">
                                            </tbody>
                                        </table>
                                        <h5 class="bold bg-blue-text">Status Comments</h5>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th width="15%">Status Type</th>
                                                    <th width="12%">Status</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                <tr>
                                                    <td>Course Shortlisted</td>
                                                    <td>
                                                        <div class="clearfix pl-5">
                                                            <div class="col-md-12">
                                                                <select name="" id="" class="form-control" disabled>
                                                                    <option value="">No</option>
                                                                    <option value="yes" {{ ($data->shortlisted == 'Yes') ? 'selected' : ''}}>Yes</option>
                                                                   
                                                                </select>
                                                               
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ Form::text('shortlisted_remarks', $data->shortlisted_remarks , array('class' => 'form-control','placeholder' => 'Please enter remarks.')) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Course Confirmation</td>
                                                    <td>
                                                        <div class="clearfix pl-5">
                                                            <div class="col-md-12">
                                                                <select name="" id="" class="form-control" disabled>
                                                                    <option value="" selected>No</option>
                                                                    <option value="Yes" {{ ($data->confirmed == 'Yes') ? 'selected' : ''}}>Yes</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ Form::text('confirmed_remarks', $data->confirmed_remarks , array('class' => 'form-control','placeholder' => 'Please enter remarks.')) }}
                                                    </td>
                                                </tr>
                                                @if($data->confirmed == 'Yes')
                                                <tr>
                                                    <td>Document Verified</td>
                                                    <td>
                                                        <div class="clearfix pl-5">
                                                            <div class="col-md-12">
                                                                <select name="document_verified" id="" class="form-control">
                                                                    <option value="" selected>No</option>
                                                                    <option value="yes" {{ ($data->document_verified == 'yes') ? 'selected' : '' }}>Yes</option>
                                                                  
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ Form::text('document_verified_remarks', $data->document_verified_remarks , array('class' => 'form-control','placeholder' => 'Please enter remarks.')) }}
                                                    </td>
                                                </tr>
                                                @endif
                                                @if($data->document_verified == 'yes')
                                                <tr>
                                                    <td>Application Form Verified</td>
                                                    <td>
                                                        <div class="clearfix pl-5">
                                                            <div class="col-md-12">
                                                                <select name="application_form" id="" class="form-control" >
                                                                    <option value="">No</option>
                                                                    <option value="yes" {{ ($data->application_form == 'yes') ? 'selected' : ''}}>Yes</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ Form::text('application_form_remarks', $data->application_form_remarks , array('class' => 'form-control','placeholder' => 'Please enter remarks.')) }}
                                                    </td>
                                                </tr>
                                                @endif
                                                {{--<tr>--}}
                                                    {{--<td>Application Fee Paid</td>--}}
                                                    {{--<td>--}}
                                                        {{--<div class="clearfix pl-5">--}}
                                                            {{--<div class="col-md-12">--}}
                                                                {{--<select name="application_fee_paid" id="" class="form-control">--}}
                                                                    {{--<option value="" selected>No</option>--}}
                                                                    {{--<option value="yes" {{ ($data->document_verified == 'yes') ? 'selected' : '' }}>Yes</option>--}}

                                                                {{--</select>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--{{ Form::text('document_verified_remarks', $data->document_verified_remarks , array('class' => 'form-control','placeholder' => 'Please enter remarks.')) }}--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                                @if($data->application_form == 'yes')
                                                <tr>
                                                    <td>Moved to My Application</td>
                                                    <td>
                                                        <div class="clearfix pl-5">
                                                            <div class="col-md-12">
                                                                <select name="moved_to_application" id="" class="form-control">
                                                                   <option value="" selected>No</option>
                                                                    <option value="online" {{ ( $data->moved_to_application == 'online') ? 'selected' : '' }}>Yes-Online</option>
                                                                    <option value="offline" {{ ($data->moved_to_application == 'offline') ? 'selected' : '' }}>Yes-Offline</option>
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ Form::text('moved_to_application_remarks', $data->ready_to_proccess_remarks , array('class' => 'form-control','placeholder' => 'Please enter remarks.')) }}
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="pull-right">
                                            <button type="submit" class="btn blue">Update</button>
                                        </div>
                                    </div>
                                </div>
                             {{ Form::close() }}
                            </div>
                           


                        </div>
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
                data     :  dataString,
                dataType : 'JSON',               
                success:function(response){
                    $('#message').html('<div class="alert alert-success"> <strong>Success!</strong> '+ response.message+'. </div> '); if(response.success){location.reload(); }
                }
             });
        });
        $('#shortlistMail,#applicationMail,#documentVerificationMail,#applicationVerification').click(function(){
            var id = $(this).attr('id');
            var val = $(this).val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $response = confirm('Are You Sure you want to send email');
            if($response){
                $.ajax({
                    url: '/api/course/sendmail',
                    type : 'GET',
                    dataType: 'JSON',
                    beforeSend:function(){
                        $('#info').empty();
                        $('body').animate({
                            scrollTop : 0
                        });
                        $('#info').append('<div class="alert alert-warning"> <strong><i class="fa fa-refresh fa-spin"></i> Processing !  </strong> Please relax for a while. </div>');
                    },
                    data: { id : id , val:val, _token: CSRF_TOKEN},
                    success:function(response){
                       if(response.success){
                           $('#info').empty();
                           $('#info').append('<div class="alert alert-info"> <strong><i class="fa fa-refresh fa-spin"></i> Reloading !  </strong> Please relax for a while page will be reloaded. </div>');
                           location.reload();
                       }
                    }
                })
            }

        });
        </script>
@endsection