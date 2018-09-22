@extends('Dashboardadmin.layout.layout')
@section('content')

 <section class="content-header" style="background-color: ">

      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('/adminpanel/questions')}}"> All Questions</a></li>
      </ol>
 </section>

    <!-- Main content -->
    <section class="content" style="background-color:; ">
      <div class="row">
        <div class="col-xs-12">
         
            <!-- /.box-header -->
            <div class="box-body">
            <form action="{{url('/adminpanel/deleteid/question')}}" method="post">
      {{csrf_field()}}
            <table id="example2" class="table table-bordered table-striped dataTable">

                <thead>
                <tr>
                <th> <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i></button>
                  </th>
                  <th>ID</th>
                  <th > Question</th>
                  <th> Weight</th>
                  <th>PostJob ID</th>
                  <th>Created_at</th>
                   <th>Controlling</th>
                </tr>
                </thead>
                <tbody>
           
               
                @foreach($question as $userinfo)
                <tr>
                <td><input type="checkbox" name=delid[] value="{{$userinfo->id}}"></td>
                	<td>{{$userinfo->id}}</td>
                  <td>{{$userinfo->question}}</td>
                  <td>{{$userinfo->weight}}</td>
                  <td>{{$userinfo->post_job_id}}</td>
                  <td>{{$userinfo->created_at}}</td>
                <td>
               
                	<a href="{{url('/adminpanel/question/'.$userinfo->id.'/edit')}}" class="btn btn-primary"> Edit </a>
                
                </td>
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