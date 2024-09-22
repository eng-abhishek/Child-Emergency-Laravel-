@extends('admin.layout.layout')
@section('title','Insurance Details')
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
                  <h3 class="box-title">Insurance Detail</h3>
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
           <div class="col-sm-4 detailsBlod">Type of insurance</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->type_of_insurance}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Insurance company name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->insurance_cmp_name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Plan type</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
           {{$order[0]->plan_type}}
           </div>    
           </div>
  
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Subscribe</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->subscribe}}</div>    
          </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Member No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->member_no}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Group No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->group_no}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Agent</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->agent}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Phone No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->phone_no}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Website</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><a href="{{$order[0]->website}}" target="_blank">{{$order[0]->website}}</a></div></div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Co-pay deductible</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->co_pay_deductible}}</div>
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



      