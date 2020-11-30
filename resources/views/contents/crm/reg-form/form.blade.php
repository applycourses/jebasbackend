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
                                               @include('contents.crm.reg-form.includes.step1.new');
                                            </div>
                                            <div class="tab-pane" id="step2">
                                              @include('contents.crm.reg-form.includes.step2.new');
                                            </div>
                                            <div class="tab-pane" id="step3">

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