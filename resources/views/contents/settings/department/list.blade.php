@extends('contents.layouts.app')
@section('title','Department List')

@section('css')   
    
@endsection


@section('body')
   <div class="page-content">
                        <div class="page-head">
                            <div class="page-title">
                                <h1>Settings</h1>
                            </div>
                        </div>
                        <ul class="page-breadcrumb breadcrumb">
                            <li> <a href="{{ route('home') }}">Home</a> <i class="fa fa-circle"></i>
                            </li>
                            <li> <span class="active">Settings</span>
                            </li>
                        </ul>
                        <div class="tabbable-line boxless tabbable-reversed margin-bottom-5">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="{{ route('settings.index') }}">Department </a>
                                </li>
                                <li>
                                    <a href="{{ route('users.index') }}">Users </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet box blue">
                                            <div class="portlet-title">
                                                <div class="caption"> <i class="fa fa-bars"></i>Department</div>
                                                <div class="tools">
                                                    <a class="addNew settings-btn" data-toggle="modal" data-target="#new-department"  title="New Department"></a>
                                                    <a href="javascript:history.back()" class="go_back"></a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                              @if (session('status'))
                                                <div class="alert alert-success">
                                                    {{ session('status') }}
                                                </div>
                                               @endif
                                               
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th>Sl. No.</th>
                                                            <th>Name of the Panels</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        @foreach($data as $key => $value)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->name }}</td>
                                                            <td>
                                                                <button class="btn btn-primary btn-xs settings-btn view-modal" data-toggle="modal" data-target="#view-department" value="{{ $value->id }}"> View </button>
                                                            </td>
                                                        </tr>
                                                        @endforeach                

                                                    </tbody>
                                                </table>
                                                {{ $data->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div id="new-department" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                         <form action="settings" method="POST" id="create_department">
                          {{ csrf_field() }}
                            <div class="modal-content">                                            
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Create New Department</h4>
                                </div>                             
                               
                                    <div class="modal-body">
                                    <div id="status_reg"></div>
                                     
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Department Name">
                                        </div>
                                          @foreach(allModules() as $key => $value)
                                        <div class="form-group">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" value="{{$value->id }}" name="module_id[]">{{ $value->name}}
                                            </label>
                                        </div>
                                        @endforeach

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                     <div id="view-department" class="modal fade" role="dialog">k,
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">  
                             <form id="updateDepartment" action="settings/2" method="POST">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">View Department</h4>
                                </div>                               
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="modal-body">
                                       <div id="status"></div>                                    
                                      
                                        
                                        <div class="form-group">
                                            <input type="text" class="form-control edit_dep_name" name="name" placeholder="Department Name">
                                            <input type="hidden" name="department_id" class="department_id">
                                        </div>
                                        @foreach(allModules() as $key => $value)
                                            <div class="form-group">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="{{$value->id}}" name="module_id[]" class="edit_module_name" >{{ $value->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                                           

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>                                          
                              
                            </div>
                        </div>
                    </div>
@endsection


@section('js')
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/pages/scripts/enquiry.js') }}" type="text/javascript"></script>
    <script>
        $(function(){$(".filter").click(function(){$(".toggleFilter").toggle();});});
        $('.daterange').daterangepicker();
        var options = {
            url: "/data/json/countries.json",
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
    <script>
        $(document).on('click','.view-modal',function(){
            var value = $(this).val();

            $.ajax({
                url: 'settings/'+value,
                dataType: 'json',
                type: 'GET',
                beforeSend:function(){
                       $('#status').append('<div class="alert alert-warning"> Please wait loading the data .. </div>');
                },
                success:function(response){
                    $('#status').empty();
                    $('.edit_dep_name').val(response.name);
                    $('.department_id').val(response.id);
                   // / console.log(response.module_id);
                    $.each(JSON.parse(response.module_id),function(i,value){                        
                        $('.edit_module_name[value="'+value+'"]').prop('checked', true);
                    });
                    
                }
            });
        });
        $('#updateDepartment').submit(function(e){
            e.preventDefault();
            var dataString = $(this).serialize();
            var department_id = $('.department_id').val();

             $.ajax({
                url      : 'settings/'+department_id,
                dataType : 'json',
                data     : dataString,
                type     : 'POST',
                beforeSend:function(){
                       $('#status').append('<div class="alert alert-warning"> Please wait inserting your data .. </div>');
                },
                success:function(response){
                   if(response.success){
                       location.reload();
                   }
                }
            });
        })

        $('#create_department').submit(function(e){
            e.preventDefault();
            var dataString = $(this).serialize();
            $.ajax({
                url : 'settings',
                type :'POST',
                data: dataString,
                beforeSend:function(){
                     $('#status_reg').append('<div class="alert alert-warning"> Please wait inserting your data .. </div>');
                },
                success:function(response){
                   if(response.success){
                       location.reload();
                   }


                }
            });

        });
    </script>


@endsection