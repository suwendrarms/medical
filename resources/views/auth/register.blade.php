@extends('layouts.ui.other')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading h-color p-5"><h3>Create Free Account</h3></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">

                        {{ csrf_field() }}

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="col-md-10 control-label">Name</label>

                                            <div class="col-md-12">
                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                                <div id="endtime" class="col-lg-6">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email" class="col-md-10 control-label">E-Mail Address</label>

                                                <div class="col-md-12">
                                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="col-md-10 control-label">Phone Number</label>

                                    <div class="col-md-12">
                                        <input  id="phonenum" type="tel" pattern="[0-9]{3} [0-9]{3} [0-9]{4}" maxlength="12" placeholder="0xx xxx xxxx" class="form-control" name="phone"  value="{{ old('phone') }}" required>


                                    </div>
                                </div>
                            </div>
                            <div id="endtime" class="col-lg-6">
                                    <div class="form-group">
                                    <label for="email" class="col-md-10 control-label">Date Of Birth</label>

                                    <div class="col-md-12">
                                        <input  type="date" class="form-control" name="dob" value="{{ old('dob') }}" required>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="col-md-10 control-label">Address Line 1</label>

                                    <div class="col-md-12">
                                    <input  type="text" class="form-control" name="address_line1" value="{{ old('address_line1') }}" required>


                                    </div>
                                </div>
                            </div>
                            <div id="endtime" class="col-lg-6">
                                    <div class="form-group">
                                    <label for="email" class="col-md-10 control-label">Address Line 2</label>

                                    <div class="col-md-12">
                                    <input  type="text" class="form-control" name="address_line2" value="{{ old('address_line2') }}" required>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="col-md-10 control-label">Address Line 3</label>
                                    <div class="col-md-12">
                                    <input  type="text" class="form-control" name="address_line3" value="{{ old('address_line3') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div id="endtime" class="col-lg-6">
                                    
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-10 control-label">Password</label>

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="endtime" class="col-lg-6">
                            <div class="form-group">
                                    <label for="password-confirm" class="col-md-10 control-label">Confirm Password</label>

                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                            <a class="btn btn-link" href="{{ route('login') }}">
                                    login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .login.login-3 .login-form {
  max-width: 800px;
}

.h-color{
    color: black !important;
}
</style>
@endsection
