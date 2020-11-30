@extends('contents.layouts.auth')
@section('title','Login Page')
@section('css')
    <link href="{{ URL::asset('assets/pages/css/login-2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('body')
    <body class="login">
    <div class="loginBox">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="{{ URL('/') }}">
                <img src="{{ URL::asset('assets/layouts/layout4/img/logo-light.png') }}" alt="" />
            </a>
        </div>
        <div class="content">
            <form class="login-form" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
                <div class="form-title"> <span class="form-title">Welcome.</span>
                    <span class="form-subtitle">Please login.</span>
                </div>

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Email Address" name="email" required  value="{{ old('email') }}"/>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                 <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"  required/>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-block uppercase">Login</button>
                </div>

                <div class="form-actions">
                    <div class="pull-left">
                        <label class="rememberme check">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />Remember me</label>
                    </div>
                    <div class="pull-right forget-password-block">

                        <a  href="{{ route('password.request') }}" id="forget-password" class="forget-password">Forgot Password?</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="copyright">2017 &copy; Applycourses.com. All rights reserved.</div>

@endsection

@section('js')

@endsection