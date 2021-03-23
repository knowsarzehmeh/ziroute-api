



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
         <a href="adddrivers" class="btn btn-sm btn-default pull-right">Add New</a>
            
            -->
              <table class="table table-hover">


               
                <tr>
                    <th>Firstname</th>   
  <th>Lastname</th>   
  <th>Address</th>   
  <th>Licence no</th>   
  <th>License photo</th>   
  <th>Expiration date</th>   
  <th>Phone number</th>   
  <th>Age</th>   
  <th>State of origin</th>   
  <th>Qualification</th>   
    <th>Action</th>
                </tr>

    @foreach ($alldrivers as $alldrivers_col )
        
  

                <tr>
                   <td>{{$alldrivers_col->firstname}}</td>  
<td>{{$alldrivers_col->lastname}}</td>  
<td>{{$alldrivers_col->address}}</td>  
<td>{{$alldrivers_col->licenceno}}</td>  
<td><img src="{{asset('img/uploads')}}/{{$alldrivers_col->license_photo}}" class="img-responsive img-circle" style="height:40px;" /></td> 



 <td>{{$alldrivers_col->license_expiration_date}}</td>  
<td>{{$alldrivers_col->phonenumber}}</td>  
<td>{{$alldrivers_col->age}}</td>  
<td>{{$alldrivers_col->state_of_origin}}</td>  
<td>{{$alldrivers_col->qualification}}</td>  



                  <td>
                       <button  data-toggle="modal" data-target="#modal-default_view{{$alldrivers_col->id}}" class="btn btn-sm btn-default">
                       <i class="glyphicon glyphicon-eye-open"></i> </button>
               
                    <button  data-toggle="modal" data-target="#modal-default{{$alldrivers_col->id}}" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-edit"></i> </button>
                  
                      <form style="display:inline;" action="{{ route('user.deletedrivers')}}" method="post" onsubmit="return validate(this);">
                                        {{csrf_field()}}
                                        <input type="hidden" name="drivers_id" value="{{$alldrivers_col->id}}" />
                                        <button type="submit" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i></button>
                                        </form>
  
 
     <div class="modal fade" id="modal-default{{$alldrivers_col->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit</h4>
              </div>
              <div class="modal-body">


     <form action="{{route('action.updatedrivers')}}" role="form" method="post"   enctype="multipart/form-data">
              <div class="box-body">
 
        <input type="hidden" name="drivers_id" value="{{$alldrivers_col->id}}" />

                {{csrf_field()}}

         
                <div class="form-group col-md-6">
                  <label for="f11">Firstname</label>
                  <input type="text" class="form-control" id="f111" name="firstname" value="{{$alldrivers_col->firstname}}" >
                </div>
                <div class="form-group col-md-6">
                  <label for="f12">Lastname</label>
                  <input type="text" class="form-control" id="f112" name="lastname" value="{{$alldrivers_col->lastname}}" >
                </div>
                <div class="form-group col-md-6">
                  <label for="f13">Address</label>
                  <input type="text" class="form-control" id="f113" name="address" value="{{$alldrivers_col->address}}" >
                </div>
                <div class="form-group col-md-6">
                  <label for="f14">Licenceno</label>
                  <input type="text" class="form-control" id="f114" name="licenceno" value="{{$alldrivers_col->licenceno}}" >
                </div><div class="form-group col-md-6">
                <img id="pre{{$alldrivers_col->id}}" src="{{asset('img/uploads')}}/{{$alldrivers_col->license_photo}}" class="img-responsive img-circle" style="height:40px;"/>
                  <label for="f3drivers">File input</label>
                  <input type="file" name="license_photo" onchange="prev({{$alldrivers_col->id}})" id="drivers">
                  <input type="hidden" name="license_photo_update" value="{{$alldrivers_col->license_photo}}" />
                  <p class="help-block">Drivers</p>
                </div>
                	
                <div class="form-group col-md-6">
                  <label for="f16">License_expiration_date</label>
                  <input type="text" class="form-control" id="f116" name="license_expiration_date" value="{{$alldrivers_col->license_expiration_date}}" >
                </div>
                <div class="form-group col-md-6">
                  <label for="f17">Phonenumber</label>
                  <input type="text" class="form-control" id="f117" name="phonenumber" value="{{$alldrivers_col->phonenumber}}" >
                </div>
                <div class="form-group col-md-6">
                  <label for="f18">Age</label>
                  <input type="text" class="form-control" id="f118" name="age" value="{{$alldrivers_col->age}}" >
                </div>
                <div class="form-group col-md-6">
                  <label for="f19">State_of_origin</label>
                  <input type="text" class="form-control" id="f119" name="state_of_origin" value="{{$alldrivers_col->state_of_origin}}" >
                </div>
                <div class="form-group col-md-6">
                  <label for="f110">Qualification</label>
                  <input type="text" class="form-control" id="f1110" name="qualification" value="{{$alldrivers_col->qualification}}" >
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
              
              
              
              
               <div class="modal fade" id="modal-default_view{{$alldrivers_col->id}}">
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
<th> Firstname: </th>   

<td> 
 {{$alldrivers_col->firstname}}

 </td>

</tr>

 
<tr>
<th> Lastname: </th>   

<td> 
 {{$alldrivers_col->lastname}}

 </td>

</tr>

 
<tr>
<th> Address: </th>   

<td> 
 {{$alldrivers_col->address}}

 </td>

</tr>

 
<tr>
<th> Licenceno: </th>   

<td> 
 {{$alldrivers_col->licenceno}}

 </td>

</tr>

 
<tr>
<th> License_photo: </th> 


<td> 
<img src="{{asset('img/uploads')}}/{{$alldrivers_col->license_photo}}" class="img-responsive" style="height:100px;"/>

 </td>

</tr>

 
<tr>
<th> License_expiration_date: </th>   

<td> 
 {{$alldrivers_col->license_expiration_date}}

 </td>

</tr>

 
<tr>
<th> Phonenumber: </th>   

<td> 
 {{$alldrivers_col->phonenumber}}

 </td>

</tr>

 
<tr>
<th> Age: </th>   

<td> 
 {{$alldrivers_col->age}}

 </td>

</tr>

 
<tr>
<th> State_of_origin: </th>   

<td> 
 {{$alldrivers_col->state_of_origin}}

 </td>

</tr>

 
<tr>
<th> Qualification: </th>   

<td> 
 {{$alldrivers_col->qualification}}

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
    {!! $alldrivers->render() !!}
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



	    