<?php namespace PMP\Templating;

use \Mustache_Engine, \Mustache_Autoloader, \Mustache_Loader_FilesystemLoader;

/**
 * Helper class for mustache template engine.
 */
class MustacheHelper
{
    /** @var Mustache_engine $muctacheEngine The Mustache Engine instance to be used. */
    private static ?Mustache_Engine $mustacheEngine = null;

    /**
     * Get the Mustache_Engine instance
     *
     * It will create and/or return a Mustache_Engine instance, generated with the default configuration.
     *
     * @return Mustache_Engine
     **/
    public static function getMustacheEngine(): Mustache_Engine
    {
        if(is_null(self::$mustacheEngine)) {
            Mustache_Autoloader::register();
            self::$mustacheEngine = new Mustache_Engine([
                'loader' => new Mustache_Loader_FilesystemLoader(BASEPATH.'/views'),
                'pragmas' => [Mustache_Engine::PRAGMA_BLOCKS],
                'cache' => '/tmp/cache/mustache',
                'entity_flags' => ENT_QUOTES,
                'charset' => 'UTF-8'
            ]);
        }
        return self::$mustacheEngine;
    }
}
