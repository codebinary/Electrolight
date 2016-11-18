<?php
# Load everything!
require '../config/loader.php';

$slim = new \Slim\Slim();       # Initialize the application. Custom logic goes below here.

$corsOptions = array(
    "origin" => "*",
    "exposeHeaders" => array("Content-Type", "X-Requested-With", "X-authentication", "X-client"),
    "allowMethods" => array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS')
);

$cors = new \CorsSlim\CorsSlim($corsOptions);

$slim->add($cors);

# Set up RedBean
RapidRest::dbInit();            # It's just a configuration-friendly call to R::setup()

# Route our request
AppRouter::route();             # Add your custom routes to /lib/routes.php

$slim->run();                   # Run the program