<?php namespace PMP\Event;

/**
 * Interface for PMP\Event\AEvent listeners.
 */
interface IListener
{
    /**
     * Starts this listener's logic.
     * 
     * @param array $params The parameters to be passed to this listener.
     * @return void
     */
    public static function FireListener(array $params): void;
}
