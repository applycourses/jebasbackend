@extends('contents.layouts.app')
@section('title','Enquiry List')

@section('css')   
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
@endsection


@section('body')
  <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-head">
                    <div class="page-title">
                        <h1>Enquiry <small>New</small></h1>
                    </div>
                </div>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <a href="{{ URL('/') }}">Home</a>  <i class="fa fa-circle"></i>
                    </li>
                    <li> <a href="#">Enquiry</a>  <i class="fa fa-circle"></i>
                    </li>
                    <li> <span class="active">Enquiry New</span>
                    </li>
                </ul>
               <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"> <i class="fa fa-question-circle-o"></i> New Enquiry</div>
                            </div>
                            <div id="newEnquiryForm" class="portlet-body">
                                     {{ Form::open(array('route' => 'enquiry.store','id' => 'newEnquiryForm1')) }}
                                    <div class="form-body row">
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-user"></i> </span> 
                                                    {{ Form::text('name', null, array('class' => 'form-control','required' => true,'placeholder' => 'ex. John Paul' )) }}                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-envelope"></i> </span> 
                     {{ Form::email('email', null, ['class' => 'form-control','required' => true,'placeholder' => 'ex. john@hotmail.com']) }}
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <label>Mobile No.</label>
                                                <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-phone"></i> </span> 
                                                    {{ Form::text('phone', null, array('class' => 'form-control','required' => true,'placeholder' => 'ex. 1234567890' )) }}
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <label>Skype ID</label>
                                                <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-skype"></i> </span> 
                                        {{ Form::text('skype', null, array('class' => 'form-control','required' => true,'placeholder' => 'skype id' )) }}
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div id="accounts" class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                                            <div class="row">    
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <label>Additional Account </label>
                                                        <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-phone"></i> </span> 
                                                            <select class="form-control" name="social_account_name[]">
                                                                <option value="">Social Acc.</option>
                                                                <option>Instagram</option>
                                                                <option>Twitter</option>              
                                                                <option>LINE</option>
                                                                <option>WeChat</option>
                                                                <option>Kik</option>
                                                                <option>Pinterest</option>
                                                            </select>
                                                        </div>
                                                    </div>   
                                                </div>
                                                <div class="col-xs-8">
                                                    <div class="form-group">
                                                        <label>Account ID</label>   
                                                        <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-user"></i> </span> 
                                                            <input type="text" placeholder="Account Id" class="form-control" name="social_account_id[]">
                                                        </div>                           

                                                    </div>
                                                </div>
                                                <div class="col-xs-1">
                                                <div class="form-group">
                                                        <button type="button" class="btn btn-primary pull-right addAccount"> <i class="fa fa-plus"></i> </button>
                                                    </div>  
                                                </div>
                                            </div>                                                                         
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <label>Country Living</label>
                                                <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-globe"></i> </span> 
                                                {{ Form::text('current_country', null, array('class' => 'form-control countries','required' => true,'placeholder' => 'ex. Australia' )) }}
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <label>Willing Country</label>
                                                <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-globe"></i> </span> 
                                                    {{ Form::text('willing_country', null, array('class' => 'form-control countries','required' => true,'placeholder' => 'ex. Australia' )) }}
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <label>Citizenship</label>
                                                <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-globe"></i> </span> 
                                                      {{ Form::text('citizenship', null, array('class' => 'form-control countries','required' => true,'placeholder' => 'ex. Australia' )) }}
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <label>Study Level</label>
                                                <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-graduation-cap"></i> </span>
                                                    <select required name="study_level_id" class="form-control select5" required="">
                                                        <option value="">Select Status</option>
                                                        <option value="Secondary">Secondary</option>
                                                        <option value="Higher Secondary">Higher Secondary</option>
                                                        <option value="Diploma">Diploma</option>
                                                        <option value="Graduate">Graduate</option>
                                                        <option value="Masters">Masters</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Have Query ?</label>
                                                <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-comments-o"></i> </span>
                                                    <textarea required name="query" class="form-control" placeholder="If you have any queries or suggestions please enter here..."></textarea>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue">Submit</button>
                                            </div>
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

    <script src="{{ URL::asset('assets/pages/scripts/enquiry.js') }}" type="text/javascript"></script>
    <script>
         
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

        $(".countries").easyAutocomplete(options);



        $('#newEnquiryForm1').validate({
            errorPlacement: function(error, element) {
            var n = element.attr("name");
            },
            highlight: function(element) {
            $(element).addClass('input-error');
            },
            unhighlight: function(element) {
            $(element).removeClass('input-error');
            },

        }); 

        </script>


@endsection