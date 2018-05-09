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
  <div class="loginbok">
    <h3 class="title-con  signwith"> sign in with </h3>
    <div class="col-sm-6 inputbox">
      <form  action="{{ route('login') }}" method="post" class="formlogin">
      {{ csrf_field() }}
        <div class="divwits iconfont">
          <label class="desired"> email address</label>
          <input id="email" type="email" name="email" class="form-control" placeholder="email address">
        </div>
        <!--divwits-->
        
        <div class="divwits iconfont">
          <label class="desired"> password</label>
          <input id="password" type="password" class="form-control" name="password" required placeholder="password">
        </div>
        <!--divwits-->
        
        <div class="divwits">
          <div class="row"> 
            <!-- <div class="col-sm-6 botrg">
              <button type="submit" class="largeredbtn back"> <i class="fas fa-long-arrow-alt-left"></i> back</button>
            </div>-->
            <div class="col-sm-6 botrg col-sm-offset-3">
              <button type="submit" class="largeredbtn"> login</button>
            </div>
          </div>
          <!--row--> 
          
        </div>
        <!--divwits-->
        
      </form>
    </div>
    <!--inputbox-->
    
    <div class="col-sm-6 inputbox">
      <nav class="iconsoch">
        <p class="ortext">or</p>
        <a href="#" title="facebook" style="    background: #3c579e;"><i class="fab fa-facebook-f"></i> sign up with Facebook</a> <a href="#" title="twitter" style="background: #55acee;"><i class="fab fa-twitter"></i> sign up with twitter</a> <a href="#" title="instagram" style="background: #a46b58;"><i class="fab fa-instagram"></i> sign up with instagram</a> </nav>
    </div>
    <!--inputbox--> 
    
  </div>
  <!--container--> 
  
</section>

@endsection
