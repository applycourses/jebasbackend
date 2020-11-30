@extends('contents.layouts.app')
@section('title','Logs')

@section('css')

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
    								<div class="caption"> <i class="fa fa-bars"></i>Logs List</div>
    								<div class="tools">
                                        <a href="Javascript:Void(0)" class="filter" data-original-title="" title=""></a>
    									<a href="/pages/crm/student_list/edit.html" class="edit" data-original-title="" title=""></a>
    									<a href="javascript:history.back()" class="go_back" data-original-title="" title=""></a>
    								</div>
    							</div>
                    <div class="portlet-body">
                        <div class="toggleFilter">
                            <form action="#" class="">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <input class="form-control" type="text" placeholder="Search by . . . . . ">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input class="form-control date-picker" type="text" placeholder="From Date">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input class="form-control date-picker" type="text" placeholder="To Date">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn blue btn-block" type="button"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="form-group">
                                <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#home">User Activity</a></li>
                                <li><a data-toggle="tab" href="#menu1">Admin Activity</a></li>

                                </ul>

                                <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                    <h3>User Activity</h3>
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
                                              @foreach($user_activity as $key=> $value)
                                                <tr class="warning">
                                                    <td> {{ 1 + $key}}.</td>
                                                    <td>{{ $value->created_at->format('d M Y H:i:s')}}</td>
                                                    <td>{{ $value->activity}}</td>

                                                </tr>
                                              @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                  <h3>Admin Activity</h3>
                                  <div class="table-responsive">
                                      <table class="table table-bordered">
                                          <thead>
                                              <tr>
                                                  <th width="8%">Sl.No.</th>
                                                  <th width="8%">Date</th>
                                                  <th>Activity</th>
                                                  <th>Admin Details</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                            @foreach($admin_activity as $key=> $value)
                                              <tr class="warning">
                                                  <td> {{ 1 + $key}}.</td>
                                                  <td>{{ $value->created_at->format('d M Y H:i:s')}}</td>
                                                  <td>{{ $value->activity }}</td>
                                                  <td>{{ $value->user['name'] }} ({{ $value->user['email'] }})</td>

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
        </div>
@endsection


@section('js') @endsection
