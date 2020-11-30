@extends('contents.layouts.app')
@section('title','Department List')

@section('css')   
     <link href="{{ URL::asset('assets/pages/css/profile.css') }}" rel="stylesheet">
@endsection


@section('body')

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>User Profile
                    <small>user profile details</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">User</span>
            </li>
        </ul>
        <div class="profile">
            <div class="row">
                <div class="col-md-3">
                    <div class="profile-info-left margin-bottom-20">
                        <img src="{{ (Storage::disk('s3')->exists($user->image_path))  ? Storage::disk('s3')->url($user->image_path) : 'http://img2.wikia.nocookie.net/__cb20130607025329/creepypasta/images/3/38/Avatar-blank.jpg'  }}" class="img-responsive pic-bordered margin-bottom-20" alt="" />
                        <h3>{{ $user->name }}</h3>
                        <h5><b>{{ $user->department->name }}</b></h5>
                    </div>
                    <div class="profile-info-left">
                        <h4><b>Basic Details</b></h4>
                        <ul class="list-unstyled profile-settings-tab">
                            <li>
                                <p>Employee No:<b> AC {{ $user->id }}</b></p>
                            </li>
                            <li>
                                <p>Email Id:<b> {{ $user->email }}</b></p>
                            </li>
                            <li>
                                <p>Joined On:<b> {{ $user->created_at }}</b></p>
                            </li>
                            <li>
                                <p>
                                    Employee Status: 
                                    @if($user->status == 0)
                                         <span class="label label-success"><b> Active </b> </span>
                                    @else
                                        <span class="label label-danger"><b> Inactive </b> </span>
                                    @endif
                                     <button type="button" class="btn btn-warning btn-xs pull-right change" value="{{ $user->id }}">Change</button>
                                </p>

                            </li>
                            <li>
                                <p>Phone: <b>{{ $user->contact }}</b></p>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
</div>
  
@endsection


@section('js')
<script>
    $('.change').click(function(){
        var value = $(this).val();
        $.ajax({
            url : '/api/user/statusUpdate/'+value,
            dataType : 'JSON',
            success:function(response){
               if(response.success){
                    location.reload();
               }
            }

        });
    })
</script>
   
   



@endsection