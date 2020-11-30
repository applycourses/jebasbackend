@extends('contents.layouts.app')
@section('title','HomePage')

@section('css')
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('body')
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Notification
                    <small>Notification from applycourses.com</small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li> <span class="active">Home</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-share font-blue"></i> <span class="caption-subject font-blue bold uppercase">Recent Activities In Portal</span></div>

                    </div>
                    <div class="portlet-body">
                        <form class="form-inline form-group">
                          <input class="form-control" name="queryString" placeholder="Student Name / Student id / Email /Phone">
                          <input class="form-control daterange" name="date" placeholder="select Date">
                          <button class="btn btn-primary "> <i class="fa fa-search"></i></button>
                        </form>
                        <div >
                           <table class="table table-stripped">
                             <thead>
                               <tr>
                                 <th>Sl.No</th>
                                 <th>Activity</th>
                                 <th>Date & Time (IST)</th>
                                 <th>Action</th>
                               </tr>
                             </thead>
                             <tbody>
                               @if(!empty($notifications))
                                @foreach($notifications as $key => $value)
                                 <tr>
                                   <td>{{ 1+ $key }}</td>
                                   <td><a href="{{ url('student?view=logs&student_id='.$value->user_id ) }}">{{ $value->activity }}</a> </td>
                                   <td>{{ $value->created_at->addMinutes(330)->format('d-m-Y H:i:s') }}</td>
                                   <td>
                                       <a href="" class="btn  btn-sm btn-primary">
                                           <i class="fa fa-check">&nbsp;Read</i>
                                       </a>
                                   </td>
                                 </tr>
                                 @endforeach
                             @else
                              <h4> No Result Found</h4>
                            @endif
                             </tbody>

                           </table>


                        </div>
                         @if(!empty($notifications))
                          <div class="scroller-footer">
                              {{ $notifications->links() }}
                          </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <!-- END DASHBOARD STATS 1-->
        <!-- END PAGE BASE CONTENT -->
    </div>
@endsection


@section('js')
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('.daterange').datepicker();
    </script>



@endsection
