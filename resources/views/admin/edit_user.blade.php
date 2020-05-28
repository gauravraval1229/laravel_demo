@include('../includes.header')
@include('../includes.sidebar')

<style type="text/css">
.firstLetterCapital{
  text-transform: capitalize;
}
.error{
  color:red;
}
</style>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit User</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div><!-- /.content-header -->

<div class="container-fluid">

  <?php 
    //echo "<pre>";
    //print_r($userDetails);
    //exit();
  ?>
  <section class="content">
    <div class="container-fluid"><!-- /.container-fluid -->
      <div class="row"><!-- /.row -->
        <div class="col-md-3"></div>
        <div class="col-md-6"><!--/.col -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit User</h3>
            </div>
            <div class="card-body">

              <!-- frame data found using selected id -->
              <?php if(isset($userDetails) && !empty($userDetails)) { ?>

                @foreach (['danger', 'warning', 'success', 'info'] as $key)
                 @if(Session::has($key))
                     <p class="alert alert-{{ $key }} toastClass">{{ Session::get($key) }}</p>
                 @endif
                @endforeach

                {{ Form::open(array("url" => "update-user", "method" => "post", "enctype" => "multipart/form-data")) }}
                @csrf 

                  {{ Form::hidden('userId',$userDetails->id) }}
                  {{ Form::hidden('oldImageName',$userDetails->profile_image) }}

                  <div class="form-group">
                    <label for="exampleInputPassword1">{{ Form::label('name') }}</label>
                    {{ Form::text('name',$userDetails->name, ['class' => 'form-control firstLetterCapital','readonly' => 'true']) }}
                    @error('name')
                      <span style="color:red" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">{{ Form::label('E-Mail Address') }}</label>
                    {{ Form::email('email',$userDetails->email, ['class' => 'form-control','readonly' => 'true']) }}
                    @error('email')
                      <span style="color:red" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">{{ Form::label('Gender') }}</label><br/>

                    <?php
                      if($userDetails->gender == "male") {
                        echo Form::radio('gender','male', true)." Male ";
                        echo Form::radio('gender','female')." Female ";
                      }
                      else if($userDetails->gender == "female") {
                        echo Form::radio('gender','male')." Male ";
                        echo Form::radio('gender','female', true)." Female ";
                      }
                    ?>
                    
                    @error('gender')
                      <span style="color:red" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">{{ Form::label('Designation') }}</label><br/>

                    <?php 
                      
                      $designationMeta = $userDetails->designation_meta;

                      foreach ($designationMeta as $key => $value) { // array of user selected designation
                        $designationName[] = $designationMeta[$key]->designation->designation_name;
                      }

                      foreach ($allDesignations as $allDesignations) { // all designation array

                        $checked = false;
                        if(in_array($allDesignations->designation_name, $designationName)){ // if user selected designation is matched then display checked checkbox
                          $checked = true;
                        }

                        echo Form::checkbox('designation[]', $allDesignations->id,$checked);
                        echo " ".ucfirst(trim($allDesignations->designation_name))." ";
                      }
                    ?>
                    
                    @error('designation')
                      <span style="color:red" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">{{ Form::label('Country') }}</label>
                    {{ Form::select('country', array('' => 'Select Country', 'india' => 'India', 'usa' => 'USA'),$userDetails->country,['class' => 'form-control']) }}
                    @error('country')
                      <span style="color:red" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">{{ Form::label('Profile Image') }}</label><br/>
                    <?php 
                      $displayImage = config('constants.srcDefaultImage');

                      if(file_exists(config('constants.publicProfile').'/'.$userDetails->id.'/'.$userDetails->profile_image)) { //image exist in folder
                        $displayImage = config('constants.srcProfile').'/'.$userDetails->id.'/'.$userDetails->profile_image;
                      }
                    ?>
                    <div class="text-center">
                      <img class="avatar-lgbig img-thumbnail" onclick="showImage(this)" src="<?php echo $displayImage; ?>" title="View Image" style="cursor: pointer;" height="70%" width="80%">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">{{ Form::label('Change Profile Image') }}</label>
                    {{ Form::file('profileImage',['class' => 'form-control']) }}
                    @error('profileImage')
                      <span style="color:red" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  {{Form::submit('Submit',['class' => 'btn btn-primary']) }}

                {{ Form::close() }}

              <?php } else { echo "<p> No data found </p>"; } ?>

            </div>
          </div><!-- /.card -->
        </div><!--/.col -->
        <div class="col-md-3"></div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  
  <!-- Display image in model strat -->
    <div class="modal" id="imageModel" role="dialog" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          
          <div class="modal-header">
            <h4 class="modal-title">View Image</h4>
          </div>
          
          <div class="modal-body">
            <center>
              <img src="" id="imgModel" height="80%" width="80%">
            </center>
          </div>
        
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>
        
        </div>
      </div>
    </div>
  <!-- Display image in model strat -->

</div><!--/. container-fluid -->

@include('../includes.footer')

<script type="text/javascript">
  function showImage(ele){
    $("#imgModel").attr("src","");
    $("#imgModel").attr("src",ele.src);
    $("#imageModel").modal('show');
  }
</script>