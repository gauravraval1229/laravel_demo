@include('../includes.header')
@include('../includes.sidebar')
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Users List</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content"><!-- /.content -->
  <div class="row"><!-- /.row -->
    <div class="col-12"><!-- /.col -->
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body" style="overflow: scroll;">
          @foreach (['danger', 'warning', 'success', 'info'] as $key)
            @if(Session::has($key))
              <p class="alert alert-{{ $key }} toastClass">{{ Session::get($key) }}</p>
            @endif
          @endforeach
          <table id="myTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if(isset($userDetails) && !empty($userDetails)) {
                $i=1;
                foreach ($userDetails as $key => $value) {

                  $userId = $userDetails[$key]->id;
                  $status = "Inactive";

                  if($userDetails[$key]->status == "1"){
                    $status = "Active";
                  }
                ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo ucfirst($userDetails[$key]->name); ?></td>
                    <td><?php echo $userDetails[$key]->email; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><a href ="{{ url('admin/edit-user')}}\{{ $userId }}">Edit</a></td>
                    <td><a href ="{{ url('admin/delete-user')}}\{{ $userId }}">Delete</a></td>
                  </tr>
              <?php } } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div><!-- /.card -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

@include('../includes.footer') 

<script type="text/javascript" src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    $('#myTable').DataTable();
  });
</script>