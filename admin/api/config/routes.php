<?php
/**
 * RapidREST Route File
 */

/**
 * Class AppRouter
 */
class AppRouter {
    /**
     * Called in public/index.php to route our application.
     * Define your custom routes at the beginning of the function otherwise the stock routes will override them!
     */
    public static function route() {
        global $slim;

        /* Define your custom routes here */

        $slim->get('/example/', function () {
            echo "This is a custom route example!";
        });

        $slim->get('/example/:id/', function ($id) {
            echo "This is a custom route example! You picked ID " . $id;
        });

        //Ruta para crear un usuario con contraseña encriptada
        $slim->post('/create/:type', function($type){
            RapidREST::createUser($type);
        });

        //Ruta para el login
        $slim->post('/login/:type', function($type){
            RapidREST::login($type);
        });

        $slim->get('/sorteo/:type', function($type){
            RapidREST::sorteo($type);
        });

        //Listar todos los registros con paginacion
        $slim->get('/:type/list/:pag', function($type,$page){
            RapidREST::getListPag($type,$page);
        });

       

        /* Put your custom routes above this line! */

        # GET list
        $slim->get('/:type/', function ($type) {
            RapidRest::getList($type);
        });

        # GET item
        $slim->get('/:type/:id/', function ($type, $id) {
            RapidRest::getItem($type, $id);
        });

        # POST item
        $slim->post('/:type/', function ($type) {
            //var_dump($_REQUEST);
            //echo "Entro post";
            //exit();
            RapidRest::postItem($type);
        });

        # PUT item
        $slim->post('/:type/:id/', function ($type, $id) {
            //var_dump($_REQUEST);
            //echo "asdasdnasjasasnas";
            //exit();
            RapidRest::putItem($type, $id);
        });

        # DELETE item
        $slim->delete('/:type/:id/', function ($type, $id) {
            RapidRest::deleteItem($type, $id);
        });
    }
}