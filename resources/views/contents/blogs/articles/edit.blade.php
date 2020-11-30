@extends('contents.layouts.app')
@section('title','Registration Form List')

@section('css')
    <link href="{{ URL::asset('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
@endsection

@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Edit Article</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> <a href="/">Home</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <a href="#">Country Profile</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <span class="active">Edit Article</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-globe"></i> Edit Article</div>
                            <div class="tools">
                                <a href="javascript:history.back()" class="go_back"></a>
                            </div>
                        </div>
                        <div class="portlet-body" id="app">
                            <article-edit></article-edit>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ URL::asset('assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('composer require artesaos/seotoolsassets/pages/scripts/components-bootstrap-tagsinput.min.js') }}"></script>
    <script>

        // CK Editor
        CKEDITOR.replace('about',{
            customConfig: '/assets/ckeditor/config.js'
        });

    </script>
    <script> $(function(){$(".filter").click(function(){$(".toggleFilter").toggle();});}); </script>
@endsection