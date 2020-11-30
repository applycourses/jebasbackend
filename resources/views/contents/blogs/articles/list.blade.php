@extends('contents.layouts.app')
@section('title','Registration Form List')

@section('css')    
    <link href="{{ URL::asset('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Our Blog List</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> <a href="/">Home</a> <i class="fa fa-circle"></i>
                </li>
                <li> <span class="active">Blog</span>
                </li>
            </ul>
            <div class="tabbable-line boxless tabbable-reversed margin-bottom-5">
                <ul class="nav nav-tabs">
                    <li >
                        <a href="{{ url('blogs') }}"> Country Profile </a>
                    </li>
                    <li class="active">
                        <a href="{{ url('articles') }}" >Articles </a>
                    </li>
                    <li class="">
                        <a href="{{ url('statistics') }}" >Statistics </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box blue" id="app">
                                <div class="portlet-title">
                                    <div class="caption"> <i class="fa fa-bars"></i>Article Profile Listing</div>
                                    <div class="tools">
                                         <a href="{{ route('articles.create') }}" class="addNew"></a>
                                        <a href="javascript:history.back()" class="go_back"></a>
                                    </div>
                                </div>
                                   <article-list>

                                   </article-list>
                                </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>



@endsection