@include('backend.head')

<!-- Navbar -->
@include('backend.navbar')
<!-- Navbar -->

<!-- Main Sidebar Container -->
@include('backend.sidebar')
<!-- Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">View User</li>
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
            <div class="card">
                <div class="card-header">
                    <a href="javascript:history.back()" class="btn btn-success right" style="float:right;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">{{_('Name')}} : </label>
                        <span>{{$userDetail->name}}</span>
                    </div>

                    <div class="form-group">
                        <label for="email">{{_('Email')}} : </label>
                        <span>{{$userDetail->email}}</span>
                    </div>

                    <div class="form-group">
                        <label for="email">{{_('Created at')}} : </label>
                        <span>{{$userDetail->created_at}}</span>
                    </div>

                    <div class="form-group">
                        <label for="email">{{_('Updated at')}} : </label>
                        <span>{{$userDetail->updated_at}}</span>
                    </div>
                </div>
              <!-- /.card-body -->
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

@include('backend.footer')

@include('backend.foot')