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
                            <li> <a href="/">Home</a> <i class="fa fa-circle"></i>
                            </li>
                            <li> <span class="active">Settings</span>
                            </li>
                        </ul>
                        <div class="tabbable-line boxless tabbable-reversed margin-bottom-5">
                            <ul class="nav nav-tabs">
                                <li>
                                    <a href="{{ route('settings.index' )}}"> Department </a>
                                </li>
                                <li class="active">
                                    <a href="#tab_1" data-toggle="tab">Users </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet box blue">
                                            <div class="portlet-title">
                                                <div class="caption"> <i class="fa fa-bars"></i>User</div>
                                                <div class="tools">
                                                    <a class="addNew settings-btn" data-toggle="modal" data-target="#new" title="New User"></a>
                                                    <a href="javascript:history.back()" class="go_back"></a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th>Sl. No.</th>
                                                            <th>Name of the User</th>
                                                            <th>Email ID</th>
                                                            <th>Department</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        @foreach($data as $key => $value)
                                                        <tr>
                                                            <td> {{ ++$key }}</td>
                                                            <td> {{ $value->name }}</td>
                                                            <td> {{ $value->email }}</td>
                                                            <td>{{ $value->department->name }}</td>
                                                            <td>
                                                                <a  href ="{{ route('users.show',$value->id) }}" class="btn btn-primary btn-xs settings-btn " > View </a>
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
                     <div id="new" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">                            
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Create New User</h4>
                            </div>
                            <form action="{{ route('users.store') }}" id="new_customer" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" placeholder="Email Id">
                                    </div>
                                    <div class="form-group">
                                        {{ Form::select('department_id', ['' => 'Select Department'] + $dep, null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="contact" placeholder="Contact No.">
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="avatar">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                    </div>
                    </div>
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
    <script type="text/javascript">
        $('#new_customer').submit(function(e){
            //e.preventDefault();
            var dataString = $(this).serialize();
            console.log(dataString);
        })
    </script>



@endsection