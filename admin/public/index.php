<?php 
  session_start();
  unset( $_SESSION['user'] );
?>

<!DOCTYPE html>
<html ng-app="loginApp" ng-controller="mainCtrl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Electroligh| Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="lib/AdminLTE.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Importaciones angularjs -->
    <script src="angular/lib/angular.min.js"></script>
    <script src="angular/lib/angular-resource.min.js"></script>
    <script src="angular/app.js"></script>
    <!--<script src="angular/servicios/login_service.js"></script>-->


  </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><b>Electrolight</b>Admin</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Iniciar Sesión</p>

        <form name="loginForm" ng-submit="login( datos )">

          <div class="form-group has-feedback">
            <input  type="text" 
                    class="form-control" 
                    name="usuario"
                    placeholder="Usuario"
                    required="required"
                    ng-model="datos.codigo">

            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input  type="password" 
                    class="form-control" 
                    name="contrasena"
                    placeholder="Contraseña"
                    required="required"
                    ng-model="datos.contrasena">

            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="row">
            <div class="col-xs-12">
              <button   type="submit" 
                        class="btn btn-primary btn-block btn-flat"
                        ng-disabled="loginForm.$invalid || cargando">Ingresar</button>
            </div><!-- /.col -->
          </div>
      
      <div class="row" ng-show="invalido">
        <div class="col-md-12">
          <br>
          <div class="alert alert-danger">
            <strong>Verificar!</strong>
            {{ mensaje }}
          </div>
        </div>      
      </div>      
  
        </form>


        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
   
    
  </body>
</html>