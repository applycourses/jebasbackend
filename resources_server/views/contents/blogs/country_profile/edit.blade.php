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
                    <h1>Update Country Profile</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> <a href="">Home</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <a href="#">Country Profile</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <span class="active">Update Country Profile</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-globe"></i> Update Country Profile</div>
                            <div class="tools">
                                <a onclick="event.preventDefault();
                                                     document.getElementById('delete-country-profile').submit();"
                                   class="trash"></a>
                                <a href="javascript:history.back()" class="go_back"></a>
                            </div>
                        </div>

                        <form id="delete-country-profile" action="{{ route('blogs.destroy',$data->id) }}" method="POST" style="display: none;">
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                        </form>

                        <div class="portlet-body">
                            {{ Form::model($data, ['route' => ['blogs.update', $data->id],'files' => true,'method' => 'PUT']) }}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
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
                                            {{ Form::text('statistics', null, array('class' => 'form-control','placeholder' => 'Enter statistics')) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>About Country</label>
                                        <textarea id="about" name="about">{{ $data->about }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Why Study In This Country ?</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"> <i class="fa fa-university"></i> </span>
                                                {{ Form::input('url', 'study_in_country', null, ['class' => 'form-control','placeholder' => 'Enter link of the article']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Living in This Country</label>
                                            <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-home"></i> </span>
                                                {{ Form::input('url', 'living_in_country', null, ['class' => 'form-control','placeholder' => 'Enter link of the article']) }}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Study Options</label>
                                            <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-book"></i> </span>
                                                {{ Form::input('url', 'study_option', null, ['class' => 'form-control','placeholder' => 'Enter link of the article']) }}
                                         </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Scholarships & Money</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"> <i class="fa fa-dollar"></i> </span>
                                                {{ Form::input('url', 'scholarship_money', null, ['class' => 'form-control','placeholder' => 'Enter link of the article']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>International Students</label>
                                            <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-users"></i> </span>
                                              {{ Form::input('url', 'international_student', null, ['class' => 'form-control','placeholder' => 'Enter link of the article']) }}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Education Systems</label>
                                            <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-graduation-cap"></i> </span>
                                                {{ Form::input('url','education_system', null, ['class' => 'form-control','placeholder' => 'Enter link of the article']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Featured Image</label>
                                    <div class="form-group">
                                        <img src="{{ Storage::disk('s3')->url($data->featuredImage) }}" class="img-responsive">
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="featured_image" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Facebook Embedded Code </label>
                                        {{ Form::text('fb_page', null, array('class' => 'form-control')) }}

                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div id="message"></div>
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
                                        @foreach($banner as $key => $value)
                                            <tr>
                                                <td> {{ ++$key }}.</td>
                                                <td>
                                                    <input type="text" class="form-control"   placeholder="Name of the Image" value="{{ $value->image_name }}" disabled="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"  placeholder="Content on the Image" value="{{ $value->content }}" disabled="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"  placeholder="Source of the Image" value="{{ $value->source }}" disabled="">
                                                </td>
                                                <td>
                                                    <img src="{{ Storage::disk('s3')->url($value->image) }}" width="50px" height="30px">
                                                </td>
                                                <td>
                                                    <button type="button"  value="{{ $value->id }}" class="btn btn-danger btn-xs delete"> Remove <i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                         @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-actions">
                                        <button type="submit" class="btn blue">Update Profile</button>
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




        $(document).on('click','.delete',function(){
            var el = $(this).closest('tr');
            var id = $(this).val();
            var result = confirm("Are you sure you want to delete?");
            if(result){
                $.ajax({
                    url: '/delete/banner/'+id,
                    type: 'GET',
                    dataType: 'JSON',
                    success:function(response){
                       if(response.success){
                           var html = '<div class="alert alert-success\"> <strong>Success!</strong> '+response.message+' </div>';
                           $('#message').append(html);
                           el.remove();
                       }else{
                           var html = '<div class="alert alert-danger"> <strong>Danger!</strong>"+response.message+" </div>';
                           $('#message').append(html);
                       }

                    }
                })
            }

        })
        $(document).on('click','.removeBtn',function(){
                $(this).closest('tr').remove();
        })

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
        $('.trash').click(function(e){
            e.preventDefault();
            var url =  $(this).attr('href');


           $.ajax({
               url : url,
               type : 'DELETE',
               data : { 'method' : 'DELETE'},
               dataType : 'JSON',
               success:function(response){
                   if(response.success){

                       window.location.href = "/blogs";
                   }

               }

           })



        })
    </script>
    <script>

    </script>
@endsection