<?php namespace PMP\Service;

use \PMP\Exception\LanguageServiceException;

/**
 * Service provider class for multi language system.
 */
class LanguageServiceProvider
{
    /** @var string $cookieName Variable for storing the name of the cookie to be used. */
    private static string $cookieName = \PMP_LANGUAGE_COOKIE_NAME;

    /** @var array $availableLanguages The list of configured languages. */
    private static array $availableLanguages = \PMP_LANGUAGE_LIST;

    /** @var string $fallbackLanguage The default language to be used. */
    private static string $fallbackLanguage = \PMP_LANGUAGE_FALLBACK;

    /**
     * Sets the language stored in the cookie.
     *
     * @param string $language The language string to be stored in the cookie.
     * @return void
     * @throws LanguageServiceException if the provided language string parameter is not found in the configured available languages and there is no fallback language configured.
     **/
    public static function SetLanguage(string $language): void
    {
        if (!\in_array($language, self::$availableLanguages))
            if (\strcmp(self::$fallbackLanguage, '') == 0) throw new LanguageServiceException("The provided language parameter ($language) is not in the configured languages list!");
            else $language = self::$fallbackLanguage;
        \setcookie(self::$cookieName, $language, $options = ['path' => '/']);
    }

    /**
     * Gets the set language from the language cookie.
     * 
     * Returns empty string if the language is not set.
     *
     * @return string
     **/
    public static function GetLanguage(): string
    {
        if (!isset($_COOKIE[self::$cookieName])) return '';
        else return $_COOKIE[self::$cookieName];
    }

    /**
     * Detects the browser's default language.
     * 
     * @return string
     **/
    public static function DetectBrowserLanguage(): string
    {
        return \substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }
}
