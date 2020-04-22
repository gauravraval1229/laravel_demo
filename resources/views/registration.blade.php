<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css') }}"/>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">
    .firstLetterCapital{
      text-transform: capitalize;
    }
  </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      {{ Form::open(array('url' => 'registration-form', 'method' => 'post')) }}
        <div class="form-group has-feedback">
          {{ Form::label('E-Mail Address') }}
          {{ Form::email('email',null, ['class' => 'form-control']) }}
            @error('email')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group has-feedback">
          {{ Form::label('Password') }}
          {{ Form::password('password',['class' => 'form-control']) }}
            @error('password')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group has-feedback firstLetterCapital">
          {{ Form::label('Gender') }}<br>
          {{ Form::radio('c', 'male') }}male
          {{ Form::radio('gender', 'female') }}female
            @error('gender')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group has-feedback firstLetterCapital">
          {{ Form::label('Designation') }}<br>
          {{ Form::checkbox('designation', 'designer') }}designer
          {{ Form::checkbox('designation', 'developer') }}developer
          {{ Form::checkbox('designation', 'tester') }}tester
            @error('designation')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group has-feedback">
          {{ Form::label('Select Country') }}
          {{ Form::select('country', array('' => 'Select Country', 'india' => 'India', 'usa' => 'USA'),null,['class' => 'form-control']) }}
            @error('country')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group has-feedback">
          {{ Form::label('Profile Image') }}
          {{ Form::file('profileImage',['class' => 'form-control']) }}
            @error('profileImage')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="row">
          <div class="col-4">
            {{Form::submit('Register',['class' => 'btn btn-primary btn-block btn-flat']) }}
          </div>
          <!-- /.col -->
        </div>
      {{ Form::close() }}
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<script type="text/javascript" src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>
