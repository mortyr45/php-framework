<?php namespace PMP\Middleware;

/**
 * Middleware for parsing the JSON in the request body.
 */
class RequestBodyJson implements IMiddleware
{
    public static function Process(): void
    {
        $GLOBALS['requestBody'] = (array)\json_decode(\pmpStringEncoding(\file_get_contents('php://input')));
    }
}
