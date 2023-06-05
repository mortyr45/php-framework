<?php namespace PMP\Middleware;

use \PMP\Service\CORSServiceProvider;

/**
 * Middleware adapter for CORS
 */
class CORS2Middleware implements IMiddleware
{
    public static function Process(): void
    {
        CORSServiceProvider::SetCORSHeaders();
    }
}
