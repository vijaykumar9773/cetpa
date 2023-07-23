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
            <h1>Manage Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Users</li>
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
            @if (count($errors) > 0)
              <div class="alert alert-danger">
                <ul class='text'>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            @if(Session::has('success'))
              <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('success') }}
              </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <a href="{{url('admin/users/create')}}" class="btn btn-success right" style="float:right;"><i class="fa fa-plus" aria-hidden="true"></i> Add User</a>
                </div>
                
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(!empty($userList))
                        @php ($i=1) @endphp
                        @foreach($userList as $user)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <label class="switch" onchange="changeStatus('{{$user->id}}')">
                                    <input  type="checkbox" id="status_{{$user->id}}" @if($user->status == 1) checked @endif>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{url('admin/users/'.$user->id.'/edit')}}" title="Edit" class="btn btn-success mr-2"><i class="fa fa-edit"></i></a>
                                <a href="{{url('admin/users/'.$user->id)}}" title="View User Detail" class="btn btn-primary mr-2"><i class="fa fa-eye"></i></a>

                                <a href="javascript:deleteUser({{$user->id}})" title="Delete" class="btn btn-danger mr-2"><i class="fa fa-trash"></i></a>
                                <form method="post" id="delete_user_from_{{$user->id}}" action="{{url('admin/users/'.$user->id)}}">
                                  <input type="hidden" name="_method" value="DELETE">
                                  @CSRF
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
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