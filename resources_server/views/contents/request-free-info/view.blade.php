@extends('contents.layouts.app')
@section('title','Enquiry List')

@section('css')
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
@endsection


@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Request Free Info</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> <a href="">Home</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <span class="active">Request Free Info</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-bars"></i>Request Free Info</div>
                            <div class="tools">
                                <a href="javascript:history.back()" class="go_back"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="overview">
                                <h3 class="form-header"> <span>Request Free Info View ( {{ $data[0]->enquiry_no }}) </span> </h3>
                                <hr>

                                <div class="clearfix step_heading">
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                                {{ session('success') }}
                                        </div>
                                    @endif
                                    @if(session('danger'))
                                        <div class="alert alert-danger">
                                                {{ session('danger') }}
                                        </div>
                                    @endif
                                    <div class="col-md-12">
                                        <h4 class="form-header">Chat Messages</h4>
                                    </div>
                                </div>
                                <div id="chats" class="clearfix">
                                    <div class="scroller" data-always-visible="1" data-rail-visible1="1">
                                        <ul class="chats">
                                            @foreach($data  as $key =>$value)
                                                @if($value->admin == 0)
                                                <li class="in">
                                                    <div class="message"> <span class="arrow"> </span>  <a href="javascript:;" class="name"> {{ $value->student_name($value->student_id) }} </a>  <span class="datetime"> at {{ $value->created_at->format('d-m-Y')  }} </span>
                                                        <span class="body"> {{ $value->message }} </span>
                                                    </div>
                                                </li>
                                                @else
                                                    <li class="out">
                                                        <div class="message"> <span class="arrow"> </span>  <a href="javascript:;" class="name"> AC Team </a>  <span class="datetime"> {{ $value->created_at->format('d-m-Y') }} </span>
                                                            <span class="body"> {{ $value->message }} </span>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach

                                        </ul>
                                    </div>
                                    <div class="chat-form">
                                        {{ Form::open(array('route' => 'request-free-info.store')) }}
                                        {{ Form::hidden('enquiry_no', $data[0]->enquiry_no) }}
                                        <div class="input-cont">
                                            <input class="form-control" type="text" placeholder="Type your message here..." name="message" />
                                        </div>
                                        <div class="btn-cont"> <span class="arrow"> </span>
                                            <button type="submit" class="btn blue icn-only"> <i class="fa fa-check icon-white"></i>
                                            </button>
                                        </div>
                                        {{ Form::close() }}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection