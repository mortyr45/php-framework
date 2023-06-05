<?php namespace PMP\Event;

/**
 * The abstract class for the PMP Framework's event system.
 */
abstract class AEvent
{
    /** @param array $environment The environment parameters for the event to be executed.  */
    public function __construct(array $environment = []) {
        $listeners = \PMP\Event\EventService::getEventListeners(\get_class($this));
        foreach ($listeners as $key) {
            $key::FireListener($environment);
        }
    }
}