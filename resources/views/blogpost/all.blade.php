



	    		  @extends('layout.master')


 @section('title')

New 
 @endsection


 @section('content')

 



 <div class="box">
            <div class="box-header">

                    @if(Session::has('message'))
      <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>

@endif
         <div class="box-body table-responsive no-padding">

         <a href="addblogpost" class="btn btn-sm btn-default pull-right">Add New</a>
              <table class="table table-hover">
               
               
                <tr>
                    <th>Title</th>   
  <th>Content</th>   
  <th>Photo</th>   
  <th>Category</th>   
 
                                    <th>Action</th>
                </tr>

    @foreach ($allblogpost as $allblogpost_col )
        
  

                <tr>
                   <td>{{$allblogpost_col->title}}</td>  
<td>{{ substr($allblogpost_col->content,0,160)}}</td> 
<td><img src="{{asset('img/uploads')}}/{{$allblogpost_col->photo}}" class="img-responsive img-circle" style="height:40px;" /></td> 



 <td>{{$allblogpost_col->category}}</td>  



                  <td>
                       <button  data-toggle="modal" data-target="#modal-default_view{{$allblogpost_col->id}}" class="btn btn-sm btn-default">
                       <i class="glyphicon glyphicon-eye-open"></i> </button>
               
                    <button  data-toggle="modal" data-target="#modal-default{{$allblogpost_col->id}}" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-edit"></i> </button>
                  
                      <form style="display:inline;" action="{{ route('user.deleteblogpost')}}" method="post" onsubmit="return validate(this);">
                                        {{csrf_field()}}
                                        <input type="hidden" name="blogpost_id" value="{{$allblogpost_col->id}}" />
                                        <button type="submit" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i></button>
                                        </form>
  
 
     <div class="modal fade" id="modal-default{{$allblogpost_col->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit</h4>
              </div>
              <div class="modal-body">


     <form action="{{route('action.updateblogpost')}}" role="form" method="post"   enctype="multipart/form-data">
              <div class="box-body">
 
        <input type="hidden" name="blogpost_id" value="{{$allblogpost_col->id}}" />

                {{csrf_field()}}

         
                <div class="form-group col-md-6">
                  <label for="f11">Title</label>
                  <input type="text" class="form-control" id="f111" name="title" value="{{$allblogpost_col->title}}" >
                </div>
                <div class="form-group col-md-6">
                  <label for="f12">Content</label>
                  <textarea class="form-control" id="f112" name="content" >{{$allblogpost_col->content}}</textarea>
                  <p class="help-block">Content</p>
                </div><div class="form-group col-md-6">
                <img id="pre{{$allblogpost_col->id}}" src="{{asset('img/uploads')}}/{{$allblogpost_col->photo}}" class="img-responsive img-circle" style="height:40px;"/>
                  <label for="f3blogpost">File input</label>
                  <input type="file" name="photo" onchange="prev({{$allblogpost_col->id}})" id="blogpost">
                  <input type="hidden" name="photo_update" value="{{$allblogpost_col->photo}}" />
                  <p class="help-block">Blogpost</p>
                </div>
                	
                <div class="form-group col-md-6">
                  <label for="f14">Category</label>
                  <input type="text" class="form-control" id="f114" name="category" value="{{$allblogpost_col->category}}" >
                </div>
              
       
              </div>
              <!-- /.box-body -->

              <div class="box-footer  clearfix text-center">
               </div>
               
              
              
              
              
              </div>




              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>

                  </form>  
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
              
              
              
              
               <div class="modal fade" id="modal-default_view{{$allblogpost_col->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View</h4>
              </div>
              <div class="modal-body">


               <div class="box-body table-responsive">

<table class="table table-bordered table-condensed table-hover ">
 
 
<tr>
<th> Title: </th>   

<td> 
 {{$allblogpost_col->title}}

 </td>

</tr>

 
<tr>
<th> Content: </th>  

<td> 
 {{$allblogpost_col->content}}

 </td>

</tr>

 
<tr>
<th> Photo: </th> 


<td> 
<img src="{{asset('img/uploads')}}/{{$allblogpost_col->photo}}" class="img-responsive" style="height:100px;"/>

 </td>

</tr>

 
<tr>
<th> Category: </th>   

<td> 
 {{$allblogpost_col->category}}

 </td>

</tr>


 
</table>

              
             
              
               
       
              </div>
              <!-- /.box-body -->

              <div class="box-footer  clearfix text-center">
               </div>
               
              
              
              
              
              </div>




              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
 
               </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
              
              
              
              
              
              
              
                  </td>
                 </tr>
            @endforeach
              </table>
            </div>



            <div class="text-center">
    {!! $allblogpost->render() !!}
            </div>

            </div>
            </div>

 

 @endsection

@section('scripts')
<script>
function validate(form, dis) {

    // validation code here ...

   if(confirm("Do you really want to do this?"))
    dis.submit();
  else
    return false;
 }

 function prev(id)
 {
 
     $("#pre"+id).hide();

 }
</script>
@endsection



	    