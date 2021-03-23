



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
            <form action="{{route('action.addvehicles')}}" role="form" method="post"   enctype="multipart/form-data">
              <div class="box-body">


 
                <div class="form-group col-md-6">
                  <label for="f11">By_driver_id</label>
                  <input type="text" class="form-control" id="f111" name="by_driver_id" value="{{old('by_driver_id')}}" placeholder="Enter By_driver_id">
                </div> 
                <div class="form-group col-md-6">
                  <label for="f12">Model</label>
                  <input type="text" class="form-control" id="f112" name="model" value="{{old('model')}}" placeholder="Enter Model">
                </div> 
                <div class="form-group col-md-6">
                  <label for="f13">Year</label>
                  <input type="text" class="form-control" id="f113" name="year" value="{{old('year')}}" placeholder="Enter Year">
                </div> 
                <div class="form-group col-md-6">
                  <label for="f14">License_plate</label>
                  <input type="text" class="form-control" id="f114" name="license_plate" value="{{old('license_plate')}}" placeholder="Enter License_plate">
                </div> 
                <div class="form-group col-md-6">
                  <label for="f15">Color</label>
                  <input type="text" class="form-control" id="f115" name="color" value="{{old('color')}}" placeholder="Enter Color">
                </div> 
                <div class="form-group col-md-6">
                  <label for="f16">Booking_type</label>
                  <input type="text" class="form-control" id="f116" name="booking_type" value="{{old('booking_type')}}" placeholder="Enter Booking_type">
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



	    