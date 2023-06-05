<?php namespace PMP\Event;

/**
 * Test event listener class
 */
class TestListener implements IListener
{
    public static function FireListener(array $params): void
    {
        echo 'Yeyy';
    }
}
