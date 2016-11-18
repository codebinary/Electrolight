var app = angular.module( 'facturacionApp',[
		'ngResource',
		'ngRoute', 
		'jcs-autoValidate',
		'ngFileUpload'
		]);

angular.module('jcs-autoValidate')
.run([
    'defaultErrorMessageResolver',
    function (defaultErrorMessageResolver) {
        // To change the root resource file path
       	defaultErrorMessageResolver.setI18nFileRootPath('angular/lib');
        defaultErrorMessageResolver.setCulture('es-co');
    }
]);

// ================================================
//   Constantes
// ================================================
app.constant('mySettings', {
	//'apiUri': 'http://kia.com.pe/electrolight/api/public/'
	//'apiUri': 'http://esnider-contreras.com/clientes/electrolight/api/public/'
	'apiUri': 'http://www.ganaconelectrolight.com/admin/api/public/'

})



// ================================================
//   Rutas
// ================================================
app.config([ '$routeProvider', function($routeProvider){

	$routeProvider
		.when('/',{
			templateUrl: 'dashboard/dashboard.html',
			controller: 'dashboardCtrl'
		})
		.when('/participantes/:pag',{
			templateUrl: 'participantes/participantes.html',
			controller: 'participantesCtrl'
		})
		.when('/sorteo/',{
			templateUrl: 'participantes/sorteo.html',
			controller: 'sorteoCtrl'
		})
		.otherwise({
			redirectTo: '/'
		})

}]);


// ================================================
//   Filtros
// ================================================
app.filter( 'quitarletra', function(){

	return function(palabra){
		if( palabra ){
			if( palabra.length > 1)
				return palabra.substr(1);
			else
				return palabra;
		}
	}
})


.filter( 'mensajecorto', function(){

	return function(mensaje){
		if( mensaje ){
			if( mensaje.length > 35)
				return mensaje.substr(0,35) + "...";
			else
				return mensaje;
		}
	}
})

.filter("textoMaximo", function(){

	return function(text){
		if(text != null){
			if(text.length > 60){
				return text.substring(0, 60) + "...";
			}else{
				return text;
			}
		}
	}

})

.filter("quitarHora", function(){

	return function(text){
		if(text != null){
			if(text.length > 1){
				return text.substring(0, 11);
			}else{
				return text;
			}
		}
	}

});








