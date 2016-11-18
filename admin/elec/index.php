<?php
		
	session_start();
	if( !isset( $_SESSION['user'] ) ){	
		header( 'Location: ../public' );
		die;
	}

 ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html ng-app="facturacionApp" ng-controller="mainCtrl">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Sistema de {{ config.aplicativo }}</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
					page. However, you can choose any other skin. Make sure you
					apply the skin class to the body tag so the changes take effect.
		-->
		<link rel="stylesheet" href="dist/css/skins/skin-purple.min.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
				<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Estilos Personalizados -->
		<link rel="stylesheet" href="dist/css/animate.css">
		<style>
			.form-group.has-success .form-control{
				border-radius: 0;
    			box-shadow: none;
    			border-color: #d2d6de;
			}
			.form-group.has-success label{
				color: black;
			}
		</style>

		<!-- Importaciones de angular -->
		<script src="angular/lib/angular.min.js"></script>
		<script src="angular/lib/angular-route.min.js"></script>
		<script src="angular/lib/jcs-auto-validate.min.js"></script>

		<script src="https://code.angularjs.org/1.5.8/angular-resource.min.js"></script>

		<!-- Angularjs File -->
		<script src="angular/lib/ng-file-upload-shim.min.js"></script>
		<script src="angular/lib/ng-file-upload.min.js"></script>
		

		<!-- Controladores -->
		<script src="angular/app.js"></script>
<!--		<script src="angular/controladores/dashboardCtrl.js"></script>-->
		<!--<script src="angular/controladores/promocionesCtrl.js"></script>-->

		<script src="angular/controller.js"></script>		
		<script src="angular/factory.js"></script>		


		<!-- servicios -->
		<!--<script src="angular/servicios/configuracion_service.js"></script>-->
		<!--<script src="angular/servicios/mensajes_service.js"></script>-->
		<!--<script src="angular/servicios/notificaciones_service.js"></script>-->
		<!--<script src="angular/servicios/promociones_service.js"></script>-->

	</head>
 


	<body class="hold-transition skin-purple sidebar-mini">
		<div class="wrapper">

			<!-- Main Header -->
			<header class="main-header">

				<!-- Logo -->
				<a href="index2.html" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>{{ config.iniciales[0] }}</b>{{ config.iniciales | quitarletra }}</span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b> {{ config.aplicativo }} </b>{{ config.iniciales }}</span>
				</a>

				<!-- Header Navbar -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">

							<!-- Messages: style can be found in dropdown.less-->
							<!--<li class="dropdown messages-menu"
									ng-include="'template/mensajes.html'">
							</li>
							<!-- /.messages-menu -->

							<!-- Notifications Menu -->
							<!--<li class="dropdown notifications-menu"
									ng-include="'template/notificaciones.html'">
							</li>

							<!-- User Account Menu -->
							<li class="dropdown user user-menu"
									ng-include="'template/usuario.php'">
							</li>

						</ul>
					</div>
				</nav>
			</header>
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar"
					ng-include="'template/menu.php'">
			</aside>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">

					<h1>
						{{ titulo }}
						<small>{{ subtitulo }}</small>
					</h1>

				</section>

				<!-- Main content -->
				<section class="content" ng-view>
					
					<!-- 
					<ol class="breadcrumb">
						<li><a href=""><i class="fa fa-dashboard"></i> Level</a></li>
						<li class="active">Here</li>
					</ol> 
					-->

					<!-- Your Page Content Here -->

				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

			<!-- Main Footer -->
			<footer class="main-footer">
				<!-- To the right -->
				<div class="pull-right hidden-xs">
					{{ config.version }} Development by <a href>{{ config.autor }}</a>
				</div>
				<!-- Default to the left -->
				<strong>Copyright &copy; {{ config.anio }} 
						<a href="{{ config.web }}" target="blank">{{ config.empresa }}</a>.
				</strong> Derechos reservados.
			</footer>

		
		</div><!-- ./wrapper -->

		<!-- REQUIRED JS SCRIPTS -->

		<!-- jQuery 2.1.4 -->
		<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="bootstrap/js/bootstrap.min.js"></script>

		<!-- Data tables -->
		<script src="plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
		
		<!-- AdminLTE App -->
		<script src="dist/js/app.min.js"></script>

		<!-- Optionally, you can add Slimscroll and FastClick plugins.
				 Both of these plugins are recommended to enhance the
				 user experience. Slimscroll is required when using the
				 fixed layout. -->
	</body>
</html>
