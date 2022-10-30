@extends('unauthorized.layout')
@section('main-content')
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary"> Reset Password</h5>
                                    <p>Re-Password with {{config('app.name')}}.</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="{{asset('dashboard/images/profile-img.png')}}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0"> 
                        <div>
                            <a href="index-2.html">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="{{asset('dashboard/images/logo.png')}}" alt="" class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </a>
                        </div>
                        
                        <div class="p-2">
                            <form class="form-horizontal" name="reset-password" action="{{route('reset.passwords.post')}}" method="POST">
    
                                @csrf
                                <input type="hidden" name="token" value="{{$token}}">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" value="{{old('password')}}" data-rule-required="true" data-msg-required="Please enter your password"  data-rule-minlength="6" data-msg-minlength="Password must be of 6 character">
                                    @error('password')
                                    <label id="password-error" class="error" for="password">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cpassword">Confirm Password</label>
                                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Enter confirm password" value="{{old('cpassword')}}" data-rule-required="true" data-msg-required="Please enter your confirm password"  data-rule-minlength="6" data-msg-minlength="Password must be of 6 character" data-rule-equalTo="#password" data-msg-equalTo="Confirm password must be same as password">
                                    @error('password')
                                    <label id="password-error" class="error" for="password">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>Remember It ? <a href="{{route('login')}}" class="font-weight-medium text-primary"> Sign In here</a> </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $('form[name="reset-password"]').validate();
</script>
@endsection