var app = angular.module('facturacionApp.promocionesCtrl', []);

// ================================================
//   Controlador de clientes
// ================================================
app.controller('promocionesCtrl', ['$scope','$routeParams', 'Promociones', function($scope, $routeParams, Promociones){

	
	var pag = $routeParams.pag;


	$scope.activar('mPromociones','','Clientes','listado');
	$scope.promociones = {};
	$scope.promocionSel = {};


	$scope.moverA = function( pag ){

		Promociones.cargarPagina( pag ).then( function(){
			$scope.promociones = Promociones;
			console.log($scope.promociones);
		});

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
	=            Funcion para guardar promocion            =
	======================================================*/
	$scope.guardar = function( promocion, frmPromocion ){

		Promociones.guardar( promocion ).then(function(){

			$("#modal_promocion").modal('hide');

			$scope.promocionSel = {};

			frmPromocion.autoValidateFormOptions.resetForm();


		});	

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

		console.log(file);
		if(file == undefined){
			console.log(file);
			$scope.mensajeError = true;
			setTimeout(function(){
					$scope.mensajeError = false;
					$scope.$apply();
				}, 1500);

		}else{

			Upload.uploadFile( file, promocionSel).then(function(res){
				console.log(res.data);

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

		formData.append("file", file);
		formData.append("id", promocionSel.id);

		console.log(formData);

		return $http.post("php/promociones/upload.php", formData,{

			headers: {
				"Content-type": undefined
			},
			transformRequest: angular.identity

		})
		.success(function(res){

			deferred.resolve(res);

		})
		.error(function(msg, code){

			deferred.reject(msg);

		})

		return deferred.promise;

	}

}])