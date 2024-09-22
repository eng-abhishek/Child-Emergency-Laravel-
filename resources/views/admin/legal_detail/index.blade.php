@extends('admin.layout.layout')
@section('title','Legal Detail')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Legal Detail Management
            <small>Child Emergency Plan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Legal Detail</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Legal Detail Management</h3>
                 <a href="{{url('add-legal-details')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add Legal Detail</button></a> 
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Child Name</th>                  
                        <th>POA Representative`s Name</th>
                        <th>For Which Child</th>
                       
                        <th>Standby Gurdian`s Name</th>
                        <th>Alternate Standby Gurdian`s Name</th>
                   
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                   @foreach($allUser as $key => $orderDetails)
                   <tr>
                   <td>{{$key + 1}}</td>
                   <td>{{$orderDetails->name}}</td>
                   <td>{{$orderDetails->poa_representative_name}}</td> 
                   <td>{{$orderDetails->for_which_child}}</td>
                    <td>{{$orderDetails->standby_guardian_name}}</td>
                    <td>{{$orderDetails->standby_alternet_guardian_name}}</td>
<td>                  
                        <a href="{{url("update-legal-details/$orderDetails->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{url("delete-legal-details/$orderDetails->id")}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i></a>
                        <a href="{{url("detail-legal-details/$orderDetails->id")}}" class="btn btn-success"><i class="fa fa-eye"></i></a>                
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
