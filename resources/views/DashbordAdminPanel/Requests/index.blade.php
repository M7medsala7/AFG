@extends('DashbordAdminPanel.layout.master')

@section('content')

  <style type="text/css">
    
  </style>	
    

   

  <div class="content mt-3">


  
 <div class=" fadeIn">

                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Requests</strong>
                        </div>
                             
                                	     <!-- model -->
 

                        <div class="card-body">


                        	<div class="modal fade bd-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 
</div><!-- end myModal1 -->


                  <table id="bootstrap-data-table" class="table table-striped table-bordered Jobs">
                    <thead>
                    <tr>
                  
                 
                  <th > Name</th>
                  <th> email</th>
                  <th>Phone</th>
                  <th> Message</th>
                  <th> Status</th>
                
                </tr>

                    </thead>
                    <tbody>
                    @foreach($allrequests as $value)
                <tr>
                
                  <td>{{$value->name}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{$value->phone}}</td>
                  <td>{{$value->message}}</td>
                  @if($value->status=="Open")
                  <td  style="Background-color:#f86c6b;">
                  <a href="/updatestatus/{{$value->id}}" style="color:#ffffff"> 
                  {{$value->status}}
                  <a>
                  </td>
                  @else
                  <td style="Background-color:#4dbd74;color:#ffffff"> {{$value->status}}</td>
                  @endif
                  
                  
                </tr>

                      @endforeach
                      
                   
                    
                    
                    </tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div>
            </div>
@endsection



@section('scripts')
<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>
<script type="text/javascript">

 $(document).ready(function () {
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
      



});


</script>
<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>


@endsection