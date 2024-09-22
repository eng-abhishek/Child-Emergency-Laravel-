@extends('admin.layout.layout')
@section('title','About Detail')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           About Detail Management
            <small>Child Emergency Plan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">About Detail</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">About Detail Management</h3>
                 <a href="{{url('add-about-details')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add About Detail</button></a> 
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
                   <td>{{$orderDetails->likes_to_be_called}}</td>
                   <td>{{$orderDetails->personality}}</td> 
                   <td>
                   {{$orderDetails->likes}}
                    </td>
                    <td>{{$orderDetails->dislikes}}</td>
                    <td>{{$orderDetails->favorite_food}}</td>
                    <td>{{$orderDetails->good_at}}</td>
<td>                  
                        <a href="{{url("update-about-details/$orderDetails->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{url("delete-about-details/$orderDetails->id")}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i></a>
                        <a href="{{url("detail-about-details/$orderDetails->id")}}" class="btn btn-success"><i class="fa fa-eye"></i></a> 
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
