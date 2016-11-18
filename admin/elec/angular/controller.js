app.controller('mainCtrl', ['$scope', 'Configuracion', function($scope, Configuracion){
	
	$scope.config = {};

	$scope.titulo    = "";
	$scope.subtitulo = "";



	$scope.usuario = {
		nombre:"Administrador"
	}

	Configuracion.cargar().then( function(){
		$scope.config = Configuracion.config;
	});


	// ================================================
	//   Funciones Globales del Scope
	// ================================================
	$scope.activar = function( menu, submenu, titulo, subtitulo ){

		$scope.titulo    = titulo;
		$scope.subtitulo = subtitulo;

		$scope.mDashboard = "";
		$scope.mParticipantes  = "";
		$scope.mSorteo  = "";

		$scope[menu] = 'active';

	};



}]);

app.controller('participantesCtrl', ['$scope', '$routeParams', 'Participantes',
									'Participante', 'ParticipanteSave', 'Excel',
									'$timeout', '$location',
									function($scope, $routeParams, Participantes, 
											Participante, ParticipanteSave, Excel, 
											$timeout, $location){

	$scope.activar('mParticipantes','','Participantes', '');
	$scope.participanteSel = {};

	$scope.participantes = {};

	console.log($routeParams.pag);


	Participantes.get({pag:$routeParams.pag},function(data){
		$scope.participantes = data;
		console.log($scope.participantes);
	});

	$scope.moverA = function(pag){
		$routeParams.pag = pag;
		//console.log($location.path('participantes/'+pag));
		console.log($routeParams.pag);
		Participantes.get({pag:pag},function(data){
			$scope.participantes = data;
			console.log($scope.participantes);
		});
	}


	$scope.mostrarModal = function(participante){

		angular.copy(participante, $scope.participanteSel);	

		$("#modal_promocion").modal('show');
	}

	$scope.guardarParticipante = function(participante, form){
		var parti = new ParticipanteSave();

		if(participante.id){
			parti.nombre_apellido = participante.nombre_apellido;
			parti.telefono = participante.telefono;
			parti.dni = participante.dni;
			parti.email = participante.email;
			parti.direccion = participante.direccion;
			parti.num_id_voucher = participante.num_id_voucher;

			parti.$save({id: participante.id},function(data){
				Participantes.get({pag:$routeParams.pag},function(data){
					$scope.participantes = data;
				});
			});

		}
		$("#modal_promocion").modal('hide');
	}

	$scope.eliminarParticipante = function(participante){
		if(confirm("Estás seguro que deseas eliminar") == true){
			Participante.delete({id:participante.id},function(data){
				Participantes.get({pag:$routeParams.pag},function(data){
					$scope.participantes = data;
				});
			});
		}
	}

	/*===================================================
	=            Funcion para exportar Excel            =
	===================================================*/
	$scope.exportToExcel=function(tableId){ // ex: '#my-table'
        $scope.exportHref=Excel.tableToExcel(tableId,'sheet name');
        $timeout(function(){
        	var link = document.createElement('a');
        	link.download = "reporte.xls";
        	link.href=$scope.exportHref;
        	link.click();
        },100); // trigger download
    }

	

}]);

app.controller('sorteoCtrl', ['$scope','Sorteo', '$timeout', function($scope,Sorteo,$timeout){

	$scope.activar('mSorteo','','Sorteo', '');
	$scope.cargando = true;
	$scope.ganador = {};
	$scope.sortear = function(){

		console.log("sorete");
		$scope.cargando = false;

		$timeout(function(){
			Sorteo.get(function(data){
				console.log(data.data.ganador);
				$scope.cargando = true;
				$scope.ganador = data.data.ganador;
			})
		}, 1500);
	}

}]);

app.controller('dashboardCtrl', ['$scope', function($scope){

	$scope.activar('mDashboard','','Dashboard','información');

}]);

