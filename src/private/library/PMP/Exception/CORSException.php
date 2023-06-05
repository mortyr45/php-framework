<?php namespace PMP\Exception;

/**
 * Exception class for CORS service.
 */
class CORSException extends \Exception
{
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
