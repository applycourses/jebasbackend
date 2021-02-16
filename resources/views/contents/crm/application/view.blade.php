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
                    <h1>Application View</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> 
                    <a href="/">Home</a> <i class="fa fa-circle"></i>
                </li>
                <li> 
                    <a href="/pages/crm/applications/application.php">Application List</a> <i class="fa fa-circle"></i>
                </li>
                <li> 
                    <span class="active">Application View</span>
                </li>
            </ul>
            <div class="row" id="app">
                <div class="col-md-12">
                     @include('contents.crm.includes.view_bar')
                    <application-view></application-view>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
<script src="/js/app.js"></script>

@endsection