<?php

namespace OpenWykop\Slugger;

use Hashids\Hashids;
use function explode;
use function implode;

class Slugger
{
    /** @var string */
    private static $salt = 'slugger';

    /** @var int */
    private static $minHashLength = 8;

    /**
     * @return Hashids
     */
    private static function init(): Hashids
    {
        return new Hashids(self::$salt, self::$minHashLength);
    }

    /**
     * @param int $number
     *
     * @return bool
     */
    private static function isValidNumber(int $number): bool
    {
        return $number > 0;
    }

    /**
     * @param string $salt
     * @param int $minHashLength
     */
    public static function setUp(?string $salt = null, int $minHashLength = 8): void
    {
        self::$salt = $salt ?? \uniqid('', false);
        self::$minHashLength = $minHashLength;
    }

    /**
     * @param int $number
     *
     * @return string
     */
    public static function encode(int $number): string
    {
        if (!self::isValidNumber($number)) {
            return $number;
        }

        return self::init()->encode($number);
    }

    /**
     * @param string $hash
     * @return int
     */
    public static function decode(string $hash)
    {
        return self::init()->decode($hash)[0];
    }

    /**
     * Method expect string in format number-number-number
     * @param string $string
     * @return string
     */
    public static function encodeMany(string $string): string
    {
        $hasher = self::init();
        $idArr = explode("-", $string);

        return $hasher->encode($idArr);
    }

    /**
     * Return string as number-number-numbers
     * @param string $hash
     * @return string
     */
    public static function decodeMany(string $hash): string
    {
        $hasher = self::init();
        $string = implode("-", $hasher->decode($hash));

        return $string;
    }
}
