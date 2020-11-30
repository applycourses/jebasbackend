@extends('contents.layouts.app')
@section('title','Registration Form List')

@section('css')
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Registration Form View</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> <a href="">Home</a> <i class="fa fa-circle"></i>
                </li>
                <li> <a href="pages/crm/registration_form/registration.php">Registration Form List</a> <i class="fa fa-circle"></i>
                </li>
                <li> <span class="active">Registration Form View</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    @include('contents.crm.includes.view_bar')
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-eye"></i>Registration Form View</div>
                            <div class="tools">

                                <a href="{{ URL::previous() }}" class="go_back"></a>
                            </div>
                        </div>
                        <div class="portlet-body" id="app">
                            <div class="clearfix ">
                                <div class="col-md-12">
                                    <div class="tabbable-bordered margin-bottom-15">
                                        @include('contents.crm.reg-form.includes.navbar')
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="step1">
                                                <span id="message"></span>
                                                <div class="form-body row">
                                                    @if (count($errors) > 0)
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    @if($data)
                                                            {{ Form::model($data, array('url' => '/registration-form/step1/edit','id'=>'step1Form','method' =>'PUT')) }}
                                                    @else
                                                            <form name="step_1" action="{{ URL('/registration-form/step1')}}" method="post" id="step1Form">{{ csrf_field() }}
                                                    @endif

                                                        {{ Form::hidden('student_id',$student_id) }}
                                                        <div class="col-md-12">
                                                            <h4 class="bold">Mailing Address And Personal Information</h4>
                                                            <h5 class="bold bg-blue-text">Personal Information</h5>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <tr>
                                                                    <th>Country Of Birth</th>
                                                                    <th>Marital Status</th>
                                                                    <th>Dependants you want to take ?</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        {{ Form::select('country_of_birth', ['' => 'Select Country'] + $countries, null, ['class' => 'form-control','required' => true]) }}

                                                                    </td>
                                                                    <td>
                                                                        {{ Form::select('marital_status', [ '' => 'Select Status',
                                                                                                       'married' => 'Married',
                                                                                                       'widowed' => 'Widowed',
                                                                                                       'divorced' => 'Divorced',
                                                                                                       'single' => 'Single'
                                                                                                       ], null, ['class' => 'form-control', 'required' => 'true']) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ Form::selectRange('noOfDependants', 0, 15,null,['id' =>'noOfDependants','class' => 'form-control','required' => 'true']) }}
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <div id="specifyRelationDiv">

                                                                @if($data['noOfDependants'] != '0')

                                                                    <table class="table relation_table">
                                                                        <thead>
                                                                        <th>Sl No.</th>
                                                                        <th>Full Name</th>
                                                                        <th>Relationship with the Dependant</th>
                                                                        <th>Take With You?</th>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php 
                                                                            if(!empty($data['dependent'])){
                                                                        ?>
                                                                       @foreach(json_decode($data['dependent']) as $key => $value)
                                                                            <tr>
                                                                                <td> {{ ++$key }}</td>
                                                                                <td>
                                                                                    <input type="text" class="form-control" placeholder="ex. John Paul" name="depedents_name[]" required="" value="{{ $value->name }}">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control" name="depedents_relation[]" placeholder="ex. Father ...." required=""  value="{{ $value->relation }}">
                                                                                </td>
                                                                                <td>

                                                                                        <label><input type="checkbox" name="depedents_take[]" value="true" {{ ($value->take == 'true') ? 'checked' : '' }} > </label>

                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>

                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <h5 class="bold bg-blue-text">Mailing Address</h5>
                                                            <div class="mailing_div">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Country</th>
                                                                        <th>City</th>
                                                                        <th>State</th>
                                                                        <th>Postal Code</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            {{ Form::select('mailing_country', ['' => 'Select Country'] + $countries, null, ['class' => 'form-control country','id' => 'mailing_country','required' => true]) }}

                                                                        </td>
                                                                        <td>
                                                                            {{ Form::text('mailing_city', null, array('class' => 'form-control','placeholder' => 'Enter your city','required' => true,'id' =>'mailing_city')) }}
                                                                        </td>
                                                                        <td>
                                                                            {{ Form::select('mailing_state', ['' => 'Select State']+getState($data['mailing_country']),null, ['class' => 'form-control valid','id' => 'mailing_state','required' => 'true']) }}

                                                                        </td>
                                                                        <td>
                                                                            {{ Form::text('mailing_pincode', null, array('class' => 'form-control','placeholder' => 'Enter pincode number','required' => true,'id' => 'mailing_pincode','required' => 'true')) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Full Address</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {{ Form::text('mailing_address', null, array('class' => 'form-control','placeholder' => 'Enter full address','required' => true,'id'=>'mailing_address','required' => true)) }}
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="address">
                                                                <label>My Permanent Address Is Same As Mailing Address</label>
                                                                {{ Form::select('permanent_status', ['' => 'Select ', 'true' => 'Yes', 'false' => 'No', ], null, ['class' => 'valid','id' => 'permanent_status','required' => 'true']) }}
                                                            </div>

                                                            @if($data['permanent_status'] == 'true')
                                                                <div id="padd" style="display :none">
                                                            @else
                                                                <div id="padd">
                                                            @endif
                                                                            <h5 class="bold bg-blue-text">Permanent Address</h5>
                                                                <table class="table ">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Country</th>
                                                                        <th>City</th>
                                                                        <th>State</th>
                                                                        <th>Postal Code</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            {{ Form::select('permanent_country', ['' => 'Select Country'] + $countries, null, ['class' => 'form-control country','id' => 'permanent_country','required' => true ]) }}
                                                                        </td>
                                                                        <td>
                                                                            {{ Form::text('permanent_city', null, array('class' => 'form-control p_add','placeholder' => 'Enter your permanent city','required' => true,'id' => 'permanent_city')) }}

                                                                        </td>
                                                                        <td>
                                                                            {{ Form::select('permanent_state', ['' => 'Select State']+getState($data['permanent_country']), null, ['class' => 'form-control valid p_add','id' => 'permanent_state','required' => 'true']) }}

                                                                        </td>
                                                                        <td>
                                                                            {{ Form::text('permanent_pincode', null, array('class' => 'form-control p_add','placeholder' => 'Enter pincode number','required' => true,'id' => 'permanent_pincode')) }}

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Full Address</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {{ Form::text('permanent_address', null, array('class' => 'form-control p_add','placeholder' => 'Enter Permanent address','id' => 'permanent_address','required' => true, 'id' => 'permanent_address')) }}

                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="pull-right">

                                                                <button type="submit" class="btn blue">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

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
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script>
        $('.datepicker').datepicker();
        $(document).on('change','#noOfDependants',function(){
            var value = $(this).val();
            $('#specifyRelationDiv').empty();
            if( value  != 0) {
                $('#specifyRelationDiv').append('<table class="table relation_table"> <thead> <th>Sl No.</th> <th>Full Name</th> <th>Relationship with the Dependant</th><th>Take With You?</th> </thead> <tbody></tbody></table>');
                for(var i = 1; i <= value; i++){
                    $('#specifyRelationDiv table tbody').append('<tr> <td>'+i+'</td> <td><input type="text" class="form-control" placeholder="ex. John Paul" name="depedents_name[]" required></td> <td><input type="text" class="form-control" name="depedents_relation[]" placeholder="ex. Father ...." required></td><td><label><input type="checkbox" name="depedents_take[]" value="true"> </label></td> </tr>')
                }
            }
        });
        $('.country').change(function(){
            var id          = $(this).attr('id');
            var country_id = $(this).val();
            if(id == 'mailing_country')
                get_state(country_id,'#mailing_state')
            else
                get_state(country_id,'#permanent_state')
        });
        function get_state(country_id,state_id){
            $.ajax({
                url: '/api/get-state-by-country-id-pluck',
                type: 'GET',
                data : {country: country_id},
                dataType: 'JSON',
                beforeSend:function(){
                    $(state_id).empty();
                    $(state_id).append('<option value="">Loading...</option>');
                },
                success:function(response){
                    var options;
                    $(state_id).empty();
                    $(state_id).append('<option value="">Please Select State</option>');
                    $.each(response,function(i,value){
                        options += '<option value="'+value.id+'">'+value.name+'</option>'
                    });
                    $(state_id).append(options);

                }
            });
        }
        $('#permanent_status').change(function(){
            var value = $(this).val();
            if(value == 'false'){
                $('#padd').show();
                $('.p_add').prop('required',true);
            }else{
                $('#padd').hide();
                $('.p_add').removeAttr('required');
            }
        });
        $('#step1Form').validate({
            errorClass: 'animated shake input-error',
            errorPlacement: function(error,element) {
                return true;
            }
        });
    </script>
@endsection
