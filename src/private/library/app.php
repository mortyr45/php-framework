<?php

/**
 * Starts the execution of the PMP Framework
 * 
 * @return void
 **/
function pmpStart()
{
    // BOOT
    ignore_user_abort(true);
    header('Powered-By: PMP-Framework');

    // ROUTING
    $router = \PMP\PMPRouter::class;
    $router::$altoRouter = new \AltoRouter();
    foreach (glob(BASEPATH.'routes'.DIRECTORY_SEPARATOR.'*.php') as $filename) require_once $filename;

    // APP LOADING
    if ($router::Match()) {
        // INVOKE CONTROLLER
        $router::$match['target']->Route($router::$match['params']);
    }
    else http_response_code(404);
}