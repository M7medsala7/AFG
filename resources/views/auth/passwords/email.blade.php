@extends('Layout.app')

@section('content')
{{--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>--}}
<section class="sliderphoto innerphoto" style="background:url(/images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container">
    <div class="modal-content dal-conte dal-conte2 forget">
      <h2 class="textcandidate ">forger your password ?</h2>
      <p class="viewsdriver"> truck driver congratulations truck driver congratulations truck </p>
      <form method="POST" action="{{ route('password.email') }}">
      {{ csrf_field() }}
        <div class="divwitsforget">
          <label class="desired looking">email address</label>
          <input id="email" type="email" class="form-control requirments" name="email" value="{{ old('email') }}" required placeholder="Enter address">
          <div class="resetpassword">
            <button type="submit" class="largeredbtn"> reset password</button>
          </div>
        </div>
        <!--divwits-->
        
      </form>
    </div>
    <!--dal-conte2--> 
    
  </div>
  <!--container--> 
  
</section>
<!--section-->
@endsection
