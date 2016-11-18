<?php
require_once 'Exceptions/APIException.php';
require_once 'Response/ResponseInterface.php';
require_once 'Response/Response.php';
require_once 'Response/JSON.php';

use API\Exceptions\APIException;
use API\Response\JSON;

class RapidRest {

    /**
     * Initializes RedBean.
     * Call this once in index.php (which I did by default...) and you're good to go!
     * If making changes check out the RedBeanPHP doc...
     * @url http://redbeanphp.com/connection
     */
    public static function dbInit() {

        
        global $DB_CONFIG;
        switch (strtolower($DB_CONFIG['engine'])) {
            /*
             * SQLite Connection
             */
            case "sqlite":
                R::setup('sqlite:'.$DB_CONFIG['SQLiteDB']);
                break;

            /*
             * PostgreSQL & MySQL Connections
             */
            case "postgresql": # In case you didn't follow the instructions ;)
            default:
                R::setup($DB_CONFIG['engine'] . ':host='.$DB_CONFIG['host'].';dbname='.$DB_CONFIG['db'],$DB_CONFIG['user'],$DB_CONFIG['pass']);
                R::freeze(true);
                break;
        }
    }

    /**
     * Return all records for a type
     * @param string $type Database table
     * @return string JSON All of the records and their contents
     * @throws API\Exceptions\APIException No records found, 404
     */
    public static function getList($type) {
        $beans = R::find($type);
        $response = R::exportAll($beans);
        if(sizeof($response) > 0) {
            return new JSON(array("statuscode"=>200, "data"=>$response, "count" => count($response)));
        } else {
            return new JSON(array("statuscode"=>404, "data"=>array(), "count" => 0));
        }

    }

    //Función que lista todos item con paginado
    public static function getListPag($type,$page=1) {
        //$beans = R::find($type);
        $limit=20;
        //$por_pagina = 20;
        $cuantos = R::count($type);
        $totalPag = ceil($cuantos / $limit);

        if($page > $totalPag){
            $page = $totalPag;
        }

        $arrPages = array();
        for ($i=0; $i < $totalPag; $i++) { 
            array_push($arrPages, $i+1);
        }


        $beans = R::findAll($type, 'ORDER BY id DESC LIMIT '.(($page-1)*$limit).', '.$limit);
        $response = R::exportAll($beans);
        if(sizeof($response) > 0) {
            return new JSON(array("statuscode"=>200, "data"=>$response, "count" => count($response), "cuantos" => $cuantos, "totalPag" => $totalPag, "pagActual" => (int) $page, "pages" => $arrPages));
        } else {
            return new JSON(array("statuscode"=>404, "data"=>array(), "count" => 0));
        }

    }

    /**
     * Fetch a bean from the database and display its contents
     * @param string $type Database Table
     * @param int $id Record ID
     * @return string JSON Item contents
     * @throws API\Exceptions\APIException Record not found, 404.
     */
    public static function getItem($type,$id) {
        $response = array();
        $$type = R::load($type, $id);
        $response = $$type->export(); # Exports the RedBean to an array

        if($response['id'] == 0) {  # RedBean returns ID 0 for new records.
            throw new APIException($type . " not found.", 404);
        } else {
            return new JSON(array("statuscode"=>200, "data"=>$response));
        }
    }

    /**
     * Create a bean using post data and store it in the database
     * @param string $type Table
     * @return string JSON {"data":{"id":new_id}}
     * @throws API\Exceptions\APIException No data received, 400
     */
    public static function postItem($type) {

        //Obtenemos los datos
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        
        $bean = R::dispense($type);
        if(sizeof($request) > 0) {
            $bean->import($request);
            $id = R::store($bean);
            return new JSON(array("statuscode"=>200, "data"=>array("id"=>$id)));
        } else {
            throw new APIException("No data received.",400);
        }


    }

    /**
     * PUT request to update an existing bean
     * @param string $type Table
     * @param int $id ID
     * @return string JSON {"data":{"id":$id}}
     * @throws API\Exceptions\APIException { Not found, 404 | No $_POST data received, 400 }
     */
    public static function putItem($type,$id) {
        $bean = R::load($type,$id);
        # Make sure we have a result
        $id = $bean->export(); # Exports the RedBean to an array

        //Obtenemos los datos
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        
        if($id['id'] == 0) {
            throw new APIException("Record not found.",404);
        } else {
            if(sizeof($request) > 0) {
                $bean->import($request);
                R::store($bean);
                return new JSON(array("statuscode"=>200, "data"=>array("id"=>$id['id'])));
            } else {
                throw new APIException("No data received.", 400);
            }
        }
    }

    /**
     * DELETE request to delete an existing record
     * @param string $type Table
     * @param int $id Record ID
     * @return string JSON {"deleted": true}
     * @throws API\Exceptions\APIException { Record not found, 404 }
     */
    public static function deleteItem($type,$id) {
        $bean = R::load($type,$id);
        # Make sure we have a result
        $id = $bean->export(); # Exports the RedBean to an array
        if($id['id'] == 0) {
            return new JSON(array("deleted"=>false));
        } else {
            R::trash($bean);
            return new JSON(array("deleted"=>true));
        }
    }

    //Funcion para sortear entre los participantes
    public static function sorteo($type){
        $count = R::count($type);

        $sql = R::getAll('SELECT * FROM participantes ORDER BY RAND() LIMIT 1');
        return new JSON(array("statuscode"=>200, "data"=>array("ganador"=>$sql)));
        var_dump("<pre>", $sql);
    }

    //Función que crea un usuario
    public static function createUser($type){
        $bean = R::dispense($type);
        if(sizeof($_POST > 0)){

        	//var_dump($_REQUEST);
            //echo "asdasdnasjasasnas";
            //exit();
            //Encriptando la contrasena
            $pass               = htmlspecialchars($_POST['contrasena']);
            //$passEncrypt        = password_hash($pass, PASSWORD_BCRYPT);
            $passEncrypt        = sha1($pass);
            //$passEncrypt        = $pass;

            $bean->codigo       = htmlspecialchars($_POST['codigo']);
            $bean->nombre       = htmlspecialchars($_POST['nombre']);
            $bean->contrasena   = $passEncrypt;

            //$bean->import($_POST);
            $id = R::store($bean);
            return new JSON(array("statuscode"=>200, "data"=>array("id"=>$id)));
        }else{
            throw new APIException("No data received.",400);
        }
    }

     //Función que realiza el login 
    public static function login($type){

        //Obtenemos los datos
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        
        //$bean = R::dispense($type);
        //validamos los datos de acceso
        if(sizeof($request > 0)){
            //var_dump($request->codigo);
            //exit();
        
            //Capturamos el codigo (user) y la contrasena
            $codigo = htmlspecialchars($request->codigo);
            $contrasena = $request->contrasena;
            
            //$contrasenaEncrypt = sha1($contrasena);
            //Obtenemos los datos de la bg pasandole el user ingresado
            $userBD = R::findOne($type, 'codigo=?', array($codigo));
            
            //Si existe el usuario se hace la validacion de la contraseña
            if($userBD){
            	//var_dump(($contrasenaEncrypt));
                //exit();
            	if($contrasena == $userBD->contrasena){
            		return new JSON(array("statuscode"=>200, "data"=>array("login"=>true)));
            	}else{
            		return new JSON(array("statuscode"=>401, "data"=>array("login"=>false)));
            	}
 
            }else{
                return new JSON(array("statuscode"=>401, "data"=>array("login"=>false)));
            }


        }

    }
}