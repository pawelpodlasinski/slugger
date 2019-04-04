<?php

namespace App\Tests;

use App\Slugger;
use Generator;
use PHPUnit\Framework\TestCase;

class SluggerTest extends TestCase
{
    /**
     * @test
     * @dataProvider numberProvider
     *
     * @param int $number
     * @param string $hash
     */
    public function canEncode(int $number, string $hash): void
    {
        $this->assertEquals($hash, Slugger::encode($number));
    }

    /**
     * @test
     * @dataProvider numberProvider
     *
     * @param int $number
     * @param string $hash
     */
    public function canDecode(int $number, string $hash): void
    {
        $this->assertEquals($number, Slugger::decode($hash));
    }

    /**
     * @return Generator
     */
    public function numberProvider(): Generator
    {
        yield [1, 'v9reEr0e'];
        yield [1234, '3z2v43rM'];
        yield [100000, 'vxoX36P2'];
        yield [0, '0'];
        yield [9999999999999999, '45kDWkymg4p'];
    }

    /**
     * @test
     * @dataProvider complexNumberProvider
     *
     * @param string $input
     * @param string $hash
     */
    public function canEncodeMany(string $input, string $hash): void
    {
        $this->assertEquals($hash, Slugger::encodeMany($input));
    }

    /**
     * @test
     * @dataProvider complexNumberProvider
     *
     * @param string $input
     * @param string $hash
     */
    public function candecodeMany(string $input, string $hash): void
    {
        $this->assertEquals($input, Slugger::decodeMany($hash));
    }

    /**
     * @return Generator
     */
    public function complexNumberProvider(): Generator
    {
        yield ['1-2-3', 'r87Uysvw'];
        yield ['1', 'v9reEr0e'];
        yield ['12-24-35', '2Enudc3w'];
        yield ['1125125-155152153', 'PkRmGhGdeMX'];
        yield ['1-2-3-4-5-6-7-8-9', 'eEU9sZHqCAizhdFWIJ'];
    }
}
