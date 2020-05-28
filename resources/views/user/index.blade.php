@include('../includes.header')
@include('../includes.sidebar')
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Welcome</h1>
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
        </div>
        <!-- /.card-body -->
      </div><!-- /.card -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

@include('../includes.footer') 

<script type="text/javascript">
  $(document).ready(function () {
    $('#myTable').DataTable();
  });
</script>