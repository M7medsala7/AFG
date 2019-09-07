@extends('Layout.app')
@section('content')
<style type="text/css">
  .dataTables_filter{
    padding-left: 60%;

  }
.dataTables_wrapper {
    margin-top: 2%;
    zoom:0
}
.dataTables_filter input{
  background: lightblue;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #004d9a !important;
    border-radius: 100%;
    border: 1px solid #004d9a;
}
</style>
<section class="dashboard" style="padding-top: 10px">


<h6 style="    text-align: center;
    color: #043d77;
    margin-top: 11px;font-size: x-large;">Your Own Jobs</h6>
    <div class="row">
      <div class="col-sm-12">
      <div class="inner-aboutus" >
      <div style="padding-bottom:30px;">

  <div class="">
    <div class="row">
      <div class="col-sm-12 dashboardleft">
      <div class="inner-aboutus" >

    <table  id= "bootstrap-data-table" class="table table-striped table-bordered dt-responsive Jobs" style="width: 100%">

         

       
                    <thead>
                      <tr>
                        
                        <th>Job Name</th>
                        <th>Canidadte Number</th>
                        
                      
                       <th>Created At</th>
                        <th>Status</th>
                       <th>Show Candidates</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($Jobs as $all)
                      <tr>
  
          <td> {{$all['jobname']}}</td>
        
            
                <td>{{$all['cancount']}}</td>
                <td>{{date('Y/m/d', strtotime($all['date']))}}</td>
  <td><select size="1" id="row-1-office" name="row-1-office" class="changeStatus">
                    <option value="open" >
                        Open
                    </option>
                    <option value="closed">
                        Closed
                    </option>
                    <option value="pending">
                        Pending
                    </option>
                    <option value="underprocess">
                       UnderProcess
                    </option>
                    
                </select></td>
        <td><a href="/showcandidatejob/{{$all['id']}}/{{$userid}}"  class="largeredbtn" > Candidate </a> </td>
                      </tr>
                      @endforeach
                      
                   
                    
                    
                    </tbody>
                  </table>

                        </div>
        </div>
      <!--dashboardleft--> 
      
    </div>
    <!--row--> 
    
  </div>
  
  <!--container--> 
  
</section>

@endsection


@section('scripts')


<script type="text/javascript">
  $(document).ready(function() {
    $('.Jobs').DataTable({
  
    select:true,
    responsive: true,
    "order":[[0,"asc"]],
    'searchable':true,
    "scrollCollapse":true,
    "paging":true,
     "pagingType": "full_numbers",
      dom: 'lBfrtip'
      });


      $('select.changeStatus').change(function(){
      
    });
} );
</script>
@endsection