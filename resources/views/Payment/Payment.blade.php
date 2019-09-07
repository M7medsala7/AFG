
@extends('Layout.app')
<style type="text/css">
.fasize{
  
    width: 2em;
    height: 1.5em;

}
.fa-cc-discover {
    color: #f68121;
    
  }
  .fa-cc-jcb {
    color: #003A8F;
    
  }
  .fa-cc-mastercard {
    color:  #0a3a82;
    
  }
  .fa-cc-paypal {
    color: #253b80;
    
  }
  .fa-cc-stripe {
    color: #00afe1;
    
  }
  .fa-cc-visa {
    color: #0157a2;
   
  }

</style>
@section('content')

<script src="https://use.fontawesome.com/f1e0bf0cbc.js"></script>

<section class="contactus">
  <div class="container">
  @if(Session::has('flash'))
    <div class="alert alert-success">
        {{ Session::get('flash') }}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
  @endif
  @if(Session::has('flashlogin'))
    <div class="alert alert-info">
        you not login !!!!!!<a href="/loginEmployer">press here to login</a><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
  @endif
  @if(Session::has('flashcandidate'))
    <div class="alert alert-info">
        you are candidate register as employer before <a href="/register/employer">press here to register</a><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
  @endif
  
    <div class="inner-contacts">
      <h2 class="textcandidate conmerg">Our Packages</h2>
      <div class="col-sm-12 contacts">
      <div class="tab-content">
        <ul class="nav nav-tabs tebprofile employerstebs">
          <li class="active"><a data-toggle="tab" href="#monthlyplans">monthly plans</a></li>
          <li><a data-toggle="tab" href="#annualplans"> annual plans</a></li>
        </ul>
        <!--employerstebs-->
        
        <div id="monthlyplans" class="tab-pane employerbox fade in active">
          @foreach($Packages as $pack)
          <div class="col-sm-4 empcol">
            <div class="empcolbox">
              <h2 class="textcandidate">{{$pack->name}}</h2>
              <h3 class="textcandidate">${{$pack->price}}/ <span>monthly</span></h3>
              @foreach($pack->getpackattribute as $j)
              <p class="textpoint">{{$j->name}}-{{$j->pivot->Value}}</p>
             @endforeach
              <a href="/PayMethod/{{$pack->id}}/1"><i class="fa fa-cc-discover fasize" style="font-size: 1.5em;" ></i></a>
              <a href="/PayMethod/{{$pack->id}}/1"><i class="fa fa-cc-mastercard fasize" style="font-size: 1.5em;"></i></a>
              <a href="/PayMethod/{{$pack->id}}/1"><i class="fa fa-cc-paypal fasize" style="font-size: 1.5em;"></i></a>
              <a href="/PayMethod/{{$pack->id}}/1"><i class="fa fa-cc-stripe fasize" style="font-size: 1.5em;"></i></a>
              <a href="/PayMethod/{{$pack->id}}/1"><i class="fa fa-cc-visa fasize" style="font-size: 1.5em;"></i></a>
            </div>
          </div>
          @endforeach
        </div>

       <div id="annualplans" class="tab-pane employerbox fade ">
        @foreach($Packages as $pack)
          <div class="col-sm-4 empcol">
            <div class="empcolbox">
              <h2 class="textcandidate">{{$pack->name}}</h2>
              <h3 class="textcandidate">${{$pack->Priceyear}}/ <span>yearly</span></h3>
              @foreach($pack->getpackattribute as $j)
             <p class="textpoint">{{$j->name}}-{{$j->pivot->Valueyear}}</p>
             @endforeach
              <a href="/PayMethod/{{$pack->id}}/2"><i class="fa fa-cc-discover fasize" style="font-size: 1.5em;"></i></a>
              <a href="/PayMethod/{{$pack->id}}/2"><i class="fa fa-cc-mastercard fasize" style="font-size: 1.5em;"></i></a>
              <a href="/PayMethod/{{$pack->id}}/2"><i class="fa fa-cc-paypal fasize" style="font-size: 1.5em;"></i></a>
              <a href="/PayMethod/{{$pack->id}}/2"><i class="fa fa-cc-stripe fasize" style="font-size: 1.5em;"></i></a>
              <a href="/PayMethod/{{$pack->id}}/2"><i class="fa fa-cc-visa fasize" style="font-size: 1.5em;"></i></a>
            </div>
          </div>
          @endforeach
        </div>
      <!--tab-content--> 
      
       </div>
    </div>
    </div>
  </div>
 </section>
 @endsection

@section('scripts')
<script>
   $(function(){
    $('header').addClass('header-in');
  });
</script>
@endsection