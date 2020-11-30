@extends('contents.layouts.app')
@section('title','Enquiry List')

@section('css')
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Account Details Create</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> <a href="/">Home</a>  <i class="fa fa-circle"></i>
                </li>
                <li>  <a href="/pages/crm/student_list/student.php">Student List</a> <i class="fa fa-circle"></i>
                </li>
                <li>  <a href="/pages/crm/student_list/view.php">Account Details Create</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <span class="active">Account Details Create</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                  @include('contents.crm.includes.view_bar')
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-pencil-square-o"></i>Account Details Create</div>
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
                            {{ Form::open(array('route' => 'student-list.store','class' => 'clearfix')) }}
                            <div class="col-md-12">
                                <h4 class="bold">Student Profile</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th>First Name</th>
                                            <td><input type="text" class="form-control" name="fname"  ></td>
                                        </tr>
                                        <tr>
                                            <th>Last Name</th>
                                            <td><input type="text" class="form-control" name="lname"  ></td>
                                        </tr>

                                        <tr>
                                            <th>Email</th>
                                            <td><input type="email" class="form-control" name="email" ></td>
                                        </tr>
                                        <tr>
                                            <th>Date of Birth</th>
                                            <td>
                                                <input class="form-control " data-provide="datepicker" type="text" name="dob" readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td><input type="tel" class="form-control" name="phone" ></td>
                                        </tr>
                                        <tr>
                                            <th>Subscribed</th>
                                            <td>
                                                <select name="subscribe"  class="form-control">
                                                    <option value="1" selected>Yes</option>
                                                    <option value="0" >No</option>
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th>Country</th>
                                            <td>
                                                {{ Form::select('country_id', ['' => 'Select Country'] + $countries, null, ['class' => 'form-control','id' => 'country_id']) }}
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>State</th>
                                            <td>
                                                <select name="state_id" id="state_id" class="form-control">

                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Citizenship</th>
                                            <td>
                                                {{ Form::select('citizenship', ['' => 'Select Country'] + $countries, null, ['class' => 'form-control']) }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="male" selected>Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </td>
                                        </tr>

                                     
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4 class="bold">Additional Contact Details</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody><tr>
                                            <th>Skype</th>
                                            <td><input type="text" name="skype" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <th>Facebook</th>
                                            <td><input type="text" name="facebook"  class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <th>Twitter</th>
                                            <td><input type="text"  name="twitter" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <th>Instagram</th>
                                            <td><input type="text" name="instagram" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <th>LinkedIn</th>
                                            <td><input type="text" name="linkedin"  class="form-control"></td>
                                        </tr>

                                        </tbody></table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody><tr>
                                            <th>Whatsapp</th>
                                            <td><input type="text" name="whatsapp"  class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <th>Viber</th>
                                            <td><input type="text"  name="viber" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <th>WeChat</th>
                                            <td><input type="text" name="wechat"  class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <th>Line</th>
                                            <td><input type="text" name="line" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <th>Google Hangouts</th>
                                            <td><input type="text" name="hangout"  class="form-control"></td>
                                        </tr>
                                        </tbody></table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <button type="submit" class="btn blue">Create</button>
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

    <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script>
        $(function(){$(".filter").click(function(){$(".toggleFilter").toggle();});});

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
        $('.datepicker').datepicker();

    </script>
    <script>
        $('#country_id').change(function(){
            var country_id = $(this).val();

            $.ajax({
                url:"/api/get_state_by_country_id",
                type:"GET",
                data:{country:country_id},
                dataType:"JSON",
                beforeSend:function(){
                    $('#state_id').empty(),
                    $('#state_id').append('<option value="">Loading...</option>')
                },
                success:function(t){
                    var i;
                    $('#state_id').empty(),
                    $('#state_id').append('<option value="">Please Select State</option>'),
                    $.each(t,function(a,e){
                        console.log(e);
                        i+='<option value="'+a+'">'+e+"</option>"
                    });
                    $('#state_id').append(i);
                }
            })



        });


    </script>


@endsection