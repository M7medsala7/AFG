  @foreach($topCandidates as $candidate)
  <div class="col-sm-4 company com-dashboard">
    <div class="ineercompany nonepad"> <a href="#" class="imgbox"> <img src="images/4.jpg"> <i class="fas fa-play"></i></a>
      <div class="padboxs">
       <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
        <h4 class="innertitltext">{{$candidate->user->name}}</h4>
        <p class="officer">nanny</p>
        <ul class="hassle salary">
          <li> 28 years</li>
          <li>{{$candidate->country->name}}</li>
        </ul>
        <div class="tidivbotom"> 
          <a href="#">know more</a> 
          <span>{{$candidate->created_at}}</span>
        </div>
        <!--tidiv--> 
        
      </div>
      <!--padboxs--> 
      
    </div>
    <!--inernews--> 
    
  </div>
@endforeach