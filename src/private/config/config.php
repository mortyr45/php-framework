<?php
const PMP_CORS_ALLOWED_ORIGINS = [];

const PMP_CSRF_TOKEN_NAME = 'csrfToken';

const PMP_EVENT_LISTENER_BINDINGS = [
    PMP\Event\TestEvent::class => [
        PMP\Event\TestListener::class
    ]
];

const PMP_LANGUAGE_COOKIE_NAME = 'preferedLanguage';
const PMP_LANGUAGE_LIST = ['en', 'jp', 'hu'];
const PMP_LANGUAGE_FALLBACK = 'en';