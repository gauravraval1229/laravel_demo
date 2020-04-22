@include('includes.header')
@include('includes.sidebar')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /.content-header -->

<div class="container-fluid">
 
    <!-- Info boxes start -->
      <div class="row">
        <div class="col-12 col-sm-3 col-md-3"></div>
        <div class="col-12 col-sm-3 col-md-3">
          <a href="#">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-gear"></i></span>
              <div class="info-box-content">
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-3 col-md-3"></div>
      </div>
    <!-- Info boxes end -->

</div><!--/. container-fluid -->

@include('includes.footer')