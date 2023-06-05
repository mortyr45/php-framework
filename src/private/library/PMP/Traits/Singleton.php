<?php namespace PMP\Traits;

/**
 * Lazy singleton trait
 */
trait Singleton
{
    /** @var self $instance The class singleton instance. */
    private static ?self $instance = null;

    /**
     * Returns the singleton instance.
     *
     * @return self
     **/
    public static function getInstance(): self
    {
        if (is_null(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }
}
