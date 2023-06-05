<?php namespace PMP\Service;

/**
 * Class for handling CSRF
 */
class CSRFServiceProvider
{
    /**
     * Issues a new CSRF token, if it does not exist in the session
     * 
     * @param bool $force Should the CSRF generation be forced?
     * @return string
     */
    public static function IssueCSRF(bool $force = false): string
    {
        if (\session_status() != 2)
            throw new \Exception('Session must be available for issuing a CSRF token!');
        if (!$force && \array_key_exists(\PMP_CSRF_TOKEN_NAME, $_SESSION) && \mb_strlen($_SESSION[\PMP_CSRF_TOKEN_NAME] > 0))
            return $_SESSION[\PMP_CSRF_TOKEN_NAME];
        $csrfToken = \PMP\Random::AlphanumericString();
        $_SESSION[\PMP_CSRF_TOKEN_NAME] = $csrfToken;
        return $csrfToken;
    }

    /**
     * Validates the CSRF token
     *
     * @param string $token The token received with the request.
     * @return bool
     **/
    public static function Validate(string $token): bool
    {
        return \strcmp($token, $_SESSION[\PMP_CSRF_TOKEN_NAME]) == 0;
    }
}
