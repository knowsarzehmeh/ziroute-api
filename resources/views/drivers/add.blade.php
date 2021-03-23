



	    		  @extends('layout.master')


 @section('title')

New 
 @endsection


 @section('content')

<div class="container">
<div class="row">

 

<div class="col-md-11">

  <!-- general form elements -->
          <div class="box box-primary" style="margin-top:6%">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>


    @if(count($errors) >0 )

                            <div class="alert alert-danger">


                        @foreach($errors->all() as $error)

                        <p>{{ $error }}</p>


                        @endforeach
                            </div>

                        @endif


                 @if(Session::has('message'))
      <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>

@endif
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{route('action.adddrivers')}}" role="form" method="post"   enctype="multipart/form-data">
              <div class="box-body">


 
                <div class="form-group col-md-6">
                  <label for="f11">Firstname</label>
                  <input type="text" class="form-control" id="f111" name="firstname" value="{{old('firstname')}}" placeholder="Enter Firstname">
                </div> 
                <div class="form-group col-md-6">
                  <label for="f12">Lastname</label>
                  <input type="text" class="form-control" id="f112" name="lastname" value="{{old('lastname')}}" placeholder="Enter Lastname">
                </div> 
                <div class="form-group col-md-6">
                  <label for="f13">Address</label>
                  <input type="text" class="form-control" id="f113" name="address" value="{{old('address')}}" placeholder="Enter Address">
                </div> 
                <div class="form-group col-md-6">
                  <label for="f14">Licenceno</label>
                  <input type="text" class="form-control" id="f114" name="licenceno" value="{{old('licenceno')}}" placeholder="Enter Licenceno">
                </div> 
                <div class="form-group col-md-6">
                  <label for="f15">License_photo</label>
                  <input type="file" class="form-control" id="f115" name="license_photo" >
                  <p class="help-block">License_photo</p>
                </div>
                <div class="form-group col-md-6">
                  <label for="f16">License_expiration_date</label>
                  <input type="text" class="form-control" id="f116" name="license_expiration_date" value="{{old('license_expiration_date')}}" placeholder="Enter License_expiration_date">
                </div> 
                <div class="form-group col-md-6">
                  <label for="f17">Phonenumber</label>
                  <input type="text" class="form-control" id="f117" name="phonenumber" value="{{old('phonenumber')}}" placeholder="Enter Phonenumber">
                </div> 
                <div class="form-group col-md-6">
                  <label for="f18">Age</label>
                  <input type="text" class="form-control" id="f118" name="age" value="{{old('age')}}" placeholder="Enter Age">
                </div> 
                <div class="form-group col-md-6">
                  <label for="f19">State_of_origin</label>
                  <input type="text" class="form-control" id="f119" name="state_of_origin" value="{{old('state_of_origin')}}" placeholder="Enter State_of_origin">
                </div> 
                <div class="form-group col-md-6">
                  <label for="f110">Qualification</label>
                  <input type="text" class="form-control" id="f1110" name="qualification" value="{{old('qualification')}}" placeholder="Enter Qualification">
                </div> 

                {{csrf_field()}}
              
           
      
       
              </div>
              <!-- /.box-body -->

              <div class="box-footer  clearfix text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
      </div>

<div class="col-md-1"></div>

</div>
</div>


 

 @endsection



	    