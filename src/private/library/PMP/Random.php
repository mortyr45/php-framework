<?php namespace PMP;

/**
 * Class for helping with random generation
 */
class Random
{
    /**
     * A function, which will generate a random string determined by the flags.
     * 
     * @param int $length How long the generated string should be.
     * @param string $flags What characters the string can contain. (0 = integers, a = lowercase letters, A = uppercase letters)
     * @param string $additionalCharacters Some additional characters to be possible to appear in the random string.
     * @return string
     */
    public static function AlphanumericString(int $length = 10, string $flags = '0aA', string $additionalCharacters = ''): string
    {
        $numbers = '0123456789';
        $lowerCase = 'abcdefghijklmnopqrstuvwxyz';
        $upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters = '';

        if (\is_numeric(\mb_strpos($flags, '0'))) $characters .= $numbers;
        if (\is_numeric(\mb_strpos($flags, 'a'))) $characters .= $lowerCase;
        if (\is_numeric(\mb_strpos($flags, 'A'))) $characters .= $upperCase;
        
        $characters .= $additionalCharacters;

        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
