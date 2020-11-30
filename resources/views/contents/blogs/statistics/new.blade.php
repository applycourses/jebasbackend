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

        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i> Add Statistics</div>
                <div class="tools">
                    <a href="javascript:history.back()" class="go_back"></a>
                </div>
            </div>
            <div class="portlet-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{ Form::open(array('route' => 'statistics.store')) }}
                    <div class="clearfix">
                        <div class="pull-right form-group">
                            <button type="button" class="btn green btn-xs" data-toggle="modal" data-target="#category">Add Category</button>
                        </div>
                    </div>
                    <div class="form-body row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Select Country</label>
                                <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-globe"></i> </span>
                                    {{ Form::select('country', [''=> 'Please Select country']+$countries, null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Select Currency</label>
                                <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-globe"></i> </span>
                                    {{ Form::select('currency', [''=> 'Please Select currency']+$currencies, null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Select Category</label>
                                <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-globe"></i> </span>
                                    {{ Form::select('category', [''=> 'Please Select category']+$categories, null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Total</label>
                                <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-globe"></i> </span>
                                    {{ Form::text('total', null, array('class' => 'form-control','id' => 'total')) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name of the product</th>
                            <th width="10%">Value</th>
                            <th width="10%">
                                Action
                                <div class="pull-right">
                                    <a href="Javascript:Void(0)" title="Add Product" class="btn btn-primary btn-xs add">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="table-body">

                        </tbody>
                    </table>
                    <div class="form-actions">
                        <button type="submit" class="btn blue">Add Statistics</button>
                        <button type="reset" class="btn red">Reset</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<div id="category" class="modal fade" role="dialog">
<div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Category</h4>
        </div>
        <form action="/statistics/category" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
                <label for="newCategory">Category Name</label>
                <input type="text" id="newCategory" name="name" class="form-control" placeholder="eg. Personal Care">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn blue">create</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
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
            $(body).append('<tr> <td> <input type="text" placeholder="eg. Chicken" name="name[]" class="form-control"> </td> <td> <input type="text" placeholder="eg. 1500" @change="add_value" name="value[]" class="form-control value"> </td> <td> <a title="Delete Product" class="btn btn-danger delete"> <i class="fa fa-trash"></i> </a> </td> </tr>');
        })

        $(document).on('click', '.delete', function(){
            var row = $(this).parent().parent();
            $(row).remove();
        })
        $(document).on('change','.value',function(){
            var sum = 0;
            $(".value").each(function(){
              sum += parseFloat($(this).val())
            });
            $('#total').val(sum);
        });
    </script>
@endsection