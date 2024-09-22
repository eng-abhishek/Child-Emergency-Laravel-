@extends('admin.layout.layout')
@section('title','Care Provider')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Care Provider Management
            <small>Child Emergency Plan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Care Provider</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Care Provider Management</h3>
                 <a href="{{url('add-care-provider')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add Care Provider</button></a> 
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Child Name</th>                  
                        <th>Care Provider Name</th>
                        <th>Child Care Center</th>
                       
                        <th>Phone No</th>
                        <th>Address</th>
                        <th>Note</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                   @foreach($allUser as $key => $orderDetails)
                   <tr>
                   <td>{{$key + 1}}</td>
                   <td>{{$orderDetails->name}}</td>
                   <td>{{$orderDetails->child_care_provider_name}}</td> 
                   <td>
                   {{$orderDetails->name_of_child_care_center}}
                    </td>
                    <td>{{$orderDetails->phone_no}}</td>
                    <td>{{$orderDetails->address}}</td>
                    <td>{{substr($orderDetails->notes,0,50)}}</td>
<td>                  
                        <a href="{{url("update-care-provider/$orderDetails->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{url("delete-care-provider/$orderDetails->id")}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i></a>
                        <a href="{{url("detail-care-provider/$orderDetails->id")}}" class="btn btn-success"><i class="fa fa-eye"></i></a>                
</td>

                     </tr>
                      @endforeach
                    </tbody>                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
