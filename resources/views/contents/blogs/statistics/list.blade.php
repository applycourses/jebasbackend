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
                    <h1>Add Statistics</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="/">Home</a><i class="fa fa-circle"></i>
                </li>
                <li> <a href="#">Blogs</a><i class="fa fa-circle"></i>
                </li>
                <li> <span class="active">Add Statistics</span>
                </li>
            </ul>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"> <i class="fa fa-bars"></i>Statistics Listing</div>
                                <div class="tools">
                                    <a href="Javascript:Void(0)" class="filter"></a>
                                    <a href="{{ route('statistics.create') }}" class="addNew"></a>
                                    <a href="javascript:history.back()" class="go_back"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="toggleFilter">
                                    <form action="#" class="">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control name" name="name" placeholder="Search for Country" />
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <button class="btn blue btn-block" type="button"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div name="resultsPerPage" class="resultsPerPage margin-bottom-15">
                                    <span>Show :</span>
                                    <div class="form-group">

                                    </div>
                                </div>
                                <div class="table-responsive">
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
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="8%">Sl.No.</th>
                                            <th>Country</th>
                                            <th>Category</th>
                                            <th width="7%">Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($stats as $key => $value)
                                                <tr>
                                                    <td>{{ 1 + $key }}</td>
                                                    <td>{{ $value->country }}</td>
                                                    <td>{{ $value->category }}</td>
                                                    <td>
                                                       <a class="pull-right" href="{{ route('statistics.show',$value->country).'?category='.$value->category }}"><i class="fa fa-eye"></i></a>
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
        </div>
    </div>

@endsection


@section('js')
    <script>
        count = 0;
        $(document).on('click', '.add', function(){
            var body = $('#table-body');
            count += 1;
            $(body).append('<tr> <td> <input type="text" placeholder="eg. Chicken" name="name[]" class="form-control"> </td> <td> <input type="text" placeholder="eg. 1500" name="value[]" class="form-control"> </td> <td> <a title="Delete Product" class="btn btn-danger delete"> <i class="fa fa-trash"></i> </a> </td> </tr>');
        })

        $(document).on('click', '.delete', function(){
            var row = $(this).parent().parent();
            $(row).remove();
        })
    </script>
@endsection