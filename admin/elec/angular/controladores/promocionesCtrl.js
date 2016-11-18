var app = angular.module('facturacionApp.promocionesCtrl', []);

// ================================================
//   Controlador de clientes
// ================================================
app.controller('promocionesCtrl', ['$scope','$routeParams', 'Promociones', '$resource', function($scope, $routeParams, Promociones, $resource){

	
	var pag = $routeParams.pag;


	$scope.activar('mPromociones','','Clientes','listado');
	$scope.promociones = {};
	$scope.promocionSel = {};


	$scope.moverA = function( pag ){

		Promociones.get(function(data){
			$scope.promociones = data;
			console.log($scope.promociones);
		});

		/*Promociones.cargarPagina( pag ).then( function(){
			$scope.promociones = Promociones;
			console.log($scope.promociones);
		});*/

	};


	$scope.moverA(pag);

	/*======================================
	=            Mostrar Modal             =
	======================================*/

	$scope.mostrarModal = function( promocion ){
		
		angular.copy(promocion, $scope.promocionSel);

		$("#modal_promocion").modal();

	}

	/*======================================================
	=            Funcion para guardar promoción            =
	======================================================*/
	$scope.guardar = function( promocion, frmPromocion ){

		Promociones.guardar( promocion ).then(function(res){
			console.log(res);
			$("#modal_promocion").modal('hide');

			$scope.promocionSel = {};

			frmPromocion.autoValidateFormOptions.resetForm();


		});	

	};

	/*=======================================================
	=            Función para eliminar promoción            =
	=======================================================*/
	$scope.eliminarPromo = function( promocion ){
		
		if(confirm("Estas seguro que deseas eliminar") == true){

			Promociones.eliminar( promocion ).then(function(res){
				console.log(res);
			});
			
		}
	};
	
	
	
	


}]);

app.controller('uploadCtrl', ['$scope', 'Upload', function($scope, Upload){
	
	/*=====================================================
	=            Funcion para subir una imagen            =
	=====================================================*/
	$scope.uploadFile = function(promocionSel){
		
		var file = $scope.file;
		$scope.uploads = {};
		$scope.mostrarMensaje = false;
		$scope.mensajeError = false;

		

		if(file == undefined){
			console.log(file);
			$scope.mensajeError = true;
			setTimeout(function(){
					$scope.mensajeError = false;
					$scope.$apply();
				}, 1500);

		}else{

			Upload.uploadFile( file, promocionSel).then(function(res){
				console.log(res);

				$scope.mostrarMensaje = true;
				$scope.file = null;
				setTimeout(function(){
					$scope.mostrarMensaje = false;
					$scope.$apply();
				}, 1500);
				
				$scope.uploads = res.data;
			
			})

		}

	};


}])

.directive('uploaderModel', ["$parse", function ($parse) {
	return {
		restrict: 'A',
		link: function (scope, iElement, iAttrs) 
		{
			iElement.on("change", function(e)
			{
				$parse(iAttrs.uploaderModel).assign(scope, iElement[0].files[0]);
			});
		}
	};
}])


.service('Upload', ["$http", "$q", function($http, $q){

	this.uploadFile = function(file, promocionSel){

		
		var deferred = $q.defer();
		var formData = new FormData();

		console.log(promocionSel);

		formData.append("file", file);
		formData.append("id", promocionSel.id);
		formData.append("legal", promocionSel.legal);
		formData.append("nombre", promocionSel.nombre);
		formData.append("estado", promocionSel.estado);


		console.log(formData);

		return $http.post("php/promociones/upload.php", formData,{

			headers: {
				"Content-type": undefined
			},
			transformRequest: angular.identity

		})
		.success(function(res){

			deferred.resolve(resz);
			console.log(res);

		})
		.error(function(msg, code){

			deferred.reject(msg);

		})

		return deferred.promise;

	}

}])