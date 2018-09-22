@extends('Dashboardadmin.layout.layout')
@section('content')

 <section class="content-header" style="background-color: ">
     
      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('/adminpanel/postjob')}}">All PostJob</a></li>
      </ol>
     
    </section>

    <!-- Main content -->
    <section class="content" style="background-color:; ">
      <div class="row">
        <div class="col-xs-12">
         
            <!-- /.box-header -->
            <div class="box-body">
            <form action="{{url('/adminpanel/deleteid/postjob')}}" method="post">
      {{csrf_field()}}
      
              <table id="example1" class="table table-bordered table-striped dataTable">

                <thead>
                <tr>
                <th> <button type="submit" class="btn btn-primary"> <i class="fa fa-trash"></i></button>
                  </th>
                  <th >ID</th>
                  <th >Job Name</th>
                  <th>User Id</th>
                  <th>Job Id</th>
                  <th>Job For</th>
                  <th>Added By</th>
                  <th>Created At</th>
               
                </tr>
                </thead>
                <tbody>
           
               
                @foreach($posts as $userinfo)
                <tr>
                <td><input type="checkbox" name=delid[] value="{{$userinfo->id}}"></td>
                	<td>{{$userinfo->id}}</td>
                  <td style="width:20%;">{{$userinfo->job->name}}</td>
                  <td>{{$userinfo->created_by}}</td>
                  <td>{{$userinfo->job_id}}</td>
                  <td>{{$userinfo->job_for}}</td>
            
                  <td>{{$userinfo->created_at}}</td>
               
              
                    </tr>
                    @endforeach
           
                </tbody>
                <tfoot>
            
     

                </tfoot>

              </table>
              </form>
           
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
          <!-- /.box -->
        </div>
        <!-- /.col -->

      <!-- /.row -->
    </section>
    
     @endsection