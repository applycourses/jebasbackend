@extends('contents.layouts.app')
@section('title','Registration Form List')

@section('css')    
    <link href="{{ URL::asset('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/easy-autocomplete/css/easy-autocomplete.min.css') }}">
@endsection

@section('body')
<div id="comments" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">CRM Status Comments</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-responsive table-stripped table-bordered">
                        <tbody>
                            <tr>
                                <th>Sl.No.</th>
                                <th>Comments</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>User</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>application form is not there.</td>
                                <td>17-04-2017</td>
                                <td>05:38:21:pm</td>
                                <td>subhashree</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
     <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-head">
                    <div class="page-title">
                        <h1>Add New Country Profile</h1>
                    </div>
                </div>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <a href="">Home</a>  <i class="fa fa-circle"></i>
                    </li>
                    <li> <a href="#">Country Profile</a>  <i class="fa fa-circle"></i>
                    </li>
                    <li> <span class="active">Add New Country Profile</span>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"><i class="fa fa-globe"></i> Add New Country Profile</div>
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
                                {{ Form::open(array('route' => 'blogs.store','files'=>true)) }}
                                <div class="form-body row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Select Country</label>
                                            <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-globe"></i> </span>
                                                {{ Form::select('country',['' => 'Select Country'] + $countries,null, ['class' => 'form-control']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Statistics</label>
                                            <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-pie-chart"></i> </span>
                                                <input type="text" name="statistics" class="form-control" placeholder="Enter Statistics source of the Country">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>About Country</label>
                                            <textarea id="about" name="about"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Featured Image</label>
                                            <input type="file" name="featured_image" class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Facebook Embedded Code </label>
                                            <input
                                                    type="text"
                                                    name="fb_page"
                                                    class="form-control"
                                                    required
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Why Study In This Country ?</label>
                                            <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-university"></i> </span>
                                                <input type="url" name="why_study" class="form-control" placeholder="Enter link of the article" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Living in This Country</label>
                                            <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-home"></i> </span>
                                                <input type="url" name="living" class="form-control" placeholder="Enter link of the article" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Study Options</label>
                                            <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-book"></i> </span>
                                                <input type="url" name="study_option" class="form-control" placeholder="Enter link of the article" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Scholarships & Money</label>
                                            <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-dollar"></i> </span>
                                                <input type="url" name="scholarship_money" class="form-control" placeholder="Enter link of the article" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>International Students</label>
                                            <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                                                <input type="url" name="international_students" class="form-control" placeholder="Enter link of the article" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Education Systems</label>
                                            <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-graduation-cap"></i> </span>
                                                <input type="url" name="education_system" class="form-control" placeholder="Enter link of the article" required="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <table class="table table-bordered" >
                                            <thead>
                                            <tr>
                                                <th colspan="5">Manage Banner</th>
                                                <th>
                                                    <button type="button" class="btn btn-primary btn-xs AddBanner">Add <i class="fa fa-plus"></i></button>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>#</th>
                                                <th>Image Name</th>
                                                <th>Content</th>
                                                <th>Source</th>
                                                <th>File Upload</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="bannerManagerTable" >
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <input type="text" class="form-control"  name="image_name[]"  placeholder="Name of the Image">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="content[]"  placeholder="Content on the Image">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="source[]"  placeholder="Source of the Image">
                                                </td>
                                                <td>
                                                    <input type="file" name="image[]"  class="form-control">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-xs removeBtn"> Remove <i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-actions">
                                            <button type="submit" class="btn blue">Create Profile</button>
                                            <button type="reset" class="btn red">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}

                            </div>
                        </div>
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
            $(document).on('click','.removeBtn',function(){
                var result = confirm("Are you sure you want to delete?");
                var row = $(this).closest('tr');
                if (result) {
                    $(row).remove()
                }
            });
        </script>
        <script src="https://cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('about',{
                customConfig: '/assets/ckeditor/config.js'
            })
        </script>
        <script>
            $('.AddBanner').click(function(){
                var rowCount = $('#bannerManagerTable tr').length;

                $('#bannerManagerTable').append('<tr> <td>'+ ++rowCount +'</td> <td> <input type="text" class="form-control"  name="image_name[]" placeholder="Name of the Image"> </td> <td> <input type="text" class="form-control" name="content[]" placeholder="Content on the Image"> </td> <td> <input type="text" class="form-control" name="source[]" placeholder="Source of the Image"> </td> <td> <input type="file" name="image[]" class="form-control"> </td> <td> <button type="button" class="btn btn-danger btn-xs removeBtn"> Remove <i class="fa fa-trash"></i></button> </td> </tr>');
             });
        </script>
@endsection