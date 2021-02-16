@extends('contents.layouts.app')
@section('title','Registration Form List')

@section('css')    
    <link href="{{ URL::asset('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/easy-autocomplete/css/easy-autocomplete.min.css') }}">
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
            <li> <a href="{{  URL('/') }}">Home</a> <i class="fa fa-circle"></i>
            </li>
            <li> <span class="active">Blog</span>
            </li>
        </ul>
        <div class="tabbable-line boxless tabbable-reversed margin-bottom-5">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="{{ url('blogs') }}" > Country Profile </a>
                </li>
                <li>
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
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"> <i class="fa fa-bars"></i>Country Profile Listing</div>
                                <div class="tools">
                                    <a href="javascript:;" class="filter" data-original-title="" title=""></a>
                                    <a href="{{ route('blogs.create') }}" class="addNew"></a>
                                    <a href="javascript:history.back()" class="go_back"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                @if(session('success'))
                                    <div class="alert alert-success">
                                            {{ session('success') }}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-error">
                                            {{ session('error') }}
                                    </div>
                                @endif
                                <div>
                                    <div class="col-md-12">
                                        <form action="" class="">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="input-group">
                                                        {{ Form::select('name',['' => 'Select the country'] + $countries, null, ['class' => 'form-control name']) }}

                                                        <span class="input-group-btn">
                                                        <button class="btn blue btn-block" type="submit"><i class="fa fa-search"></i></button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <div name="resultsPerPage" class="resultsPerPage margin-bottom-15">
                                    <span>Show :</span>
                                    <div class="form-group">
                                        <select name="resultsShow" class="form-control resultsShow">
                                            <option>20</option>
                                            <option>50</option>
                                            <option>70</option>
                                            <option>100</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="table-responsive">

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="8%">Sl.No.</th>
                                                <th>Name of the Country</th>
                                                <th width="7%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $key => $value)
                                                <tr>
                                                    <td>{{ ++$key }}.</td>
                                                    <td>{{ $value->country }}</td>
                                                    <td>
                                                        <a href="{{ route('blogs.edit',$value->id) }}"><i class="fa fa-pencil-square-o"></i></a>

                                                    </td>
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
            <div class="tab-pane" id="tab_1">
                Articles
            </div>
        </div>
    </div>
</div>
   
@endsection


@section('js')
    <script src="{{ URL::asset('assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/easy-autocomplete/js/jquery.easy-autocomplete.min.js') }}"></script>
    <script> $(function(){$(".filter").click(function(){$(".toggleFilter").toggle();});}); </script>
    <script>
            $(function() {
                $(".filter").click(function() {
                    $(".toggleFilter").toggle();
                });
            });

            var options = {
                url: "/data/countries.json",
                getValue: "name",
                list: { 
                    match: {
                        enabled: true
                    }
                },
                theme: "square"
            };

            $(".name").easyAutocomplete(options);
        </script>
@endsection