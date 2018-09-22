@extends('Dashboardadmin.layout.layout')
@section('content')

 <section class="content-header" style="background-color: ">
 <form  role="form" method="POST" action="{{url('/adminpanel/story/search')}}" enctype="multipart/form-data">
    
    {{csrf_field()}}

           <div style="margin-left:67%;">
           <input type="text" placeholder="Search.." name="s">
          <button type="submit" style="background-color:#dbc65d;;"><i class="fa fa-search" ></i></button>
          </div>
</form>

      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('/adminpanel/employer/create')}}"> Add Employer story </a></li>
      </ol>
 </section>

    <!-- Main content -->
    <section class="content" style="background-color:; ">
      <div class="row">
        <div class="col-xs-12">
         
            <!-- /.box-header -->
            <div class="box-body">
      <form action="{{url('/adminpanel/deleteid/story')}}" method="post">
      {{csrf_field()}}
       
            <table id="example2" class="table table-bordered table-striped dataTable">

                <thead>
                <tr>
                  <th> <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i></button>
                  </th>
                 
                  <th > description</th>
                  <th> user name</th>
                  <th>Created_at</th>
                  <th> Approval</th>
                
                </tr>
                </thead>
                <tbody>
           
               
                @foreach($story as $userinfo)
                <tr>
                <td><input type="checkbox" name=delid[] value="{{$userinfo->id}}"></td>
                  <td>{{$userinfo->description}}</td>
                  <td>{{$userinfo['user']['name']}}</td>
                  <td>{{$userinfo->created_at}}</td>
                  @if($userinfo->approval==1)
                  <td><input type="checkbox" name=approval value="{{$userinfo->approval}}" onclick="Approval(this,{{$userinfo->id}})" checked ></td>
               @else
               <td><input type="checkbox" name=approval value="{{$userinfo->approval}}" onclick="Approval(this,{{$userinfo->id}})"></td>
              @endif
             <td> <a href="{{url('/adminpanel/story/'.$userinfo->id.'/edit')}}" class="btn btn-primary"> Edit </a></td>
                </tr>
                @endforeach
           
                </tbody>
                <tfoot>
                {{ $story->links() }}
              
           
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

     function Approval(e,id){
     var act;
     if(e.value==1)
      act=0;
      else act=1;
      $.ajax({
        url:"/approvalSuccessStories",
        data:{id:id,active:act},
        type:"get",
        success:function(data){}

      });

     }
     </script>