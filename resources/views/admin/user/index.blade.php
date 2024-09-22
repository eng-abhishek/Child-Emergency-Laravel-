@extends('admin.layout.layout')
@section('title','User')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           User Management
            <small>Child Emergency Plan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">User</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">User Management</h3>
                 <a href="{{url('add-user')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add User</button></a> 
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Name</th>                  
                        <th>Contact No</th>
                        <th>Email Id</th>
                        <th>Image</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                   @foreach($allUser as $key => $orderDetails)
                   <tr>
                   <td>{{$key + 1}}</td>
                   <td>{{$orderDetails->name}}</td>
                   <td>{{$orderDetails->mobile_no}}</td> 
                   <td>
                   {{$orderDetails->email}}
                    </td>
                    <td>
                    @if($orderDetails->image)
<img src="{{$orderDetails->image}}" width="50px">                   
                    @else
<img src="{{asset('assets/image/default_user.png')}}" width="50px">
                    @endif 
                    </td>
<td>                  
                        <a href="{{url("update-user/$orderDetails->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{url("delete-user/$orderDetails->id")}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i></a>                
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
