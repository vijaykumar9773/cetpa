@extends('backend.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@if(isset($userDetail->id)) Edit User @else Create User @endif</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">@if(isset($userDetail->id)) Edit User @else Create User @endif</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <!-- form start -->
              @if(isset($userDetail->id))
                <form method="post" name="edit_user_form" id="edit_user_form" action="{{url('admin/users/'.$userDetail->id)}}">
                <input name="_method" type="hidden" value="PUT">
              @else
                <form method="post" name="add_user_form" id="add_user_form" action="{{url('admin/users')}}">
              @endif  
              <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name<span class="required">*</span> :</label>
                    <input type="text" name="name" id="name" value="{{isset($userDetail->name)?$userDetail->name:''}}" class="form-control" placeholder="Enter name" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email<span class="required">*</span> :</label>
                    <input type="email" name="email" id="email" value="{{isset($userDetail->email)?$userDetail->email:''}}" class="form-control" placeholder="Enter email" autocomplete="off" @if(isset($userDetail->id)) readonly @endif>
                  </div>

                  @if(!isset($userDetail->id))
                  <div class="form-group">
                    <label for="password">Password<span class="required">*</span> :</label>
                    <input type="password" name="password" id="password" class="form-control"  placeholder="Enter password" autocomplete="off" required>
                  </div>
                  @endif

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" id="@if(isset($userDetail->id)){{_('update')}}@else{{_('submit')}}@endif" class="btn btn-primary">
                  @if(isset($userDetail->id))
                    {{_('Update')}}
                  @else
                  {{_('Submit')}}
                  @endif
                  </button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection