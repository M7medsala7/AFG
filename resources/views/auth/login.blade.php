@extends('Layout.app')
<style>
    .ortext{
        position: absolute;
        left: -10px;
        top: 50%;
        font-size: 20px;
        color: #000;
        background: #fff;
        padding: 5px 0px;
        margin-top: -15px;
        font-weight: bold;
    }
    .iconsoch{
        float: left;
        width: 100%;
        margin-top: 20px;
        border-left: 1px solid #ccc;
        padding-left: 30px;
        position: relative;
    }
    .iconsoch a{
        float: left;
        width: 100%;
        margin-bottom: 15px;
        border-radius: 5px;
        overflow: hidden;
        color: #fff;
        height: 40px;
        text-align: center;
        padding-top: 8px;
    }
    .inputbox
    {
            float: left;
            margin-top: 30px;
    }
    .iconsoch a:last-child
    {
            margin: 0!important;
    }
</style>
@section('content')
{{--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>--}}
<section class="sliderphoto innerphoto" style="background:url(images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container">
    <div class="modal-content dal-conte dal-conte2 forget">
      <h2 class="textcandidate ">sign in with</h2>
      <form action="{{ route('login') }}" method="post">
      {{ csrf_field() }}
        <div class="divwitsforget">
          <label class="desired looking">email address</label>
          <input type="email" name="email" class="form-control requirments" placeholder="email address">
          <input type="password" class="form-control requirments" name="password" required placeholder="password">
          <div class="resetpassword">
            <button type="submit" class="largeredbtn"> login now</button>
          </div>
        </div>
        <!--divwits-->
        
      </form>
      <div class="registerwith"> <span>or</span>
        <p>Register With</p>
        <nav class="iconrgest"> <a href="#" class="fab fa-facebook-f" title="facebook"></a> <a href="#" class="fab fa-twitter" title="twitter"></a> <a href="#" class="fab fa-instagram" title="instagram"></a> <a href="#" class="fab fa-google-plus-g" title="google-plus"></a> 
        </nav>
      </div>
      <div> <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a></div>
      <!--registerwith--> 
      
    </div>
    <!--dal-conte2--> 
    
  </div>
  <!--container--> 
  
</section>
<!--section-->


@endsection
