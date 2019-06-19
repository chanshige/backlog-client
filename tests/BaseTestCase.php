<?php
namespace Chanshige\Backlog;

use PHPUnit\Framework\TestCase;

/**
 * Class BaseTestCase
 *
 * @package Chanshige\Backlog
 */
abstract class BaseTestCase extends TestCase
{
    protected $actual;

    protected $expected;

    /**
     * @param string $message
     */
    public function verify($message = '')
    {
        $this->assertEquals($this->expected, $this->actual, $message);
    }
}
