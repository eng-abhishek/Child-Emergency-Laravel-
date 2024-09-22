@extends('admin.layout.layout')
@section('title','School Detail Level One')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           School Detail Level One Management
            <small>Child Emergency Plan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">School Detail Level One</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">School Detail Level One Management</h3>
                 <a href="{{url('add-school-detail-level-one')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add School Detail</button></a> 
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Child Name</th>                  
                        <th>School Name</th>
                        <th>School Address</th>
                        <th>Offic Phone</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Principal Name</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                   @foreach($allUser as $key => $orderDetails)
                   <tr>
                   <td>{{$key + 1}}</td>
                   <td>{{$orderDetails->name}}</td>
                   <td>{{$orderDetails->school_name}}</td> 
                   <td>
                   {{$orderDetails->school_addreass}}
                    </td>
                    <td>{{$orderDetails->office_phone}}</td>
                    <td>{{$orderDetails->start_time}}</td>
                    <td>{{$orderDetails->end_time}}</td>
                    <td>{{$orderDetails->principal_name}}</td>
                    
<td>                  
                        <a href="{{url("update-school-detail-level-one/$orderDetails->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{url("delete-school-detail-level-one/$orderDetails->id")}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i></a>
                        <a href="{{url("detail-school-detail-level-one/$orderDetails->id")}}" class="btn btn-success"><i class="fa fa-eye"></i></a>                
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
