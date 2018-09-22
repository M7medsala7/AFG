<div class="row">
@foreach($cand_infos  as $candidate)
<div class="col-sm-4 company com-dashboard" style="width:325px;">
 <div class="ineercompany nonepad"> 
 <input type="hidden" name="candidate[]" class="candidate" value="{{$candidate->CanId}}" id="candidate">
      
  <div  style="min-height:300px"> 

 @if($candidate->vedio_path !=null)
 <a   class="imgbox" onclick="ShowVideo('/{{$candidate->vedio_path}}','{{File::extension($candidate->vedio_path)}}')"> 
   
  
   <img src="{{($candidate->user->logo)?$candidate->user->logo:'images/4.jpg'}}" >
   <i class="fas fa-play"></i> 
    </a>
   
 @endif
  @if($candidate->vedio_path ==null)
  <a   class="imgbox">
    <img src="{{($candidate->user->logo)?$candidate->user->logo:'images/4.jpg'}}" >
    </a>
     @endif
          <div class="padboxs"> <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
            <h4 class="innertitltext">{{$candidate->user->name}}</h4>
            <p class="officer">{{$candidate->job->name}}</p>
            <ul class="hassle salary">
              
             <li>{{($candidate->nationality)?$candidate->nationality->name:"Nationality is not set"}}</li>
            </ul>
            <a href="https://www.facebook.com/dialog/share?
app_id=1112718265559949
&display=popup
&title='maid and helper'
&description='Mohamed salah'
&quote={{$candidate->user->name}}:{{$candidate->descripe_yourself}}
&caption='Dody'
&href=https://www.maidandhelper.com/candidate/{{$candidate->user->id}}

&redirect_uri=https://www.facebook.com/"><i class="fas fa-share-alt"></i></a>
            <div class="tidivbotom">  <a href="/candidate/{{$candidate->user->id}}">view profile</a> <span>{{$candidate->created_at}}</span></div>
            <!--tidiv--> 
            
            

          <!--padboxs--> 
          
        </div>
        <!--inernews--> 
        </div>
      </div>
      </div>
             @endforeach
             <div style="margin-left:37%;">
             {{$cand_infos->links()}}
             </div>
            </div>