@extends('contents.layouts.app')
@section('title','Enquiry List')

@section('css')   
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
@endsection


@section('body')
    <div class="page-content" id="app">
        <div class="page-head">
            <div class="page-title">
                <h1>Enquiry <small>List</small></h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li> <a href="{{ URL('/home') }}">Home</a>  <i class="fa fa-circle"></i>
            </li>
            <li> <a href="#">Enquiry</a>  <i class="fa fa-circle"></i>
            </li>
            <li> <span class="active">Enquiry List</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"> <i class="fa fa-list"></i>List Of Enquiry</div>
                        <div class="tools">                         
                            <a href="javascript:;" class="filter"></a>
                            <a href="{{ route('enquiry.create') }}" class="addNew"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                             <form action="enquiry" class="toggleFilter"  method="get">
                                                      
                                    <div class="form-body">
                                        <div class="row" id="daterange_container">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control name" name="name" placeholder="Enquiry No. / Name / Email / Mobile" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control name" name="citizenship" placeholder="Citizenship" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control name" name="desired_country" placeholder="Desired Country" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control name" name="country_living" placeholder="Country Living" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                {{ Form::select('study_level', [''=> 'Study Level' ] +$levels, null, ['class' => 'form-control']) }}
                                                   
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <select name="status"  class="form-control">
                                                        <option value="">Status</option>
                                                        <option value="NULL">Open</option>
                                                        <option value="0">Processing</option>
                                                        <option value="1">Closed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <select name="type" class="form-control">
                                                        <option value="">Enquiry Type</option>
                                                        <option value="Request Call Back">Call Back</option>
                                                        <option value="Ask Our Expert">Ask Expert</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control daterange" placeholder="Search by date">
                                                    <span class="input-group-btn">
                                                        <button class="btn blue" type="submit" name="search" value="search"><i class="fa fa-search"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    </div>
                                </form>                      
                       
                       
                                <div class="row">
                         <!--    <div class="col-md-6 col-sm-12">
                                <label>
                                    Show :
                                    <select name="sample_1_length" aria-controls="sample_1" class="form-control input-sm input-xsmall input-inline showDataPerPage">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>

                                    </select>
                                </label>
                            </div> -->
                          
                        </div>
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Enq. No.</th>
                                     <th>Date</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>Citizenship</th>
                                    <th>Desired Country</th>
                                    <th>Level</th>
                                    <th>Registerd</th>
                                    <th>Status</th>
                                    <th>Enquiry Type</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody >
                                 @foreach($enquiries as $key => $value)
                                     @if($value->status == NULL)
                                        <tr class="danger" >
                                        @elseif($value->status == 1)
                                         <tr class="success" >
                                        @elseif($value->status == 0)
                                         <tr class="warning" >
                                        @endif

                                        <td><a href="{{  route('enquiry.show',$value->id) }}">{{ $value->enquiry_no }}</a></td>
                                        <td>{{ $value->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->contact }}</td>
                                        <td>{{ $value->citizenship }}</td>
                                        <td>{{ $value->willing_country }}</td>
                                        <td>{{ $value->study_level_id }}</td>
                                        <td>{{ ($value->student_id) ? 'Yes' : 'No' }}</td>
                                        @if($value->status == NULL)
                                            <td class="no-padding"><div class="label label-block label-success label-xs">Open</div></td>

                                        @elseif($value->status == 1)
                                            <td class="no-padding"><div class="label label-block label-danger label-xs">Closed</div></td>
                                         @elseif($value->status == 0)
                                             <td class="no-padding"><div class="label label-block label-warning label-xs">Processing</div></td>
                                        @endif

                                        <td>{{ $value->type }}</td>
                                        <td>
                                          <a href="{{  route('enquiry.show',$value->id) }}"><i class="fa fa-eye view"></i></a>
                                            <a class="pull-right" href="#"><i class="fa fa-trash view"></i></a>
                                        </td>
                                    </tr>
                                  @endforeach 

                                   
                                </tbody>

                            </table>
                            <div>
                                {{ $enquiries->links() }}
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


@endsection