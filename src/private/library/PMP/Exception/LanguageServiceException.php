<?php namespace PMP\Exception;

/**
 * Exception class for language service.
 */
class LanguageServiceException extends \Exception
{
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
