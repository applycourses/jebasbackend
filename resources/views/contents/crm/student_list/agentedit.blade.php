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
                        <h1>Account Details Edit</h1>
                    </div>
                </div>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <a href="">Home</a>  <i class="fa fa-circle"></i>
                    </li>
                    <li>  <a href="pages/crm/student_list/student.php">Student List</a> <i class="fa fa-circle"></i>
                    </li>
                    <li>  <a href="pages/crm/student_list/view.php">Account Details View</a>  <i class="fa fa-circle"></i>
                    </li>
                    <li> <span class="active">Account Details Edit</span>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                        @include('contents.crm.includes.agent_view_bar')
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"> <i class="fa fa-list"></i>Account Details Edit</div>
                                <div class="tools">
                                   <a href="{{ URL::previous() }}" class="go_back"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                             {{ Form::model($data, array('route' => array('agent-student-list.update', $data->id),'class' => 'clearfix')) }}
                               <input type="hidden" name="_method" value="PUT">
                                <form class="clearfix">
                                        <div class="col-md-12">
                                            <h4 class="bold">Student Profile</h4>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th>Student Id</th>
                                                            <td>
                                                            <input type="text" name="stu_id" value="{{$data->student_id}}" class="form-control" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Country</th>
                                                            <td>
                                                            <select name="country" id="" class="form-control">
                                                                <option value="">Select Country</option>
                                                                <?php 
                                                                    foreach($countries AS $index=>$country){
                                                                        ?>
                                                                        <option value="<?php echo $index; ?>" <?php if($index==$data->country){ echo 'selected'; }?>>{{ $country }}</option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email</th>
                                                            <td>
                                                              {{ Form::email('email',null, ['class' => 'form-control']) }}

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Date of Birth</th>
                                                            <td>
                                                             {{ Form::text('dob', null, array('class' => 'form-control datepicker')) }}

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Phone</th>
                                                            <td> {{ Form::text('phone', null, array('class' => 'form-control ')) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Subscribed</th>
                                                            <td>
                                                             {{ Form::select('subscribe', ['' => 'Select', '0' => 'Unsubscribed', '1'   => 'Subscribe' ] , null, ['class' => 'form-control']) }}

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
                                                            <th>Member Since</th>
                                                            <td>
                                                            {{ Form::text('created_at', null, array('class' => 'form-control','readonly' => 'readonly')) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Full Name</th>
                                                            <td> {{ Form::text('name', null, array('class' => 'form-control')) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>State</th>
                                                            <td>
                                                            <select id="sec_state" required name="state_id" class="form-control">
                                                                <option value="">Select State</soption>
                                                                <?php 
                                                                if(is_numeric($data->country)){
                                                                    $states = getState($data->country);
                                                                }else{
                                                                    $states = getStateNamesWithCountryName($data->country);
                                                                }
                                                                ?>
                                                                @foreach($states AS $state)
                                                                    <option value="{{ $state }}"
                                                                        @if($data->state == $state) selected @endif>
                                                                        {{ $state }}
                                                                        </option>
                                                                @endforeach
                                                            </select>


                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Citizenship</th>
                                                            <td>
                                                            <select name="citizenship" id="" class="form-control">
                                                                <option value="">Select Country</option>
                                                                <?php 
                                                                    foreach($countries AS $index=>$country){
                                                                        ?>
                                                                        <option value="<?php echo $index; ?>" <?php if($index==$data->citizenship){ echo 'selected'; }?>>{{ $country }}</option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Gender</th>
                                                            <td>
                                                              {{ Form::select('gender', [   '' => 'Select Gender',
                                                                                            'Male' => 'Male',
                                                                                            'Female' => 'Female',
                                                                                            'Prefer Not To Say' => 'Prefer Not To Say'
                                                                                        ] , null, ['class' => 'form-control']) }}

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
                                                            <td>
                                                                  {{ Form::text('skype', null, array('class' => 'form-control')) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Facebook</th>
                                                            <td>
                                                             {{ Form::text('facebook', null, array('class' => 'form-control')) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Twitter</th>
                                                            <td>{{ Form::text('twitter', null, array('class' => 'form-control')) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Instagram</th>
                                                            <td>
                                                            {{ Form::text('instagram', null, array('class' => 'form-control')) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>LinkedIn</th>
                                                            <td>
                                                            {{ Form::text('linkedin', null, array('class' => 'form-control')) }}
                                                            </td>
                                                        </tr>

                                                </tbody></table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                        <tbody><tr>
                                                            <th>Whatsapp</th>
                                                            <td>  {{ Form::text('whatsapp', null, array('class' => 'form-control')) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Viber</th>
                                                            <td>
                                                                {{ Form::text('viber', null, array('class' => 'form-control')) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>WeChat</th>
                                                            <td>
                                                                {{ Form::text('wechat', null, array('class' => 'form-control')) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Line</th>
                                                            <td>
                                                                {{ Form::text('line', null, array('class' => 'form-control')) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Google Hangouts</th>
                                                            <td>
                                                                {{ Form::text('hangout', null, array('class' => 'form-control')) }}
                                                            </td>
                                                        </tr>
                                                </tbody></table>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="pull-right">

                                                <button type="submit" class="btn blue">Update</button>
                                            </div>
                                        </div>
                                </form>
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


@endsection
