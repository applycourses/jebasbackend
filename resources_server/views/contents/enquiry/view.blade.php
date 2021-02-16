@extends('contents.layouts.app')
@section('title','Enquiry List')

@section('css')
   <link href="{{ URL::asset('assets/global/plugins/bootstrap-summernote/summernote.css') }}" rel="stylesheet" type="text/css">
@endsection


@section('body')
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>Enquiry <small>View</small></h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li> <a href="{{ URL('/home')}}</a> <i class="fa fa-circle"></i>
            </li>
            <li> <a href="#">Enquiry</a> <i class="fa fa-circle"></i>
            </li>
            <li> <span class="active">Enquiry View</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"> <i class="fa fa-list"></i>Enquiry View</div>
                        
                    </div>
                    <div class="portlet-body">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="update_message"></div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><b>Enquiry No.</b>
                                        </td>
                                        <td>{{ $data->enquiry_no }}</td>
                                        <td><b>Registered</b>
                                        </td>
                                        <td>{{ ($data->student_id) ? $data->student_id : 'No' }} </td>
                                    </tr>
                                    <tr>
                                        <td><b>Full Name</b>
                                        </td>
                                        <td>{{ $data->name}}</td>
                                        <td><b>Citizenship</b>
                                        </td>
                                        <td>{{ $data->citizenship }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Email</b>
                                        </td>
                                        <td>{{ $data->email}}</td>
                                        <td><b>Desired Country</b>
                                        </td>
                                        <td>{{ $data->willing_country }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Mobile</b>
                                        </td>
                                        <td>{{ $data->contact }}</td>
                                        <td><b>Study Level</b>
                                        </td>
                                        <td>{{ $data->study_level_id }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Skype</b> </td> 
                                        <td> {{ $data->skype }}</td>
                                        <td><b>Currently Living</b>
                                        </td>
                                        <td>{{ $data->country_from }}</td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Current Status
                                        </th>
                                        <td width="30%">
                                          
                                            <div class="input-group">
                                                <select name="" id="status" class="form-control">
                                                    <option value="">Status</option>
                                                    <option value="NULL" {{ (!$data->status) ? 'selected' : '' }}>Open </option>
                                                    <option value="1" {{ ($data->status == '1') ? 'selected' : '' }}>Closed </option>
                                                    <option value="0" {{ ($data->status == '0') ? 'selected' : '' }}>Processing</option>
                                                </select>
                                              
                                            </div>
                                        </td>
                                        <th>Other Enquiry</th>
                                        <td>
                                          @if(prev_enquiry($data->email))
                                            <span>Yes</span>
                                            <a href="#" rel="popover" data-placement="top" data-popover-content="#myPopover" data-original-title="Other Enquiries" class="btn btn-link btn-sm">View</a>
                                          @else
                                           <span>No</span>   
                                           @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6 caption"> <i class="icon-bubble font-red-sunglo"></i> <span class="caption-subject font-red-sunglo bold uppercase">Chat Messages</span>
                            </div>
                            <div class="col-md-6 actions">
                                <div class="pull-right"> <a class="btn red btn-sm btn-outline sbold" data-toggle="modal" href="#basic"> FAQS </a>
                                </div>
                            </div>
                        </div>  
                        <hr>   
                     <form class="form-horizontal form-bordered margin-bottom-30" action="{{ URL('enquiry/sendEnquiryReply') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value= "{{ $data->id }}" >
                            <div class="form-body">
                                <div class="form-group last">
                                    <div class="col-md-12">
                                         <textarea name="reply" id="summernote"></textarea>                                          
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn blue send" id="send_mail">
                                            <i class="fa fa-envelope"></i> Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>                                  
                        <table class="table table-bordered chat">
                            <thead>
                                <tr>
                                    <th>Query</th>                                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    <blockquote>
                                           {{$data->query}}
                                            <small><cite title="Author"> {{ $data->name }} {{  $data->created_at->addSeconds(19800) }}
                                           </cite></small>
                                        </blockquote>
                                    </td>
                                </tr>
                                @if(!empty($replies))
                                @foreach($replies as $key => $value)
                                <tr>
                                    <td>
                                    <blockquote class="text-right">
                                              {!! $value->reply !!}
                                            <small><cite title="Author">{{ $value->name }} {{  $value->created_at->addSeconds(19800) }}</cite></small>
                                    </blockquote>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                                                     
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- POPOVER CONTENT -->
        <div id="myPopover" class="hide">
            <ul class="enquiry_list">
                @if(prev_enquiry($data->email))
                    @foreach( prev_enquiry($data->email) as $value)
                      <li><a href="{{ route('enquiry.show',$value['url']) }}" target="_blank">{{ $value['no']}} </a></li>
                    @endforeach
                @endif    

            </ul>
        </div>
        <!-- POPOVER CONTENT END -->

        <!-- MODALS -->
        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title ">Frequently Asked Questions</h4>      
                    </div>
                    <div class="modal-body">

                       
                        <div class="table-responsive">
                            <div class=" margin-bottom-10">
                                 {{ Form::select('category',['' => 'Select Category'] + $categories, null, ['class' => 'form-control category']) }}
                            </div>
                            <div class="faqs_load ajax-loading" >
                               <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                            </div>
                            <div class="faqs_questions"></div>
                    
                         
                        </div>
                    </div>
                    <div class="modal-footer">                    

                        <button type="button" class="btn dark btn-outline" data-dismiss="modal" >Close</button>
                        <div id="aa"></div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- MODALS END -->
@endsection


@section('js')
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>
   
    <script src="{{ URL::asset('assets/pages/scripts/enquiry.js') }}" type="text/javascript"></script>
    <script>
             $('#summernote').summernote({height: 300});
            $(function() {
                $(".filter").click(function() {
                    $(".enquiry").toggle();
                });
            });

            $(function() {
                $('[rel="popover"]').popover({
                    container: 'body',
                    html: true,
                    content: function() {
                        var clone = $($(this).data('popover-content')).clone(true).removeClass('hide');
                        return clone;
                    }
                }).click(function(e) {
                    e.preventDefault();
                });
            });

            // COPY TO CLIPBOARD
            $(document).on('click','.copy',function(){
              var element =  $(this).parent().prev().find('.answer');
              var txt      =  element.text();    
              copyTextToClipboard(txt);              
            });

            function copyTextToClipboard(text) {
              var textArea = document.createElement("textarea");
              textArea.style.position = 'fixed';
              textArea.style.top = 0;
              textArea.style.left = 0;
              textArea.style.width = '2em';
              textArea.style.height = '2em';
              textArea.style.padding = 0;
              textArea.style.border = 'none';
              textArea.style.outline = 'none';
              textArea.style.boxShadow = 'none';
              textArea.style.background = 'transparent';
              textArea.value = text;
              document.getElementById("aa").appendChild(textArea);
            //  document.body.appendChild(textArea);
              textArea.select();

              try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Copying text command was ' + msg);
                console.log(text);
              } catch (err) {
                console.log('Oops, unable to copy');
              }
               document.getElementById("aa").removeChild(textArea);
            //  document.body.removeChild(textArea);
            }



        </script>
        <script>
          
            $('#status').change(function(){
                var status = $(this).val();
                var href  =  window.location.href.split('/');
                var id = href[4];
               

                $.ajax({
                    url: '/api/update_enquiry_status',
                    type : 'get',
                    dataType : 'JSON',
                    data: { id : id , status : status},
                    beforeSend:function(){
                        $('.update_message').empty();
                        $('.update_message').append('<div class="alert alert-warning">Please Wait.. </div>');
                    },
                    success:function(response){
                         $('.update_message').empty();
                        if(response.success)
                          $('.update_message').append('<div class="alert alert-success"> <strong>Success!</strong> Successfully Updated</div>');
                       else
                          $('.update_message').append('<div class="alert alert-danger"> <strong>Error!</strong> Error in  Updating</div>');

                    }

                });
            })
          
        $(".category").change(function(){
            var value = $(this).val();

            $.ajax({
                url: '/api/faqs',
                data: {category : value },
                beforeSend:function(){
                    $('.faqs_load').show();
                    $('.faqs_questions').empty();
                },
                success:function(response){
                      $('.faqs_load').hide();                     
                      $('.faqs_questions').append(response);
                }
            });
        })


          
        </script>


@endsection