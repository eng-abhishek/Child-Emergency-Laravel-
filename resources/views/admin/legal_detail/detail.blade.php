@extends('admin.layout.layout')
@section('title','Legal Details')
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
                  <h3 class="box-title">Legal Detail</h3>
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
           <div class="col-sm-4 detailsBlod">POA Representative`s Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->poa_representative_name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">For Which Child</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->for_which_child}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Attach POA File</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><p><a target="_blank" href="{{$order[0]->attach_poa_file}}">Click to view</a></p>
           </div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Standby Gurdian`s Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->standby_guardian_name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Alternate Standby Gurdian`s Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->standby_alternet_guardian_name}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">For which Child(ren)</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->standby_for_which_child}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Attach GUA File</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><p><a target="_blank" href="{{$order[0]->standby_attach_gua_file}}">Click to view</a></p></div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Has paternity been established ?</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->standby_has_paternity_been_established}}</div></div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Is there currently a custody order in place ?</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->is_there_currently_a_custody_order_in_place}}</div></div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">What are the current custody arrangements ?</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->what_are_the_current_custody_arrangements}}</div></div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Is there a current or active custody case ?</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->is_there_a_current_active_custody_case}}</div></div>
      
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Case or docket number ?</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->case_or_docket_number}}</div>
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



      