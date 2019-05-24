<?php

namespace Gaffa\Tests;

use Gaffa\Slugger;
use Generator;
use PHPUnit\Framework\TestCase;

class SluggerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Slugger::setUp('test', 8);
    }

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
        yield [1, 'wedgpzLR'];
        yield [1234, '8RdZnYdx'];
        yield [100000, 'vz1evykz'];
        yield [0, '0'];
        yield [9999999999999999, 'kvMJlMqmXLj'];
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
        yield ['1-2-3', 'a9mc2s0a'];
        yield ['1', 'wedgpzLR'];
        yield ['12-24-35', 'zn2CnTbz'];
        yield ['1125125-155152153', 'bL9VDfGLOeR'];
        yield ['1-2-3-4-5-6-7-8-9', 'gpcEsnu4U9iRF3fPIN'];
    }
}
