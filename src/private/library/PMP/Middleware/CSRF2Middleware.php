<?php namespace PMP\Middleware;

use \PMP\Service\CSRFServiceProvider;

/**
 * Middleware for CSRF validation
 */
class CSRF2Middleware implements IMiddleware
{
    public static function Process(): void
    {
        if (\session_status() != 2) {
            throw new \Exception('Session must be active for CSRF');
        }
        if (\array_key_exists(\PMP_CSRF_TOKEN_NAME, $_SESSION) && CSRFServiceProvider::Validate($GLOBALS['requestBody'][\PMP_CSRF_TOKEN_NAME]));
        else throw new \Exception('CSRF validation failed');
    }
}
