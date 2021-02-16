@extends('contents.layouts.app')
@section('title','Course Applied By the User List')

@section('css')
    <link href="/css/vue2-autocomplete.css">
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('body')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>Course View</h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li> <a href="">Home</a>  <i class="fa fa-circle"></i>
            </li>
            <li> <a href="pages/crm/courses/courses.php">Course List</a>  <i class="fa fa-circle"></i>
            </li>
            <li> <span class="active">Course View</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                @include('contents.crm.includes.agent_view_bar')
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"> <i class="fa fa-eye"></i>Course View</div>
                        <div class="tools">
                            <a href="{{ route('agent-course-list.edit',$data->id) }}" class="edit"></a>
                            <a href="javascript:history.back()" class="go_back"></a>

                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="bold">{{ $data->course->name }}</h4>
                                <h5 class="bold bg-blue-text">Course Overview</h5>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>University Name</th>
                                            <td colspan="3"> {{ $data->university->name  }}</td>
                                        </tr>
                                        <tr>
                                            <th> Campus</th>
                                            <td colspan="3"> {{ $data->campus}} </td>
                                        </tr>
                                        <tr>
                                            <th>Eligibility Criteria</th>
                                            <td>
                                                <button class="btn btn-xs btn-primary" data-target="#elibility_criteria" data-toggle="modal"> View </button>
                                            </td>
                                            <th>Document Checklist</th>
                                            <td>
                                                <button class="btn btn-xs btn-primary" data-target="#doc_checklist" data-toggle="modal"> View </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th >Remove from Shortlist ?</th>
                                            <td colspan="3">{{ ($data->deleted_at) ? 'Yes' :'No' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @if(($data->withdrawl_on))
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th width="22%">Withdrawl Reason</th>
                                        <td width="28%">{{ ($data->withdrawl_remarks) }}</td>
                                        <th width="22%">Withdrawl On</th>
                                        <td width="28%">
                                            {{ ($data->withdrawl_on)  }}
                                            <a href="{{ url('/course/withdrawl/'.$data->id)  }}" class="btn btn-xs btn-success pull-right">Accept</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                @endif


                                <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th width="22%">Application Fee Applicable</th>
                                                <td width="28%">{{ ($data->university->application_fee) ? 'Yes' : 'No' }}</td>
                                                <th width="22%">Application Fee Amount</th>
                                                <td width="28%"> {{ ($data->university->application_fee) ? $data->university->application_fee : 'N.A' }}</td>
                                            </tr>

                                            @if($data->university->application_fee)
                                                <tr>
                                                    <th width="22%">Application Payment Status</th>
                                                    <td width="28%">Not Paid</td>
                                                    <th width="22%">Transaction Ref No.</th>
                                                    <td width="28%">S454DKL</td>
                                                </tr>

                                            @endif
                                        </tbody>
                                    </table>
                                     <h5 class="bold bg-blue-text">Status Comments</h5>
                                    <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th width="18%">Status Type</th>
                                                    <th width="8%">Status</th>
                                                    <th width="10%">Updated On</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                <tr>
                                                    <td>Course Shortlisted</td>
                                                    <td> {{ ($data->shortlisted) ? 'Yes' : 'No' }}</td>
                                                    <td>{{ ($data->shortlisted_on) ? $data->shortlisted_on : 'N.A' }}</td>
                                                    <td>{{ ($data->shortlisted_remarks) ? $data->shortlisted_remarks : 'N.A' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Course Confirmation</td>
                                                    <td>{{ ($data->confirmed) ? 'Yes' : 'No' }}</td>
                                                    <td>{{ ($data->confirmed_on) ? $data->confirmed_on : 'N.A' }}</td>
                                                    <td>{{ ($data->confirmed_remarks) ? $data->confirmed_remarks : 'N.A' }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Document Verified</td>
                                                    <td>{{ ($data->document_verified) ? 'Yes' : 'No' }}</td>
                                                    <td>{{ ($data->document_verified_on) ? $data->document_verified_on : 'N.A' }}</td>
                                                    <td>{{ ($data->document_verified_remarks) ? $data->document_verified_remarks  : 'N.A' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Application Form Verified</td>
                                                    <td>{{ ($data->application_form) ? 'Yes' : 'No' }}</td>
                                                    <td>{{ ($data->application_form_on) ? 'Yes' : 'N.A' }}</td>
                                                    <td>{{ ($data->application_form_remarks) ? $data->application_form_remarks  : 'N.A' }}</td>
                                                </tr>
                                                @if(($data->university->application_fee))
                                                <tr>
                                                    <td>Application Fee Paid</td>
                                                    <td>{{ ($data->application_form) ? 'Yes' : 'No' }}</td>
                                                    <td>{{ ($data->application_form_on) ? 'Yes' : 'N.A' }}</td>
                                                    <td>{{ ($data->application_form_remarks) ? $data->application_form_remarks  : 'N.A' }}</td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td>Moved to My Application</td>
                                                     <td>{{ ($data->moved_to_application) ? 'Yes' : 'No' }}</td>
                                                    <td>{{ ($data->moved_to_application_on) ? $data->moved_to_application_on : 'N.A' }}</td>
                                                    <td>{{ ($data->moved_to_application_remarks) ? $data->moved_to_application_remarks  : 'N.A' }}</td>
                                                </tr>
                                            </tbody>
                                    </table>                                   
                                       
                                    <h5 class="bold bg-blue-text">Logs</h5>
                                    <div class="scroller" style="height: 200px ;overflow-y: scroll">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="8%">Sl.No.</th>
                                                    <th width="15%">Type</th>
                                                    <th width="20%">Date & Time</th>
                                                    <th>Processed by</th>
                                                </tr>
                                            </thead>
                                            <tbody>  
                                                @if($logs->count() > 0 )
                                                    @foreach($logs as $key => $value)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td> {{ $value->action }}</td>
                                                            <td>{{ $value->created_at }}</td>
                                                            <td>
                                                            <?php  $user_detail = get_proccessed_by($value->action_by,$value->action_by_type); ?>
                                                               @if(empty($user_detail))


                                                                @else
                                                                    <span
                                                                            class="label bg-yellow-gold bg-font-yellow-gold"
                                                                            data-toggle="tooltip"
                                                                            title="{{ $value->action_by_type.' '.  $user_detail->email}}"
                                                                    >{{ $user_detail->name   }}
                                                                </span>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                        @endforeach   
                                                    @else
                                                    <tr>
                                                        <td colspan="5" align="center" >No Data</td>
                                                    </tr>          
                                                    @endif

                                            </tbody>
                                        </table>
                                    </div>
                                   
                            
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="elibility_criteria" tabindex="-1" role="elibility_criteria" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Eligibilty Criteria</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Exam Name</th>
                                                    <th>Marks</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(json_decode($data['course']->additional_exam) as $key => $value)
                                                <tr>
                                                    <td>{{ get_additional_exam_name_with_id($value->exam_id) }}</td>
                                                    <td>{{ $value->marks}}</td>
                                                    <td>{{ $value->description}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div class="modal fade" id="doc_checklist" tabindex="-1" role="elibility_criteria" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Eligibilty Criteria</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sl. No.</th>
                                                    <th>Name of the document</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( json_decode($data['course']->documents_id) as $key => $value)
                                                <tr>
                                                    <td>{{ ++$key  }}</td>
                                                    <td>{{ get_document_name_with_id($value) }}</td>
                                                    @if(in_array($value, $documents))
                                                        <td><i class="fa fa-check" style="color:green"></i>  </td>
                                                    @else
                                                        <td><i class="fa fa-times" style="color:red"></i>   </td>
                                                    @endif

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- Modal -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
    <script src="{{ URL::asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
   
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