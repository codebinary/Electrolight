var app = angular.module('facturacionApp.promociones',[]);


app.factory('Promociones', ['$http', '$q','$resource', '$timeout', function($http, $q, $timeout, $resource){

	var self = {

		'cargando'		: false,
		'err'     		: false, 
		'conteo' 		: 0,
		'promociones' 	: [],
		'pag_actual'    : 1,
		'pag_siguiente' : 1,
		'pag_anterior'  : 1,
		'total_paginas' : 1,
		'paginas'	    : []
	};

	return self.promociones = $resource('http://kia.com.pe/promociones/api/promociones/');



}]);