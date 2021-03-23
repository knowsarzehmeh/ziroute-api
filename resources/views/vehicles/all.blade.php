



	    		  @extends('layout.master')


 @section('title')

Manage 
 @endsection


 @section('content')

 



 <div class="box">
            <div class="box-header">

                    @if(Session::has('message'))
      <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>

@endif
         <div class="box-body table-responsive no-padding">

<!--
         <a href="addvehicles" class="btn btn-sm btn-default pull-right">Add New</a>
            -->
            
              <table class="table table-hover">
               
               
                <tr>
<!--  <th>By_driver_id</th>   -->
  <th>Model</th>   
  <th>Year</th>   
  <th>License plate</th>   
  <th>Color</th>   
  <th>Booking type</th>   
 
      <th>Action</th>
                </tr>

    @foreach ($allvehicles as $allvehicles_col )
        
  

                <tr>
<!--                   <td>{{$allvehicles_col->by_driver_id}}</td> --> 
<td>{{$allvehicles_col->model}}</td>  
<td>{{$allvehicles_col->year}}</td>  
<td>{{$allvehicles_col->license_plate}}</td>  
<td>{{$allvehicles_col->color}}</td>  
<td>{{$allvehicles_col->booking_type}}</td>  



                  <td>
                       <button  data-toggle="modal" data-target="#modal-default_view{{$allvehicles_col->id}}" class="btn btn-sm btn-default">
                       <i class="glyphicon glyphicon-eye-open"></i> </button>
               
                    <button  data-toggle="modal" data-target="#modal-default{{$allvehicles_col->id}}" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-edit"></i> </button>
                  
                      <form style="display:inline;" action="{{ route('user.deletevehicles')}}" method="post" onsubmit="return validate(this);">
                                        {{csrf_field()}}
                                        <input type="hidden" name="vehicles_id" value="{{$allvehicles_col->id}}" />
                                        <button type="submit" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i></button>
                                        </form>
  
 
     <div class="modal fade" id="modal-default{{$allvehicles_col->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit</h4>
              </div>
              <div class="modal-body">


     <form action="{{route('action.updatevehicles')}}" role="form" method="post"   enctype="multipart/form-data">
              <div class="box-body">
 
        <input type="hidden" name="vehicles_id" value="{{$allvehicles_col->id}}" />

                {{csrf_field()}}

         
                <div class="form-group col-md-6">
                  <label for="f11">By_driver_id</label>
                  <input type="text" class="form-control" id="f111" name="by_driver_id" value="{{$allvehicles_col->by_driver_id}}" >
                </div>
                <div class="form-group col-md-6">
                  <label for="f12">Model</label>
                  <input type="text" class="form-control" id="f112" name="model" value="{{$allvehicles_col->model}}" >
                </div>
                <div class="form-group col-md-6">
                  <label for="f13">Year</label>
                  <input type="text" class="form-control" id="f113" name="year" value="{{$allvehicles_col->year}}" >
                </div>
                <div class="form-group col-md-6">
                  <label for="f14">License_plate</label>
                  <input type="text" class="form-control" id="f114" name="license_plate" value="{{$allvehicles_col->license_plate}}" >
                </div>
                <div class="form-group col-md-6">
                  <label for="f15">Color</label>
                  <input type="text" class="form-control" id="f115" name="color" value="{{$allvehicles_col->color}}" >
                </div>
                <div class="form-group col-md-6">
                  <label for="f16">Booking_type</label>
                  <input type="text" class="form-control" id="f116" name="booking_type" value="{{$allvehicles_col->booking_type}}" >
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
              
              
              
              
               <div class="modal fade" id="modal-default_view{{$allvehicles_col->id}}">
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
<th> By_driver_id: </th>   

<td> 
 {{$allvehicles_col->by_driver_id}}

 </td>

</tr>

 
<tr>
<th> Model: </th>   

<td> 
 {{$allvehicles_col->model}}

 </td>

</tr>

 
<tr>
<th> Year: </th>   

<td> 
 {{$allvehicles_col->year}}

 </td>

</tr>

 
<tr>
<th> License_plate: </th>   

<td> 
 {{$allvehicles_col->license_plate}}

 </td>

</tr>

 
<tr>
<th> Color: </th>   

<td> 
 {{$allvehicles_col->color}}

 </td>

</tr>

 
<tr>
<th> Booking_type: </th>   

<td> 
 {{$allvehicles_col->booking_type}}

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
    {!! $allvehicles->render() !!}
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



	    