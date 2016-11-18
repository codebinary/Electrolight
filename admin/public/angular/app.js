var app = angular.module( 'loginApp',['ngResource']);

app.constant('baseUrl', 'http://www.ganaconelectrolight.com/admin/api/public/');

app.controller('mainCtrl', ['$scope','LoginFactory', function( $scope, LoginFactory ){
	
	$scope.invalido = false;
	$scope.cargando = false;
	$scope.mensaje = "";

	$scope.datos = {};

	$scope.login = function(datos){
		

		if(datos.codigo.length < 3){
			$scope.invalido = true;
			$scope.mensaje = 'Ingrese su usuario';
			return;
		}else if(datos.contrasena.lenght < 3){
			$scope.invalido = true;
			$scope.mensaje = 'Ingrese su contrasena';
			return;
		}

		$scope.invalido = false;
		$scope.cargando = true;

		LoginFactory.login(datos).then(function(data){
			console.log(data);
			if(data.err){
				$scope.invalido = true;
				$scope.cargando = false;
				$scope.mensaje = data.mensaje;
				
			}else{
				console.log(data.mensaje);
				window.location = data.url;
			}
		});
	}
}]);


app.factory('LoginFactory', ['$http','$q','baseUrl','$resource', function ($http,$q,baseUrl,$resource) {
	
	var self = {
		login: function(datos){
			var d = $q.defer();
			console.log(datos.codigo);
			$http.post('php/login.php', datos)
				.success( function( data ){
					d.resolve(data);
				});

			return d.promise;
		}
	};

	return self;

}]);