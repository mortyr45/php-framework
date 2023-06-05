<?php

/**
 * Template method for requiring files and autoloading.
 * 
 * @return void
 */
function pmpLoadingTemplate(): void
{
    foreach (glob(BASEPATH.'config'.DIRECTORY_SEPARATOR.'*.php') as $filename) require_once $filename;

    spl_autoload_register(function($className) {
        $classPath = __DIR__.DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        if (file_exists($classPath)) {
            require_once $classPath;
            if (method_exists($className, 'init')) $className::init();
        }
    });

    spl_autoload_register(function($className) {
        $classPath = BASEPATH.'controllers'.DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        if (file_exists($classPath)) {
            require_once $classPath;
            if (method_exists($className, 'init')) $className::init();
        }
    });

    spl_autoload_register(function($className) {
        $classPath = BASEPATH.'library'.DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        if (file_exists($classPath)) {
            require_once $classPath;
            if (method_exists($className, 'init')) $className::init();
        }
    });
}

/**
 * Converts the encoding of a string to the internal encoding.
 * 
 * @param string $input The input string to be converted.
 * @return string The string with the converted encoding.
 */
function pmpStringEncoding(string $input): string
{
    return mb_convert_encoding($input, mb_internal_encoding(), mb_detect_encoding($input));
}