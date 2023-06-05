<?php

use \PMP\Service\LanguageServiceProvider as Lang;

class LanguageTestController
{
    public static function Get()
    {
        echo Lang::GetLanguage();
    }

    public static function Set(string $lang = '')
    {
        Lang::SetLanguage($lang);
        echo 'Language set to: '.$lang;
    }

    public static function Detect()
    {
        echo Lang::DetectBrowserLanguage();
    }
}
