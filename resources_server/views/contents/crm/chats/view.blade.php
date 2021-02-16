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
                            <div class="caption"> <i class="fa fa-eye"></i>Chat</div>
                            <div class="tools">

                                <a href="javascript:history.back()" class="go_back"></a>

                            </div>
                        </div>
                        <div class="portlet-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


@section('js') @endsection