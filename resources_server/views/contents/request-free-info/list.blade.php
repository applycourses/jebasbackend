 @extends('contents.layouts.app')
@section('title','Request Free Info Listing')

@section('css')
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
@endsection


@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Request Free Info</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> <a href="">Home</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <span class="active">Request Free Info</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-bars"></i>Request Free Info</div>
                            <div class="tools">
                                <a href="javascript:;" class="filter"></a>
                                <a href="javascript:history.back()" class="go_back"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form action="/request-free-info" class="toggleFilter"  method="get">
                                <div class="form-body">
                                    <div class="row" id="daterange_container">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control name" name="name" placeholder="Student Id / Student Name " />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="university_id" id="" class="form-control">
                                                    <option value="">Select University</option>
                                                    @foreach($university as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group form-group">
                                                <input type="text" class="form-control daterange"  placeholder="" />
                                                <span class="input-group-btn">
                                                    <button class="btn blue" type="submit" name="search" value="search"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>


                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course</th>
                                        <th>University</th>
                                        <th>Student ID</th>
                                        <th width="13%">Requested Date</th>
                                        <th>Status</th>
                                        <th width="10%">Option</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key=> $value)
                                            @if($value->status == 0)
                                                <tr class="danger">
                                            @else
                                                 <tr class="success">
                                            @endif
                                            <td>{{ ++$key  }}.</td>
                                            <td>{{ $value->course->name }}</td>
                                            <td>{{ $value->university->name }}</td>
                                            <td>{{ $value->user->stu_id }}</td>
                                            <td>{{ $value->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                @if($value->status == 0)
                                                     <span class="btn btn-success btn-xs">Open</span>
                                                @else
                                                    <span class="btn btn-danger btn-xs">Close</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('request-free-info.show',$value->enquiry_no) }}" class="btn blue btn-xs">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <div>
                                        {{ $data->links() }}
                                    </div>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/js/daterangepicker.js') }}"></script>

    <script>
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
        $(function(){$(".filter").click(function(){$(".toggleFilter").toggle();});});
    </script>
@endsection