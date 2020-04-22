<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Demo</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Favicons -->
  <link rel="shortcut icon" type="image/x-icon">
  <!-- Css -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css') }}"/>

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper"> <!-- end in footer.php -->
    
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">LogOut</a> 
        </li>
      </ul>
    </nav>