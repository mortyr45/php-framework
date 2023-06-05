<?php namespace PMP\Middleware;

/**
 * Middleware for parsing the JSON in the request body.
 */
class RequestBodyForm implements IMiddleware
{
    public static function Process(): void
    {
        \parse_str(\pmpStringEncoding(\file_get_contents('php://input')), $GLOBALS['requestBody']);
    }
}
