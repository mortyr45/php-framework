<?php namespace PMP\Middleware;

/**
 * Interface for the middlewares
 */
interface IMiddleware
{
    /**
     * Process the middleware
     *
     * The main function for the middleware to start it's processing.
     *
     * @return void
     **/
    public static function Process(): void;
}
