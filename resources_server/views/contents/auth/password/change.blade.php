@extends('contents.layouts.auth')
@section('title','Login Page')
@section('css')
    <link href="{{ URL::asset('assets/pages/css/login-2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('body')
    <body class=" login">
    <div class="loginBox">

        <div class="logo">
            <a href={{ URL('/') }}">
                <img src="{{ URL::asset('/assets/layouts/layout4/img/logo-light.png') }}" alt="" />
            </a>
        </div>
        <div class="content">
                <form class="login-form" role="form" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-title"> <span class="form-title">Reset Password.</span>
                    <span class="form-subtitle">Create your new password.</span>
                </div>

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Email Address" name="email" value="{{ $email or old('email') }}" />
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif

                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label visible-ie8 visible-ie9">New Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="New Password" name="password" />
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Re enter Password" name="password_confirmation" />
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                             <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-block uppercase">Change Password</button>
                </div>
            </form>
        </div>
    </div>
    <div class="copyright">2017 &copy; Applycourses.com. All rights reserved.</div>
@endsection

@section('js')

@endsection