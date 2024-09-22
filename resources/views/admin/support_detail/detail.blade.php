@extends('admin.layout.layout')
@section('title','Support Details')
@section('content')

  <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin 
            <small>Child Emergency Plan</small>
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
                  <h3 class="box-title">Support Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Child Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Pereson</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->person}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Relation to child</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->relation_to_child}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Add Address</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
           {{$order[0]->address}}
         
           </div>    
           </div>
  
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Phone No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->phone_no}}</div>    
          </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Email</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->email}}</div>    
          </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Notes</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->notes}}</div>    
           </div>


           </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

@endsection



      