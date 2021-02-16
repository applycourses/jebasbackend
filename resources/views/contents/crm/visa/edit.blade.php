@extends('contents.layouts.app')
@section('title','Course Applied By the User List')

@section('css')
    <style>
        .confirm-made-icon{  color: #CF597D;  margin-right: 15px;  }  .confirm-made-icon, .confirm-made-title{  display: inline-block;  vertical-align: bottom;  }  .confirm-made-title h3{  margin:0;  }  .block-load{  position: fixed;  z-index: 999999999;  left: 0;  right: 0;  top: 0;  bottom: 0;  background: rgba(0,0,0,0.6);  text-align: center;  cursor: wait;  display: none;  }  .block-load .block-msg{  background: #fff;  max-width: 300px;  margin: auto;  padding: 10px 0;  font-size: 20px;  font-weight: 800;  position: absolute;  left: 0;  right: 0;  top: 50%;  transform: translateY(-100%)  }
    </style>
    <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('body')
    <div class="block-load">
        <div class="block-msg">
            <i class="fa fa-spinner fa-spin"></i> Please Wait
        </div>
    </div>

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Visa Edit</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> <a href="/">Home</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <a href="/pages/crm/visa/visa.php">Visa List</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <a href="/pages/crm/visa/view.php">Visa View</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <span class="active">Visa Edit</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    @include('contents.crm.includes.view_bar')
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-pencil-square-o"></i>Visa Edit</div>
                            <div class="tools">
                                <a href="/pages/crm/visa/edit.php" class="edit"></a>
                                <a href="javascript:history.back()" class="go_back"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="response"></div>
                            {{ Form::open(array('url' => '/visa/processed-by','id' => 'updateProcessByForm')) }}

                                {{ Form::hidden('student_id',$student_id ) }}
                                {{ Form::hidden('visa_id',$visa_id ) }}
                                <div class="row">
                                    <div class="col-md-9">
                                        <h4 class="bold">Processed by</h4>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            {{  Form::select('processed_by', [''=> 'Please Select',
                                            'Agent' => 'Agent',
                                            'Student' => 'Student',
                                            'AC Team' => 'AC Team',
                                            ], $visa->processed_by, ['class' => 'form-control']) }}

                                            <span class="input-group-btn">
								             <button class="btn blue" type="submit" >Update</button>
								            </span>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <hr>
                            {{ Form::open(array('url' => '/visa/dependent','id' => 'VisaApplicantsForm')) }}

                                {{ Form::hidden('student_id',$student_id ) }}
                                {{ Form::hidden('visa_id',$visa_id ) }}
                                <h4 class="bold">Visa Applicants</h4>
                                <table id="applicants" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th width="20%">Relationship</th>
                                        <th width="20%">Date of Birth</th>
                                        <th width="12%">Price</th>
                                        <th width="5%">
                                            <button type="button" onclick="addRow()" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($visa->dependents != '')
                                      @foreach($visa->dependents as $key => $value)

                                        <tr>
                                            <td>
                                                <input type="text" name="name[]" class="form-control" readonly value="{{ $value['name'] }}">
                                            </td>
                                            <td>
                                                <input type="text" name="relationship[]" class="form-control" readonly value="{{ $value['relationship'] }}">
                                            </td>
                                            <td>
                                                <input class="form-control date-picker" type="text" placeholder="Date of Birth" name="dob[]"  value="{{ $value['dob'] }}">
                                            </td>
                                            <td>
                                                <input type="text" name="price[]" class="form-control" value="{{ $value['price'] }}" >
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger del btn-xs"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                      @endforeach
                                    @else
                                    <tr>
                                        <td>
                                            <input type="text" name="name[]" class="form-control" readonly value="{{ $student->name }}">
                                        </td>
                                        <td>
                                            <input type="text" name="relationship[]" class="form-control" readonly value="self">
                                        </td>
                                        <td>
                                            <input class="form-control date-picker" type="text" placeholder="Date of Birth" name="dob[]"  value="{{ $student->dob }}">
                                        </td>
                                        <td>
                                            <input type="text" name="price[]" class="form-control" value="2" >
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger del btn-xs"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3" align="right">Sub Total :</td>
                                        <td colspan="2">$ <span id="total"></span></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="text-right">
                                    <button class="btn blue" type="submit">Update</button>
                                </div>

                            </form>
                            <hr>
                            {{ Form::open(array('url' => '/visa/withdraw','id' => 'withdrawnForm')) }}
                                <h4 class="bold">Withdrawal</h4>
                                {{ Form::hidden('student_id',$student_id ) }}
                                {{ Form::hidden('visa_id',$visa_id ) }}
                                <div class="margin-bottom-15">
                                    <label for="">
                                        Do you want to withdraw the course ?
                                    </label>

                                    <div class="pull-right">
                                        <label class="radio-inline">

                                            {{ Form::radio('status', '1',($visa->withdrawn_status == 1) ? true : false) }} Yes
                                        </label>
                                        <label class="radio-inline">

                                            {{ Form::radio('status', '0',($visa->withdrawn_status == 0)? true: false) }}No
                                        </label>
                                    </div>
                                </div>

                                <div id="withdraw" @if($visa->withdrawn_status == 0)style="display: none;"@endif>
                                    {{ Form::select('type', [''=> 'Please Select Withdraw Type',
                                     'I am Applying from other agency(s)' => 'I am Applying from other agency(s)',
                                     'I decided to apply in other institution(s)' => 'I decided to apply in other institution(s)',
                                     'Unsatisfied with Applycourses services' => 'Unsatisfied with Applycourses services',
                                     'Unable to fund my study' => 'Unable to fund my study',
                                     'Other Reasons' => 'Other Reasons',
                                    ], $visa->withdrawn_type, ['class' => 'form-control form-group']) }}

                                    {{ Form::textarea('reason', $visa->withdrawn_reason, ['class' => 'form-control form-group']) }}
                                </div>
                                <div class="text-right">
                                    <button class="btn blue " type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="confim-made" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="margin-bottom-20">
                        <div class="confim-made">
                            <div class="confirm-made-icon">
                                <i class="fa fa-exclamation-triangle fa-3x"></i>
                            </div>
                            <div class="confirm-made-title">
                                <h3>
                                    Are you sure ?
                                </h3>
                                <small>This action cannot be done.</small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="button" class="btn btn-success" id="confirmationYes">Yes</button>
                    <button type="button" class="btn btn-default" id="confirmationNo">No</button>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('js')
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

    <script>
        $(function(){
            $('#total').text(0);

            var arr = $('[name*="price"]');
            var tot=0;
            for(var i=0;i<arr.length;i++){
                if(parseInt(arr[i].value))
                    tot += parseInt(arr[i].value);
            }
            $('#total').text(tot);
        });


        function addRow(){
            var row = '<tr> <td> <input type="text" name="name[]" class="form-control"> </td> <td> <input type="text" name="relationship[]" class="form-control"> </td> <td> <input class="form-control date-picker" type="text" placeholder="Date of Birth" name="dob[]" /> </td> <td> <input type="text" name="price[]" class="form-control"> </td> <td> <button type="button" class="btn btn-danger del btn-xs"><i class="fa fa-trash"></i></button> </td> </tr>';

            $('#applicants tbody').append(row)
        }

        $('#updateProcessByForm').submit(function(e){
           e.preventDefault();
           $('#confim-made').modal('show');



        });
        function userConfirmation(){
            $('#confim-made').modal('show');
        }
        $('#confirmationYes').click(function(){
             $('#confim-made').modal('hide');
             submitProcessedByForm();
        });
         $('#confirmationNo').click(function(){
              alert("false");
              return false;
         });
         function submitProcessedByForm(){
             var data = $('#updateProcessByForm').serialize();
            $.ajax({
                url :'/visa/processed-by',
                data: data,
                type: 'POST',
                beforeSend(){$('.block-load').fadeIn();},
                success:function(response){
                    $('.block-load').fadeOut();
                    if(response.success){
                            $('#response').append('<div class="alert alert-success"><strong>Successfully Updated !</div>');
                    }else{
                         $('#response').append('<div class="alert alert-danger"><strong>Error in Updating !</div>');
                    }
                    setTimeout(function(){
                        $('#response').empty();
                    },4000)

                }
            });
         }
         $('#withdrawnForm').submit(function(e){
             e.preventDefault();
             var dataString = $(this).serialize();
             $.ajax({
                 url :'/visa/withdraw',
                 data: dataString,
                 type: 'POST',
                 beforeSend(){$('.block-load').fadeIn();},
                 success:function(response){
                     $('.block-load').fadeOut();
                     if(response.success){
                         $('#response').append('<div class="alert alert-success"><strong>Successfully Updated !</div>');
                     }else{
                         $('#response').append('<div class="alert alert-danger"><strong>Error in Updating !</div>');
                     }
                     setTimeout(function(){
                         $('#response').empty();
                     },4000)

                 }
             });
         });
         $('#VisaApplicantsForm').submit(function(e){
             e.preventDefault();
             var dataString = $(this).serialize();
             $.ajax({
                 url :'/visa/dependent',
                 data: dataString,
                 type: 'POST',
                 beforeSend(){$('.block-load').fadeIn();},
                 success:function(response){
                     $('.block-load').fadeOut();
                     if(response.success){
                         $('#response').append('<div class="alert alert-success"><strong>Successfully Updated !</div>');
                     }else{
                         $('#response').append('<div class="alert alert-danger"><strong>Error in Updating !</div>');
                     }
                     setTimeout(function(){
                         $('#response').empty();
                     },4000)

                 }
             });
         })

        $(document).on('keyup', '[name*="price"]', function(){
            var arr = $('[name*="price"]');
            var tot=0;
            for(var i=0;i<arr.length;i++){
                if(parseInt(arr[i].value))
                    tot += parseInt(arr[i].value);
            }
            $('#total').text(tot)
        });

        $(document).on('focus','.date-picker',function(){
            $('.date-picker').datepicker();
        });
        $(document).on('click', '.del', function(){
            if($('#applicants tbody tr').length > 1){
                var parent = $(this).parent().parent();
                parent.remove()
            }
        })
        $(document).on('change', '[name*="status"]', function(){
            var value = $(this).val();
            (value == '1')? $('#withdraw').slideDown() : $('#withdraw').slideUp();
        })






    </script>
@endsection