@extends('contents.layouts.auth')
@section('title','Login Page')
@section('css')
    <link href="{{ URL::asset('assets/pages/css/login-2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('body')
    <div class="login forgotPassword">
        <div class="loginBox">
            <div class="logo">
                <a href="{{ URL('/') }}">
                    <img src="{{ URL::asset('/assets/layouts/layout4/img/logo-light.png') }}" alt="" />
                </a>
            </div>
            <div class="content">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="" role="form" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="form-title"> <span class="form-title">Forget Password ?</span>
                        <span class="form-subtitle">Enter your e-mail to reset it.</span>
                    </div>
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button> <span> Enter any username and password. </span>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="control-label visible-ie8 visible-ie9">Email Address</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Username or Email Address" name="email" value="{{ old('email') }}"  />
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-actions">
                        <a href="{{ URL('/') }}" id="back-btn" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-primary uppercase pull-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="copyright">2017 &copy; Applycourses.com. All rights reserved.</div>
@endsection

@section('js')

@endsection