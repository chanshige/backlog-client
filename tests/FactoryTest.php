<?php
namespace Chanshige\Backlog;

/**
 * Class FactoryTest
 *
 * @package Chanshige\Backlog
 */
final class FactoryTest extends BaseTestCase
{
    /**
     * newContainer
     */
    public function testContainerInstance()
    {
        $factory = (new Factory)->newContainer();
        $this->assertInstanceOf('Aura\Di\Container', $factory);
    }

    /**
     * @expectedException \Exception\BacklogClientException
     */
    public function testInvalidContainerInstance()
    {
        (new Factory)->newContainer([[]]);
    }
}
