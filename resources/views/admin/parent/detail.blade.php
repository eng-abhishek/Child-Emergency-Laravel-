@extends('admin.layout.layout')
@section('title','Sales Man Details')
@section('content')

  <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin 
            <small>Transair</small>
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
                  <h3 class="box-title">Sales Man Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Email</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->email}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Contact No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->contact_no}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Image</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
           <img src='{{asset("uploads/sales/".$order[0]->img)}}' width="150px" class="thumbnail"> 
           </div>    
           </div>
  
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Address</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->address}}</div>    
          </div>
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Zip Code</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->zip_code}}</div>    
           </div>
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Country</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->country}}</div>    
           </div>

           </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

@endsection



      