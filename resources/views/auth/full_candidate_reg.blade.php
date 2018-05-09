@extends('Layout.app')

@section('content')
<section class="sliderphoto innerphoto" style="background:url(/images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container"> 
    <ul class="nav nav-tabs  tabssteps">
      <li rel-index="0" class="active"> <a href="#step-1" class="btn" aria-controls="step-1" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-user"></i></span> </a> </li>
      <li rel-index="1"> <a href="#step-2" class="btn disabled" aria-controls="step-2" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-heart"></i></span> </a> </li>
      <li rel-index="2"> <a href="#step-3" class="btn disabled" aria-controls="step-3" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-plus"></i></span> </a> </li>
      <li rel-index="3"> <a href="#step-4" class="btn disabled" aria-controls="step-4" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-ok"></i></span> </a> </li>
      <li rel-index="4"> <a href="#step-5" class="btn disabled" aria-controls="step-5" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-ok"></i></span> </a> </li>
      <li rel-index="5"> <a href="#step-6" class="btn disabled" aria-controls="step-6" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-ok"></i></span> </a> </li>
      <li rel-index="6"> <a href="#step-7" class="btn disabled" aria-controls="step-7" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-ok"></i></span> </a> </li>
    </ul>
    <!--tabssteps-->
    
    <form  action="/f_reg/candidate" method="post" id="full_cand_reg" class="formlogin mergform">
            {{csrf_field()}}
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane  nonebac active" id="step-1">
          <div class="inputbox margmadia nonmegtext nonmerg">
            <h4 class="title-con entea ">welcome to </h4>
            <h5 class="title-con entea"> the future of applications</h5>
            <p class="textprgraf"> be prepared to provide your details
              and make<br>
              sure <span> webcam</span> is on </p>
          </div>
          <!--nonmegtext-->
          
          <div class="innertabs">
            <div class="row">
              <div class="col-sm-6 instructionsleft">
                <h3 class="airports inrtodce"> how does it work?</h3>
                <div class="witboots"> <a href="#" data-toggle="modal" data-target="#myModal" class="largeredbtn "> watch demo video</a> </div>
                <!--botrg-->
                
                <h3 class="airports inrtodce"> ready to start?</h3>
                <a href="#" id="step-1-next" class="largeredbtn"> go <i class="fas fa-long-arrow-alt-right"></i></a> </div>
              <!--instructionsleft-->
              
              <div class="col-sm-6 instructionsleft"> <a href="#" data-toggle="modal" data-target="#myModal" class="watchvideo"> <img src="/images/slide5.jpg"> <i class="fas fa-play"></i>
                <p>watch demo video</p>
                </a> </div>
              <!--instructionsleft--> 
            </div>
            <!--row--> 
            
          </div>
          <!--innertabs--> 
          
        </div>
        <!--tab-pane-->
        
        <div role="tabpanel" class="tab-pane nonebac witsteptow" id="step-2">
          <div class="headtop nonbord borderbox">
            <div class="stapson active"><span>1</span>
              <h4 class="personalinfo">personal info</h4>
            </div>
            <div class="rightcealr"> <span class="active"></span> <span></span> <span></span> <span></span><button type="button" style="float: right;padding: 5px 10px;background: #444551;color: #fff;border-radius: 5px; border: 0 solid;margin-left: 10px;" class="clear_all">clear all</button> </div>
          </div>
          <!--borderbox-->
          
          <div class="row">
            <div class="col-sm-6 leftinput">
              <div class="row">
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments" name="first_name" placeholder="full name">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments" name="last_name" placeholder="last name">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments" placeholder="nationality">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments"  placeholder="current country">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments"  placeholder=" phone no">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments"  placeholder="email">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments"  placeholder="cofirm email">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <select class="form-control requirments" name="" required="">
                    <option selected=""> gender</option>
                    <option value="4">Male</option>
                    <option value="4">female</option>
                  </select>
                </div>
                <!--witpostslid--> 
                
              </div>
              <!--row--> 
              
            </div>
            <!--leftinput-->
            
            <div class="col-sm-6 leftinput">
              <div class="row">
                <div class="col-sm-12 airports witpostslid">
                  <select class="form-control requirments" name="" required="">
                    <option selected=""> marital status</option>
                    <option value="4">single</option>
                  </select>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments" placeholder="religion">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid"> 
                  
                  <!--             <label class="desired">birth date</label>
-->
                  <input type="text" class="form-control requirments calendar"  placeholder="birth date">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <div class="input-group input-file" name="Fichier1">
                    <input type="text" class="form-control requirments" placeholder='image...' />
                    <span class="input-group-btn">
                    <button class="btn btn-default btn-choose largeredbtn brows" type="button">brows</button>
                    </span> </div>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <div class="input-group input-file" name="Fichier1">
                    <input type="text" class="form-control requirments" placeholder='cv...' />
                    <span class="input-group-btn">
                    <button class="btn btn-default btn-choose largeredbtn brows" type="button">upload</button>
                    </span> </div>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <select class="form-control requirments" name="" required="">
                    <option selected=""> emploer-type of visa</option>
                    <option value="4">single</option>
                  </select>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid"> 
                  <!--      <label class="desired">expired date visa</label>-->
                  
                  <input type="text" class="form-control requirments calendar"  placeholder="expired date visa">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <div class="row">
                    <div class="col-sm-6  stepotw">
                      <div class="linksing textcand-1">
                        <p>10</p>
                        <span>earn points <i class="fas fa-trophy"></i><br>
                        with each step</span> </div>
                    </div>
                    <div class="col-sm-3  stepotw"> <a href="#" id="step-1-back" class="largeredbtn back"> back</a> </div>
                    <div class="col-sm-3  stepotw"> <a href="#" id="step-2-next" class="largeredbtn">Next </a> </div>
                  </div>
                  <!--row--> 
                  
                </div>
              </div>
              <!--row--> 
              
            </div>
            <!--leftinput--> 
            
          </div>
          <!--row--> 
          
        </div>
        <!--tab-pane-->
        
        <div role="tabpanel" class="tab-pane nonebac" id="step-3">
          <div class="headtop nonbord borderbox">
            <div class="stapson active"><span>2</span>
              <h4 class="personalinfo">your profile</h4>
            </div>
            <div class="rightcealr"> <span class="active"></span> <span class="active"></span> <span></span> <span></span><button type="button" style="float: right;padding: 5px 10px;background: #444551;color: #fff;border-radius: 5px; border: 0 solid;margin-left: 10px;" class="clear_all">clear all</button> </div>
          </div>
          <!--borderbox-->
          
          <div class="row">
            <div class="col-sm-12 airports witpostslid">
              <select class="form-control requirments" name="" required="">
                <option selected=""> languages</option>
                <option value="4">languages</option>
                <option value="4">languages</option>
              </select>
            </div>
            <!--witpostslid-->
            
            <div class="col-sm-12 airports witpostslid">
              <select class="form-control requirments" name="" required="">
                <option selected=""> eduction level</option>
                <option value="4">eduction level</option>
                <option value="4">eduction level</option>
              </select>
            </div>
            <!--witpostslid-->
            
            <div class="col-sm-12 airports witpostslid">
              <input type="text" class="form-control requirments" placeholder="note:other">
            </div>
            <!--witpostslid-->
            
            <div class="col-sm-12 airports witpostslid">
              <input type="text" class="form-control requirments" placeholder="skills">
            </div>
            <!--witpostslid-->
            
            <div class="col-sm-12 airports witpostslid">
              <input type="text" class="form-control requirments" placeholder="describe your self in one sentence">
            </div>
            <!--witpostslid-->
            
            <div class="col-sm-12 airports witpostslid">
              <div class="row">
                <div class="col-sm-6  stepotw">
                  <div class="linksing textcand-1">
                    <p>20</p>
                    <span>earn points <i class="fas fa-trophy"></i><br>
                    with each step</span> </div>
                </div>
                <div class="col-sm-3  stepotw"> <a href="#" id="step-2-back" class="largeredbtn back"> back</a> </div>
                <div class="col-sm-3 stepotw"> <a href="#" id="step-3-next" class="largeredbtn">Next </a> </div>
              </div>
              <!--row--> 
              
            </div>
          </div>
          <!--row--> 
          
        </div>
        
        <!--tab-pane-->
        
        <div role="tabpanel" class="tab-pane nonebac" id="step-4">
          <div class="headtop nonbord borderbox">
            <div class="stapson active"><span>3</span>
              <h4 class="personalinfo">job expectations</h4>
            </div>
            <div class="rightcealr"> <span class="active"></span> <span class="active"></span> <span class="active"></span> <span></span><button type="button" style="float: right;padding: 5px 10px;background: #444551;color: #fff;border-radius: 5px; border: 0 solid;margin-left: 10px;" class="clear_all">clear all</button> </div>
          </div>
          <!--borderbox-->
          
          <div class="divwits">
            <label class="desired looking">actively looking for a job</label>
            <div class="row">
              <div class="col-sm-6 binputs">
                <input type="text" class="form-control requirments" placeholder="yes, no">
              </div>
              <label class="col-sm-3 airports cololabox">
                <input type="checkbox" name="checkbox">
                <span class="label-text">yes</span> </label>
              <label class="col-sm-3 airports cololabox">
                <input type="checkbox" name="checkbox">
                <span class="label-text">no</span> </label>
            </div>
            <!--row--> 
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <select class="form-control requirments" name="" required="">
              <option selected=""> type of position</option>
              <option value="4"> type of position</option>
            </select>
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" placeholder="what is your minimum salary?">
          </div>
          <!--divwits-->
          
          <div class="linksing"> <a href="#" class="skiplink lefttext">if you wwant to coutenue please click here to answer the questions if not click submit </a> </div>
          <div class="divwits">
            <select class="form-control requirments" name="" required="">
              <option selected=""> preferred locations top work at</option>
              <option value="4"> type of position</option>
            </select>
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <select class="form-control requirments" name="" required="">
              <option selected=""> preferred locations top work at</option>
              <option value="4"> type of position</option>
            </select>
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" placeholder=" uou can select mulicountries you wish to work at">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <select class="form-control requirments" name="" required="">
              <option selected=""> keywords</option>
              <option value="4"> type of position</option>
            </select>
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-6  stepotw">
                <div class="linksing textcand-1">
                  <p>30</p>
                  <span>earn points <i class="fas fa-trophy"></i><br>
                  with each step</span> </div>
              </div>
              <div class="col-sm-3  stepotw"> <a href="#" id="step-3-back" class="largeredbtn back"> back</a> </div>
              <div class="col-sm-3  stepotw"> <a href="#" id="step-4-next" class="largeredbtn">Next </a> </div>
            </div>
            <!--row--> 
            
          </div>
          <!--divwits--> 
          
        </div>
        <!--tab-pane-->
        
        <div role="tabpanel" class="tab-pane nonebac" id="step-5">
          <div class="headtop nonbord borderbox">
            <div class="stapson active"><span>4</span>
              <h4 class="personalinfo">job expectations</h4>
            </div>
            <div class="rightcealr"> <span class="active"></span> <span class="active"></span> <span class="active"></span> <span class="active"></span><button type="button" style="float: right;padding: 5px 10px;background: #444551;color: #fff;border-radius: 5px; border: 0 solid;margin-left: 10px;" class="clear_all">clear all</button> </div>
          </div>
          <!--borderbox-->
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-6 binputs">
                <select class="form-control requirments" name="" required="">
                  <option selected=""> working in</option>
                  <option value="4">working in</option>
                  <option value="4">working in</option>
                </select>
              </div>
              <div class="col-sm-3 binputs">
                <input type="text" class="form-control requirments" placeholder="from">
              </div>
              <div class="col-sm-3 binputs">
                <input type="text" class="form-control requirments" placeholder="to">
              </div>
            </div>
            <!--row--> 
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" placeholder="employer nationality">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" placeholder="   company name">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" placeholder="location">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" placeholder="slary may be">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" placeholder=" what is your tasks in company">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-6  stepotw">
                <div class="linksing textcand-1">
                  <p>40</p>
                  <span>earn points <i class="fas fa-trophy"></i><br>
                  with each step</span> </div>
              </div>
              <div class="col-sm-3  stepotw"> <a href="#" id="step-4-back" class="largeredbtn back"> back</a> </div>
              <div class="col-sm-3  stepotw"> <a href="#" id="step-5-next" class="largeredbtn">Next </a> </div>
            </div>
            <!--row--> 
            
          </div>
          <!--divwits--> 
          
        </div>
        
        <!--tab-pane-->
        
        <div role="tabpanel" class="tab-pane nonebac witsteptow" id="step-6">
          <div class="inputbox margmadia nonmegtext nonmerg">
            <h4 class="title-con entea ">broadcst your talent</h4>
            <h5 class="title-con entea">upload/record video gallary of your work</h5>
          </div>
          <!--nonmegtext-->
          
          <div class="innertabs">
            <div class="row">
              <div class="col-sm-4 prerare"> <i class="iconnamer">1</i>
                <div class="padtext">
                  <h4>prerare it beforehand</h4>
                  <p>prerare it beforehand prerare it beforehand prerare it beforehand</p>
                </div>
                <!--padtext--> 
              </div>
              <!--prerare-->
              
              <div class="col-sm-4 prerare"> <i class="iconnamer">2</i>
                <div class="padtext">
                  <h4>record the vedio</h4>
                  <p>prerare it beforehand prerare it beforehand prerare it beforehand</p>
                </div>
                <!--padtext--> 
                
              </div>
              <!--prerare-->
              
              <div class="col-sm-4 prerare"> <i class="iconnamer">3</i>
                <div class="padtext">
                  <h4>double chech before upload</h4>
                  <p>prerare it beforehand prerare it beforehand prerare it beforehand</p>
                </div>
                <!--padtext--> 
                
              </div>
              <!--prerare--> 
              
            </div>
            <!--sendvad--> 
            
          </div>
          <!--row-->
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-6 clickupload"> <a href="#" data-toggle="modal" data-target="#myModa2" class="largeredbtn">click here to upload</a> </div>
              <div class="col-sm-6 clickupload"> <a href="#" data-toggle="modal" data-target="#myModa2" class="largeredbtn">click here to upload</a> </div>
            </div>
            <!--row--> 
            
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-8  stepotw">
                <div class="linksing textcand-1">
                  <p>50</p>
                  <span>earn points <i class="fas fa-trophy"></i><br>
                  with each step</span> </div>
              </div>
              <div class="col-sm-2  stepotw"> <a href="#" id="step-5-back" class="largeredbtn back"> back</a> </div>
              <div class="col-sm-2  stepotw"> <a href="#" id="step-6-next" class="largeredbtn">finish </a> </div>
            </div>
            <!--row--> 
            
          </div>
          <!--witpostslid--> 
          
        </div>
        <!--tab-pane-->
        
        <div role="tabpanel" class="tab-pane nonebac" id="step-7">
          <div class="inputbox margmadia nonmegtext nonmerg">
            <h4 class="title-con entea ">almost done !</h4>
            <h5 class="title-con entea">reveiw your application</h5>
          </div>
          <!--nonmegtext-->
          
          <div class="row">
            <div class="col-sm-8 sendvad">
              <div class="innertabs">
                <div class="divwits">
                  <label class="airports cololabox personal-in">
                    <input type="checkbox" name="checkbox">
                    <span class="label-text">personal information</span> </label>
                </div>
                <!--divwits-->
                
                <div class="divwits">
                  <label class="airports cololabox personal-in">
                    <input type="checkbox" name="checkbox">
                    <span class="label-text"> job expectations</span> </label>
                </div>
                <!--divwits-->
                
                <div class="divwits">
                  <label class="airports cololabox personal-in">
                    <input type="checkbox" name="checkbox">
                    <span class="label-text"> work  expectations</span> </label>
                </div>
                <!--divwits-->
                
                <div class="divwits">
                  <label class="airports cololabox personal-in">
                    <input type="checkbox" name="checkbox">
                    <span class="label-text"> upload / record video</span> </label>
                </div>
                <!--divwits-->
                
                <div class="divwits">
                  <label class="airports cololabox personal-in">
                    <input type="checkbox" name="checkbox">
                    <span class="label-text"> iagree with the <a href="#" class="termsagreements">terms & agreements</a></span> </label>
                </div>
                <!--divwits--> 
                
              </div>
              <!--innertabs--> 
              
            </div>
            <!--sendvad-->
            
            <div class="col-sm-4 sendvad imgwith"> <img src="/images/sendvad.png">
              <button type="submit" data-toggle="modal" data-target="#myModa3"  class="largeredbtn"> send</button>
            </div>
            <!--sendvad--> 
            
          </div>
          <!--row--> 
          
        </div>
        
        <!--tab-pane--> 
        
      </div>
      
      <!--tab-content-->
      
    </form>
  </div>
  <!--container--> 
  
</section>
<!--section-->

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch demo video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="textbox">
        <iframe  src="https://www.youtube.com/embed/BFrLL5w9UGQ?autoplay=0" frameborder="0" allowfullscreen></iframe>
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->

<div id="myModa2" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> record a video
        <button type="button" class="close" data-dismiss="modal">أ—</button>
      </div>
      <div class="textbox">
        <form action="#" method="" class="formlogin video-rc">
          <div class="divwits iconfont">
            <input type="text" class="form-control" placeholder="Video Tilte">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-3 record-ve">
                <button type="submit" class="largeredbtn"> <i class="fas fa-video"></i> record </button>
              </div>
              <div class="col-sm-3 record-ve">
                <button type="submit" class="largeredbtn"> <i class="fas fa-play"></i> play</button>
              </div>
              <div class="col-sm-3 record-ve">
                <button type="submit" class="largeredbtn"> <i class="fas fa-stop-circle"></i> stop</button>
              </div>
              <div class="col-sm-3 record-ve">
                <button type="submit" class="largeredbtn"> <i class="fas fa-upload"></i> upload</button>
              </div>
            </div>
            <!--row--> 
            
          </div>
          <!--divwits-->
          
        </form>
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModa2-->

<div id="myModa3" class="modal fade">
  <div class="modal-content dal-conte dal-conte2"> <i class="fas fa-check-circle"></i>
    <h2 class="textcandidate">congratulations</h2>
    <p class="viewsdriver"> truck driver congratulations truck driver congratulations truck driver congratulations truck driver congratulations</p>
    <div class="sk-circle">
      <div class="sk-circle1 sk-child"></div>
      <div class="sk-circle2 sk-child"></div>
      <div class="sk-circle3 sk-child"></div>
      <div class="sk-circle4 sk-child"></div>
      <div class="sk-circle5 sk-child"></div>
      <div class="sk-circle6 sk-child"></div>
      <div class="sk-circle7 sk-child"></div>
      <div class="sk-circle8 sk-child"></div>
      <div class="sk-circle9 sk-child"></div>
      <div class="sk-circle10 sk-child"></div>
      <div class="sk-circle11 sk-child"></div>
      <div class="sk-circle12 sk-child"></div>
    </div>
    <div class="linksing"> rediricling you to the profile page in <span class="nambers">7</span> seconds</div>
  </div>
</div>
<!--myModa3-->
@endsection
@section('scripts')
<script>
	$('.clear_all').on('click',function(){
		document.getElementById('full_cand_reg').reset();
	});
</script>
@endsection