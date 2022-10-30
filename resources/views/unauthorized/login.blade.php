@extends('unauthorized.layout')
@section('main-content')
<div class="account-pages my-4 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p>Sign in to continue to {{config('app.name')}}.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('dashboard/images/profile-img.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div>
                                <a href="#">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('dashboard/images/logo.png') }}" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                @if(session()->has('message.level'))
                                <div class="alert alert-{{ session('message.level') }}">
                                    {!! session('message.content') !!}
                                </div>
                                @endif
                                <form class="form-horizontal" name="login" action="{{route('login.auth')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter email" data-rule-required="true" data-msg-required="Please enter your email"  data-rule-email="true" data-msg-email="Please enter a valid email">
                                        @error('email')
                                        <label id="email-error" class="error" for="email">{{ $message }}</label>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password" data-rule-required="true" data-msg-required="Please enter your password">
                                        @error('password')
                                        <label id="password-error" class="error" for="password">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </form>
                                <div class="mt-4 text-center">
                                    <a href="{{route('forgot.password')}}" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">    
                        <div>
                            <p>Don't have an account ? <a href="{{route('register')}}" class="font-weight-medium text-primary"> Signup now </a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('form[name="login"]').validate();
    </script>
@endsection