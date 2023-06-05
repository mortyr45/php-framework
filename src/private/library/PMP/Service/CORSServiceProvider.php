<?php namespace PMP\Service; # TODO: Testing

use \PMP\Exception\CORSException;

/**
 * Class for providing CORS service
 */
class CORSServiceProvider
{
    /** @var array $allowedOrigins array containing the allowed origins, which can do cross origin requests. */
    private static array $allowedOrigins = PMP_CORS_ALLOWED_ORIGINS;

    /**
     * Sets the CORS headers. Stops the program execution on OPTIONS request. Throws CORS exception on CORS failure.
     *
     * @return void
     **/
    public static function SetCORSHeaders(): void
    {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            if (!is_null(self::$allowedOrigins)) {
                if (!in_array($_SERVER['HTTP_ORIGIN'], self::allowedOrigins))
                    throw new CORSException("The HTTP origin {$_SERVER['HTTP_ORIGIN']} is not in the allowed CORS origins.");
            }
            else header('Access-Control-Allow-Origin: *');
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            exit(0);
        }
    }
}
