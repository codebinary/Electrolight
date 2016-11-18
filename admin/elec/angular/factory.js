app.factory('Configuracion', ['$http', '$q', function($http, $q){

	var self = {

		config:{},
		cargar: function(){

			var d = $q.defer();

			$http.get('configuracion.json')
				.success(function(data){

					self.config = data;
					d.resolve();


				})
				.error(function(){

					d.reject();
					console.error("No se pudo cargar el archivo de configuración");

				});

			return d.promise;
		}

	};

	return self;

}]);



//Actualizamos un participante
/*app.factory('Participantes', ['$resource','mySettings', function ($resource, mySettings) {
	return $resource(mySettings.apiUri+'participantes/:id', {id:'@id'},{
		update: {method:'PUT'}
	});
}]);*/

//Obtenemos el listado de los participantes pasandole el numero de pagina a obtener
app.factory('Participantes', ['$resource','mySettings', function ($resource, mySettings) {
	return $resource(mySettings.apiUri+'participantes/list/:pag', {pag:'@pag'},{
		get: {method:'GET', isArray: false}
	});
}])

//Eliminamos un participante
app.factory('Participante', ['$resource','mySettings', function ($resource, mySettings) {
	return $resource(mySettings.apiUri+'participantes/:id', {id:'@id'},
	{
		delete: {method:'DELETE'}
	});
}]);

//Eliminamos un participante
app.factory('ParticipanteSave', ['$resource','mySettings', function ($resource, mySettings) {
	return $resource(mySettings.apiUri+'participantes/:id', {id: '@id'});
}]);

//Sorte de participantes
app.factory('Sorteo', ['$resource','mySettings', function ($resource, mySettings) {
	return $resource(mySettings.apiUri+'/sorteo/participantes/',{
		get: {method:'GET', isArray: false}
	});
}])


//Factoria para exportar datos en excel
app.factory('Excel', ['$window', function($window){
	var uri='data:application/vnd.ms-excel;base64,',
            template='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
            base64=function(s){return $window.btoa(unescape(encodeURIComponent(s)));},
            format=function(s,c){return s.replace(/{(\w+)}/g,function(m,p){return c[p];})};
        return {
            tableToExcel:function(tableId,worksheetName){
                var table=$(tableId),
                    ctx={worksheet:worksheetName,table:table.html()},
                    href=uri+base64(format(template,ctx));
                return href;
            }
        };
}])