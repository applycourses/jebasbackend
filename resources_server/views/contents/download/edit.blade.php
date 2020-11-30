@extends('contents.layouts.app')
@section('title','Download List')

@section('css')

@endsection


@section('body')
 <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-head">
                    <div class="page-title">
                        <h1>Document List of  {{$university_data->name}}</h1>
                    </div>
                </div>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <a href="/">Home</a>  <i class="fa fa-circle"></i></li>
                    <li> <a href="/pages/crm/downloads/downloads.php">University Document List</a>  <i class="fa fa-circle"></i></li>
                    <li> <span class="active">Document List</span>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"> <i class="fa fa-bars"></i>Document List</div>
                                <div class="tools">
                                    <a href="javascript:void()" data-toggle="modal" data-target="#category" class="addNew" data-original-title="Add New Document" title="Add New Document"></a>
                                    <a href="javascript:;" class="filter" data-original-title="Fiter" title="Fiter"></a>
                                    <a href="javascript:history.back()" class="go_back" data-original-title="Go Back" title="Go Back"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                            <div class="toggleFilter">
                                <form action="#" class="">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <input type="text" class="form-control name" name="name" placeholder="Search for University" />
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button class="btn blue btn-block" type="button"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                                <div class="table-responsive">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                    @endif

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="10%">Sl. No.</th>
                                                <th width="15%">Category</th>
                                                <th>Name of the Document</th>
                                                <th>Links</th>
                                                <th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         @if($data->count() > 0 )
                                        @foreach($data as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}.</td>
                                                <td>{{ $value->download_category->name }}</td>
                                                <td>{{ $value->document_name }}</td>
                                                <td>{{ Storage::disk('s3')->url($value->path_name) }}</td>
                                                <td>
                                                    <button data-src="{{ Storage::disk('s3')->url($value->path_name) }}" data-toggle="modal" data-target="#doc_view" type="button" class="btn-xs btn btn-primary view" value="{{ $value->id }}">View</button>
                                                </td>
                                            </tr>
                                         @endforeach
                                         @else

                                         <tr>
                                             <td colspan="5" align="center">
                                                 No Data
                                             </td>
                                         </tr>
                                         @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 <div class="modal fade" id="category" tabindex="-1" role="elibility_criteria" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add New Document</h4>
                </div>
                <form action="{{ route('downloads.store') }}" method="POST" enctype = "multipart/form-data">
                {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="university_name"  value="{{ $university_data->name }}" readonly>
                                    <input type="hidden" name="university_id"  value="{{ $university_data->id }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="document_name" placeholder="Name of the document">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="select-category-div">
                                    <div class="form-group">
                                        <select name="download_category_id" id="select-category" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach( $categories as $value)
                                            <option value="{{ $value->id }}"> {{ $value->name }}</option>
                                            @endforeach

                                            <option value="newcategory">Add New Category</option>
                                        </select>
                                    </div>
                                    <div id="newCategory" class="form-group" style="display: none">
                                        <input type="text" class="form-control" name="newcategory_name" placeholder="New Category">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="file">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <small><b>Note:</b> Only files with following extensions are allowed: <i>pdf, doc</i>. (max file size : 5mb) </small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn blue">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
     <div class="modal fade" id="doc_view" tabindex="-1" role="elibility_criteria" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Document View</h4>
                </div>
                <div class="modal-body">
                    <object data="" type="application/pdf" width="100%" height="450px">
                       <p><b>Note</b>: This browser does not support PDFs. Please download the PDF to view it: <a href="">Download PDF</a>.</p>
                    </object>
                </div>

                <div class="modal-footer">
                 <form action="{{ url('downloads') }}" id="DeleteItems" method="POST">
                   {{ csrf_field() }}
                   <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-xs dark btn-outline" data-dismiss="modal">Close</button>
                    <input type="hidden" name="id" id="id">
                    <button type="submit" class="btn btn-xs red">Delete</button>
                </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection


@section('js')

    <script src="{{ URL::asset('assets/pages/scripts/enquiry.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $(".filter").click(function() {
                $(".toggleFilter").toggle();
            });
            $(document).on('change', '#select-category', function(){
                var value = $(this).val();

                function newcategory(){
                    $('#select-category-div').addClass('form-inline').css('margin-bottom','15px');
                    $('#newCategory').css({'display': 'inline-block', 'width': '58%'}).children().css('width','100%');
                }

                function category(){
                    $('#select-category-div').removeClass('form-inline').css('margin-bottom','0');
                    $('#newCategory').hide();
                }

                (value === 'newcategory')? newcategory() : category() ;
            });

            $('.view').click(function(){
                var src = $(this).attr('data-src');
                var id  = $(this).val();
                $('#id').val(id);
                $('object').attr('data', src);
                $('object p a').attr('href', src);
            })

            $('#DeleteItems').submit(function(e){
                 e.preventDefault();
                var dataString = $(this).serialize();
                var id =$('#id').val();
                // console.log(id);

                $.ajax({
                   type : 'POST',
                   url: "/downloads/"+id ,
                   data : dataString,
                   dataType: 'JSON',
                    success:function(response){
                       if(response.success){
                        location.reload();
                       }
                    }
                });

            });



    });


    </script>


@endsection
