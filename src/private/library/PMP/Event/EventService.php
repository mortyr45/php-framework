<?php namespace PMP\Event;

/**
 * The service class for the event-listener implementation
 */
class EventService
{
    /** @var array $eventListenerBindings The array for storing the event-listener bingings. */
    private static array $eventListenerBindings = \PMP_EVENT_LISTENER_BINDINGS;

    /**
     * Returns the listeners for the provided event.
     *
     * @param string $class The event class which's bindings are to be searched.
     * @return array
     **/
    public static function getEventListeners(string $class): array
    {
        if (\array_key_exists($class, self::$eventListenerBindings))
            return self::$eventListenerBindings[$class];
        return [];
    }
}
