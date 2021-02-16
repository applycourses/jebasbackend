@extends('contents.layouts.app')
@section('title','Mails')

@section('css')
    <script src="https://cdn.ckeditor.com/4.9.0/standard/ckeditor.js"></script>
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
                    @include('contents.crm.includes.view_bar')
                    <div class="portlet box blue">
    							<div class="portlet-title">
    								<div class="caption"> <i class="fa fa-bars"></i>Email  List</div>
    								<div class="tools">
                   		<a href="" class="addNew" data-original-title="Add New" title="" data-toggle="modal" data-target="#myModal"></a>
    									<a href="javascript:history.back()" class="go_back" data-original-title="" title=""></a>
    								</div>
    							</div>
                    <div class="portlet-body">
                      @if(Session::has('success'))
                          <div class="alert alert-info">
                            <strong>{{ Session::get('success') }} </strong>
                          </div>
                      @endif()
                      <div class="form-group">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#home">Follow Up </a></li>
                                <li><a data-toggle="tab" href="#menu1">System </a></li>
                                <li><a data-toggle="tab" href="#menu2">Admin </a></li>
                            </ul>
                            <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <h3>Follow up</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="8%">Sl.No.</th>
                                                <th width="8%">Date</th>
                                                <th>Activity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($follow_up_mails as $key => $value)
                                            <tr>
                                                <td width="8%">{{ 1 + $key }}</td>
                                                <td width="8%">{{ $value->created_at->format('d M Y')}}</td>
                                                @if($value->stage_id == 2)
                                                  <td>Step 1 Followup</td>
                                                @elseif($value->stage_id == 3)
                                                  <td> Step 2 Followup</td>
                                                @elseif($value->stage_id == 4)
                                                  <td> Step 3 Followup</td>
                                                @elseif($value->stage_id == 5)
                                                  <td> Shotlist Followup</td>
                                                @elseif($value->stage_id == 5)
                                                <td> Shortlist Followup</td>
                                                @elseif($value->stage_id == 6)
                                                <td> Course Confirmation Followup</td>
                                                @elseif($value->stage_id == 7)
                                                  <td> Document Followup</td>
                                                @elseif($value->stage_id ==8)
                                                <td> Application Followup</td>
                                                @else
                                                <td>Dont Know </td>
                                                @endif
                                            </tr>
                                          @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                              <h3>System</h3>
                              <table class="table table-bordered">
                                <thead>
                                      <tr>
                                          <th width="8%">Sl.No.</th>
                                          <th width="8%">Date</th>
                                          <th>Activity</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($system_mails as $key => $value)
                                      <tr>
                                          <td width="8%">{{ 1 + $key }}</td>
                                          <td width="8%">{{ $value->created_at->format('d M Y')}}</td>
                                          <td>{{ $value->mail_name }}</td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                              <h3>Admin</h3>
                              <table class="table table-bordered">
                                <thead>
                                      <tr>
                                          <th width="8%">Sl.No.</th>
                                          <th width="8%">Date</th>
                                          <th width="10%">Email Id</th>
                                          <th>Subject</th>

                                          <th width="10%">User</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($admin_emails as $key => $value)
                                      <tr>
                                          <td width="8%">{{ 1 + $key }}</td>
                                          <td width="8%">{{ $value->created_at->format('d M Y H:i:s')}}</td>
                                          <td>{!! $value->email !!}</td>
                                          <td> <a href="" data-toggle="modal" data-target="#myModal{{ $key}}">{{ $value->subject }}</a></td>
                                          <div id="myModal{{ $key}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title">Email Body</h4>
                                                </div>
                                                <div class="modal-body">
                                                  {!! $value->body !!}
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-success">Submit</button>
                                                </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>

                                          <td>{{ $value->user['name']}}</td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>



                            </div>


                      </div>

                    </div>
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Send Email</h4>
                          </div>
                          <form action="/send-email" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                          <div class="modal-body">
                             <input type="hidden" name="student_id" value="{{ $student_data->id }}">
                             <input type="hidden" name="no_of_files" id="no_of_files" value="1">

                              <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $student_data->email }}"  >
                              </div>
                              <div class="form-group">
                              <label for="email">Subject:</label>
                              <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter the subject" >
                            </div>
                              <div class="form-group">
                                <label for="pwd">Mail Body:</label>
                                <textarea name="body" rows="8" cols="75" id="body"> <p> Dear  <b>{{ $student_data->fname }}</b></p>
                                  <p>Greetings from the applycourses.com!!</p>
                                  <p>For example my application status is ready to file visa</p>
                                <p> Regards <br>  <b>Applycourses Team</b></p>
                              </textarea>
                              </div>
                              <div class="form-group">
                                  <label for="pwd">Attachment:</label>
                                  <input type="file" class="form-control" name="files1[]"  id="files1" multiple>
                                  <label for="" id="more_files"> Add More Files</label>
                              </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                          </form>
                        </div>

                      </div>
                    </div>
    						</div>
                </div>
            </div>
        </div>

@endsection



@section('js')
    <script>
			CKEDITOR.replace( 'body' );
	</script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click','#more_files', function() {
                var numOfInputs = 1;
                while($('#files'+numOfInputs).length) {
                    numOfInputs++;
                    console.log(numOfInputs);
                    $('#no_of_files').val(numOfInputs);
                }//once this loop breaks, numOfInputs is greater than the # of browse buttons

                $("<input type='file' multiple class='form-control'/>")
                    .attr("id", "files"+numOfInputs)
                    .attr("name", "files"+numOfInputs+"[]")
                    .insertAfter("#files"+(numOfInputs-1));

                $("<br/>").insertBefore("#files"+numOfInputs);
            });
        });
    </script>

@endsection
