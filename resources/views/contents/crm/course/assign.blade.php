@extends('contents.layouts.app')
@section('title','Course Applied By the User List')

@section('css')    
  
@endsection

@section('body')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>Assign Course</h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li> <a href="/">Home</a>  <i class="fa fa-circle"></i>
            </li>
            <li> <a href="/pages/crm/courses/courses.php">Course List</a>  <i class="fa fa-circle"></i>
            </li>
            <li> <span class="active">Assign Course</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"> <i class="fa fa-pencil-square-o"></i>Create Course</div>
                        <div class="tools">
                            <a href="javascript:;" class="filter"></a>
                            <a href="javascript:history.back()" class="go_back"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                     @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="#" class="toggleFilter">                                  
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select required class="form-control" id="levels" name="level">
                                                <option value="">Select Level</option>
                                                <option value="">Advance Diploma</option>
                                                <option value="">Associate Degree</option>
                                                <option value="">Bachelors Degree</option>
                                                <option value="">Certificate</option>
                                                <option value="">Diploma</option>
                                                <option value="">Foundation</option>
                                                <option value="">Graduate Certificate</option>
                                                <option value="">Graduate Diploma</option>
                                                <option value="">M.Phil</option>
                                                <option value="">Masters Degree</option>
                                                <option value="">Phd</option>
                                                <option value="">Post Graduate Certificate</option>
                                                <option value="">Post Graduate Diploma</option>
                                                <option value="">Pre-Masters </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select required class="form-control" id="subject" name="subjects">
                                                <option value="">Select Subjects</option>
                                                <option>Applied Science, Profession and Arts</option>
                                                <option>Architecture and Environment Science</option>
                                                <option>Business, Management, Finance and Economics</option>
                                                <option>Engineering and Technology</option>
                                                <option>English As Second Language (ESL, ELICOS, etc)</option>
                                                <option>Humanities and Arts</option>
                                                <option>Law</option>
                                                <option>Life Science, Medical and Health</option>
                                                <option>Natural Science</option>
                                                <option>Social Science</option>
                                                <option>Pathway/Preparatory</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select required name="countries" id="" class="form-control">
                                                <option value="">Select Country</option>
                                                <option value="India">India</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select required name="university" id="" class="form-control">
                                                <option value="">Select University</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input required type="text" class="form-control" placeholder="Keywords">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </form>
                        <label>
                            Show :
                            <select name="sample_1_length" aria-controls="sample_1" class="form-control input-sm input-xsmall input-inline">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="-1">All</option>
                            </select> 
                        </label>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl.No</th>
                                        <th width="50%">Course Name</th>
                                        <th width="13%">University Name</th>
                                        <th>Country</th>
                                        <th>Duration</th>
                                        <th>Fees</th>
                                        <th>Apply</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  {{--@foreach($courses  as $key => $value)--}}
                                    {{--<tr>--}}
                                        {{--<td>{{ ++$key }}</td>--}}
                                        {{--<td>--}}
                                            {{--{{ $value->name }}--}}
                                        {{--</td>--}}
                                        {{--<td>{{ $value->university->name }}</td>--}}
                                        {{--<td>{{ $value->country->name }}</td>--}}
                                        {{--<td>{{ $value->duration }}</td>--}}
                                        {{--<td>{{ currency_name_with_id($value->university->currency_name_id).' '.$value->fee}}</td>--}}
                                        {{--<td>--}}
                                            {{--<button type="button" data-toggle="modal" data-target="#assign_course" class="btn btn-xs btn-primary apply_now_btn" value="{{ $value->id }}">Apply Now</button>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                  {{--@endforeach  --}}
                                   
                                </tbody>
                            </table>
                            <div>
                                {{ $courses->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
<div class="modal fade" id="assign_course" tabindex="-1" role="assign_course" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Assign Course</h4>
            </div>
            <form action="/course-list/assign-course" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">           
                    <input type="hidden" name="course_id" id="course_id">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Select Student</th>
                                <td>
                                    <input type="text" class="form-control name" placeholder="Type Student name or Id" name="student_id">
                                </td>
                            </tr>
                        </tbody>
                    </table>             
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
             </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection


@section('js')
   
    
    <script> 
        
        $('.filter').click(function(){
            $('.toggleFilter').toggle();
        });
        
        

        $('.apply_now_btn').click(function(){
            var value = $(this).val();
            $('#course_id').val(value);
        })
    </script>
@endsection