@extends('contents.layouts.app')
@section('title','HomePage')

@section('css')
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    {{--<link href="{{ URL::asset('assets/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ URL::asset('assets/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ URL::asset('assets/global/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css" />--}}
@endsection


@section('body')
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Dashboard
                    <small>dashboard & statistics</small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->

        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue">
                    <div class="visual"> <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number"> <span data-counter="counterup" data-value="{{ $enquiry }}">{{ $enquiry }}</span>
                        </div>
                        <div class="desc">Enquiry</div>
                    </div> <a class="more" href="{{ route('enquiry.index') }}"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red">
                    <div class="visual"> <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number"> <span data-counter="counterup" data-value="{{ $request_info }}">{{ $request_info }}</span></div>
                        <div class="desc">Request Free Info</div>
                    </div> <a class="more" href="{{ route('request-free-info.index') }}"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual"> <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number"> <span data-counter="counterup" data-value="{{ $students }}"> {{ $students }}</span>
                        </div>
                        <div class="desc">Overall Students</div>
                    </div> <a class="more" href="{{ route('student-list.index') }}"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple">
                    <div class="visual"> <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number"> <span data-counter="counterup" data-value="{{ $applications }}">
                                {{ $applications }}
                            </span></div>
                        <div class="desc">Overall Applications</div>
                    </div> <a class="more" href="{{ route('application.index') }}"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <!-- END DASHBOARD STATS 1-->
        <!-- END PAGE BASE CONTENT -->
    </div>
@endsection


@section('js')

    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/daterangepicker.js') }}" type="text/javascript"></script>


@endsection
