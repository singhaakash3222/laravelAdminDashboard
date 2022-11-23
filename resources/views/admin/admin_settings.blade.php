@extends('layouts.admin_layout.admin_layout')
  @section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Admin Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(Session::has('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top:10px;">
                      {{ Session::get('error_message') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
              @endif
              @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
                      {{ Session::get('success_message') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
              @endif
              
              <form role="form" method="post" action="{{ url('/admin/update-current-pwd') }}" name="updatePasswordForm" id="updatePasswordForm">@csrf
                <div class="card-body">
                <!-- <div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" class="form-control" value="{{ $adminDetails->name; }}" placeholder="Enter Your Name" name="admin_name" id="admin_name">
                  </div> -->
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" value="{{ $adminDetails->email; }}" readonly="" name="admin_email" id="admin_email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Type</label>
                    <input type="text" class="form-control" value="{{ $adminDetails->type; }}" readonly="" >
                  </div>
                  <div class="form-group">
                    <label for="currentPassword">Current Password</label>
                    <input type="password" class="form-control" placeholder="Enter Current Password" name="current_pwd" id="current_pwd" required="">
                    <span id="chkCurrentPwd"></span>
                  </div>
                  <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password" name="new_pwd" class="form-control" id="new_pwd" placeholder="Enter New Password" required="">
                  </div>
                  <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" name="confirm_pwd" class="form-control" id="confirm_pwd" placeholder="Enter Confirm Password" required="">
                  </div>
                  
                 
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          

          

          </div>
          <!--/.col (left) -->
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
  @endsection