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
                    @include('contents.crm.includes.agent_view_bar')
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
                                        @include('contents.crm.reg-form.includes.agentnavbar')
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
                                                            {{ Form::model($data, array('url' => '/agent-registration-form/step1/edit','id'=>'step1Form','method' =>'PUT')) }}
                                                    @else
                                                            <form name="step_1" action="{{ URL('/agent-registration-form/step1')}}" method="post" id="step1Form">{{ csrf_field() }}
                                                    @endif

                                                        {{ Form::hidden('id',$student_id) }}
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
                                                                       @foreach(($data['dependent']) as $key => $value)
                                                                            <tr>
                                                                                <td> {{ ++$key }}</td>
                                                                                <td>
                                                                                    <input type="text" class="form-control" placeholder="ex. John Paul" name="depedents_name[]" required="" value="{{ $value['name'] }}">
                                                                                </td>
                                                                                <td>

<select name="depedents_relation[]" class="form-control" required>
                                    <option value="">Choose Relationship:</option>
                                    <option <?php if($value['relation'] == 'Mother'){ echo 'selected'; }?>>Mother</option>
                                    <option <?php if($value['relation'] == 'Father'){ echo 'selected'; }?>>Father</option>
                                    <option <?php if($value['relation'] == 'Spouse'){ echo 'selected'; }?>>Spouse</option>
                                    <option <?php if($value['relation'] == 'Daughter'){ echo 'selected'; }?>>Daughter</option>
                                    <option <?php if($value['relation'] == 'Son'){ echo 'selected'; }?>>Son</option>
                                    <option <?php if($value['relation'] == 'Sister'){ echo 'selected'; }?>>Sister</option>
                                    <option <?php if($value['relation'] == 'Brother'){ echo 'selected'; }?>>Brother</option>
                                    <option <?php if($value['relation'] == 'Auntie'){ echo 'selected'; }?>>Auntie</option>
                                    <option <?php if($value['relation'] == 'Uncle'){ echo 'selected'; }?>>Uncle</option>
                                    <option <?php if($value['relation'] == 'Niece'){ echo 'selected'; }?>>Niece</option>
                                    <option <?php if($value['relation'] == 'Nephew'){ echo 'selected'; }?>>Nephew</option>
                                    <option <?php if($value['relation'] == 'Cousin (female)'){ echo 'selected'; }?>>Cousin (female)</option>
                                    <option <?php if($value['relation'] == 'Cousin (male)'){ echo 'selected'; }?>>Cousin (male)</option>
                                    <option <?php if($value['relation'] == 'Grandmother'){ echo 'selected'; }?>>Grandmother</option>
                                    <option <?php if($value['relation'] == 'Grandfather'){ echo 'selected'; }?>>Grandfather</option>
                                    <option <?php if($value['relation'] == 'Granddaughter'){ echo 'selected'; }?>>Granddaughter</option>
                                    <option <?php if($value['relation'] == 'Grandson'){ echo 'selected'; }?>>Grandson</option>
                                    <option <?php if($value['relation'] == 'Stepsister'){ echo 'selected'; }?>>Stepsister</option>
                                    <option <?php if($value['relation'] == 'Stepbrother'){ echo 'selected'; }?>>Stepbrother</option>
                                    <option <?php if($value['relation'] == 'Stepmother'){ echo 'selected'; }?>>Stepmother</option>
                                    <option <?php if($value['relation'] == 'Stepfather'){ echo 'selected'; }?>>Stepfather</option>
                                    <option <?php if($value['relation'] == 'Stepdaughter'){ echo 'selected'; }?>>Stepdaughter</option>
                                    <option <?php if($value['relation'] == 'Stepson'){ echo 'selected'; }?>>Stepson</option>
                                    <option <?php if($value['relation'] == 'Sibling (gender neutral)'){ echo 'selected'; }?>>Sibling (gender neutral)</option>
                                    <option <?php if($value['relation'] == 'Parent (gender neutral)'){ echo 'selected'; }?>>Parent (gender neutral)</option>
                                    <option <?php if($value['relation'] == 'Child (gender neutral)'){ echo 'selected'; }?>>Child (gender neutral)</option>
                                    <option <?php if($value['relation'] == 'Sibling of Parent (gender neutral)'){ echo 'selected'; }?>>Sibling of Parent (gender neutral)</option>
                                    <option <?php if($value['relation'] == 'Child of Sibling (gender neutral)'){ echo 'selected'; }?>>Child of Sibling (gender neutral)</option>
                                    <option <?php if($value['relation'] == 'Cousin (gender neutral)'){ echo 'selected'; }?>>Cousin (gender neutral)</option>
                                    <option <?php if($value['relation'] == 'Grandparent (gender neutral)'){ echo 'selected'; }?>>Grandparent (gender neutral)</option>
                                    <option <?php if($value['relation'] == 'Grandchild (gender neutral)'){ echo 'selected'; }?>>Grandchild (gender neutral)</option>
                                    <option <?php if($value['relation'] == 'Step-sibling (gender neutral)'){ echo 'selected'; }?>>Step-sibling (gender neutral)</option>
                                    <option <?php if($value['relation'] == 'Step-parent (gender neutral)'){ echo 'selected'; }?>>Step-parent (gender neutral)</option>
                                    <option <?php if($value['relation'] == 'Stepchild (gender neutral)'){ echo 'selected'; }?>>Stepchild (gender neutral)</option>
                                    <option <?php if($value['relation'] == 'Other'){ echo 'selected'; }?>>Other</option>
                                </select>


                                                                                    
                                                                                </td>
                                                                                <td>
<select class="form-control" name="depedents_take[]" required>
                                        <option value="">Select Option</option>
                                        <option <?php if($value['take']=='1'){ echo "selected"; } ?> value="1">Yes</option>
                                        <option <?php if($value['take']=='0'){ echo "selected"; } ?> value="0">No</option>
                                    </select> 
                                                                                       

                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
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
                                                                            {{ Form::text('permanent_addres', null, array('class' => 'form-control p_add','placeholder' => 'Enter Permanent address','id' => 'permanent_address','required' => true, 'id' => 'permanent_address')) }}

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
