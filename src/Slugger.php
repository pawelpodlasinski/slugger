<?php

namespace App;

use Hashids\Hashids;
use function explode;
use function implode;

class Slugger
{
    /**
     * @return Hashids
     */
    private static function init(): Hashids
    {
        return new Hashids('Wykop', 8);
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
