<?php
/**
 * RapidREST Configuration
 * If you don't need to define any custom routes and functions then this is the only file you need to touch!
 * Otherwise you'll want to check out /lib/routes.php for customizing this application.
 */

$DB_CONFIG = array();

$DB_CONFIG['engine']= "mysql";          # Supported and tested: mysql. SHOULD work: pdsql & sqlite (Enter their names as such!)

/* Non-SQLite settings. */
$DB_CONFIG['host']  = "localhost"; # Host
//$DB_CONFIG['db']    = "kiacom_formSportage";      # Database
//$DB_CONFIG['user']  = "kiacom_useradmin";           # Username
//$DB_CONFIG['pass']  = "l0Ze%~%mXtVr";           # Password

$DB_CONFIG['db']    = "elecdb_consurso";      # Database
$DB_CONFIG['user']  = "electlight_admin";           # Username
$DB_CONFIG['pass']  = "cB@/%801_Ss*A(4F";           # Password

/* SQLite Configuration */
$DB_CONFIG['SQLiteDB']  = "my_database.db";
