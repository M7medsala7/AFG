@extends('Dashboardadmin.layout.layout')
@section('content')

 <section class="content-header" style="background-color:; ">
 <form  role="form" method="POST" action="{{url('/adminpanel/candidates/search')}}" enctype="multipart/form-data">
    
    {{csrf_field()}}

           <div style="margin-left:67%;">
           <input type="text" placeholder="Search.." name="s">
          <button type="submit" style="background-color:#dbc65d;;"><i class="fa fa-search" ></i></button>
          </div>
</form>
      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('/adminpanel/candidates/create')}}"> Add candidates
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="background-color:; ">
      <div class="row">
        <div class="col-xs-12">
         
            <!-- /.box-header -->
            <div class="box-body">
       <form action="{{url('/adminpanel/deleteid/candidates')}}" method="post">
      {{csrf_field()}}
       
              <table id="example2" class="table table-bordered table-striped dataTable"
         >

                <thead>
                <tr>
                <th><button type="submit" class="btn btn-primary" > <i class="fa fa-trash"></i></button>
       </th>
                  <th>ID</th>
                  <th>User Id</th>
                  <th>User Name</th>
                  <th>Description</th>
                  <th>Visa Type</th>
                  <th>Created At</th>
                   <th>Controlling</th>
                </tr>
        
                </thead>
                <tbody>
           
               
                @foreach($candidates as $userinfo)
                <tr>
                <td><input type="checkbox" name=delid[] value="{{$userinfo->id}}"></td>
                	<td>{{$userinfo->id}}</td>
                  <td>{{$userinfo->user_id}}</td>
                  <td style="width:10%;">{{$userinfo->user->name}} {{$userinfo->last_name}}</td>
                  <td style="width:25%;">{{$userinfo->descripe_yourself}}</td>
                  <td>{{$userinfo->visa_type}}</td>
                  <td>{{$userinfo->created_at}}</td>
               
               


                <td>
                	<a href="{{url('/adminpanel/candidate/'.$userinfo->id.'/edit')}}" class="btn btn-primary"> Edit </a>
               
                </td>
                    </tr>
                    @endforeach
           
                </tbody>
                <tfoot>
                {{ $candidates->links() }}
              
           
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
     <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>