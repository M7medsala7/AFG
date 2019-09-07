<div id ="myPartialDiv" >



	<div style="border: hidden;">
@if (\Session::has('success'))
  


    <div class="alert alert-success">
  <strong>Suceess</strong> {!! \Session::get('success') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<br></br>
 <table  id= "bootstrap-data-table" class="table table-striped  Candidate" >

         

       
                    <thead>
                      <tr>
                          <th><input type="checkbox" id="check_all" class="checkboxth"></th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Birth Date</th>
                        <th>Phone Number</th>
                        <th>Gender</th>
                       <th>Job</th>
                       <th>Video</th>
                        <th>CV</th>
                        <th>Nationality</th>
                       <th>Status</th>
                       <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach( $result as $all)
       <tr id="tr_{{$all->id}}">
                    <td><input type="checkbox" class="checkboxall" data-id="{{$all->user_id}}"></td>
          <td><a class="tiptext">{{$all->user->name}}
  <iframe class="description" src="/candidate/{{$all->user_id}}"> </iframe>
</a> </td>
         <td> {{$all->last_name}}</td>
         <td> {{$all->birthdate}}</td>
          <td> {{$all->phone_number}}</td>
           @if($all->gender==0)
          <td>Male</td>
          @else
          <td>Female</td>
          @endif
            <td> {{$all->job->name}}</td>
              <td> <a   class="imgbox" onclick="ShowVideo('/{{$all->vedio_path}}','{{File::extension($all->vedio_path)}}')"> 
   
  
   <img src="/{{($all->user->logo)?$all->user->logo:'images/4.jpg'}}" style="width: 50px; height: 50px;margin-top:-20%"  >
   <i class="fas fa-play"></i> 
    </a>


</td>
               <td> <a href="/{{ $all->cv_path }}">CV</a></td>

                @if(is_null($all->nationality))
                <td>No Nationality</td>
                @else
                <td> {{$all->nationality->name}}</td>
@endif
                @if(is_null($all->getCandidateStaus->find($userid)))
                <td>No Status</td>

                @elseif($all->getCandidateStaus->find($userid)->pivot->AgencyStatus=='')
                <td>No Status</td>
                @else

          <td>{{$all->getCandidateStaus->find($userid)->pivot->AgencyStatus}}</td>
                  @endif
               



<td> <a  class="largeredbtn" onclick="updatestatus('{{$userid}}','{{$all->user_id}}')"> Action </a></td>
                      </tr>
                      @endforeach
                      
                   
                    
                    
                    </tbody>
                  </table>

          </div>
</div>
<script type="text/javascript">
	  $(document).ready(function() {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }


    });
    var table = $('.Candidate').DataTable( {
 select:true,

    responsive: true,
    "order":[[0,"asc"]],
    'searchable':true,
    "scrollCollapse":true,
    "paging":true,

      dom: 'lBfrtip'
      });
} );
</script>