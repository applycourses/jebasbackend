@extends('contents.layouts.app')
@section('title','Download List')

@section('css')   
   
@endsection


@section('body')
 <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-head">
                    <div class="page-title">
                        <h1>University Document List</h1>
                    </div>
                </div>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <a href="/">Home</a>  <i class="fa fa-circle"></i></li>
                    <li> <span class="active">University Document List</span>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"> <i class="fa fa-bars"></i>University Document List</div>
                                <div class="tools">
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
                                                <button class="btn blue btn-block" type="submit"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                         
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="10%">Sl. No.</th>
                                                <th>Univeristy Name</th>
                                                <th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($universites as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}.</td>
                                                <td>{{ $value->name }}</td>
                                                <td>
                                                    <a href="{{ route('downloads.show',$value->id)}}" class="btn btn-xs btn-primary">View</a>
                                                </td>
                                            </tr>
                                           @endforeach 
                                        </tbody>
                                    </table>
                                    <div>
                                        {{ $universites->links() }}
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

    <script src="{{ URL::asset('assets/pages/scripts/enquiry.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
          $(function() {
            $(".filter").click(function() {
                $(".toggleFilter").toggle();
            });
        });
    </script>
   

@endsection