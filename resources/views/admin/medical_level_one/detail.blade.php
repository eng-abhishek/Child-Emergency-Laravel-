@extends('admin.layout.layout')
@section('title','Medical')
@section('content')

  <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin 
            <small>Medical</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Detail</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
    <!--       <div class="col-md-1"></div> -->
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Medical Level One Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Child Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->name}}</div>    
           </div>

            <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4" style="font-size:18px;font-style:bold;padding-top:25px">Medical Allergic</div>
           <div class="col-sm-2"></div>  
           <div class="col-sm-5"></div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Allerigic To</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->allergic_to}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Standared Reaction</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->standard_reaction}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Medication Prescribed</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->medical_prescribed}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4" style="font-size:18px;font-style:bold;padding-top:25px">
           Medical Providers</div>
           <div class="col-sm-2"></div>  
           <div class="col-sm-5"></div>    
           </div>

  
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Type/Occupation</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->pr_occupation}}</div>    
          </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->pr_name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Contact No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->pr_contact_no}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Website</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->pr_website}}</div>    
           </div>
           
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Notes</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order->pr_notes}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4" style="font-size:18px;font-style:bold;padding-top:25px">
           Immunization</div>
           <div class="col-sm-2"></div>  
           <div class="col-sm-5"></div>    
           </div>




           </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

@endsection



      