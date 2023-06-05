<?php namespace PMP\Middleware;

/**
 * Middleware for starting session
 */
class Session implements IMiddleware
{
    public static function Process(): void
    {
        \session_start();
    }
}
