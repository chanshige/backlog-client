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
     * @expectedExceptionMessage Container configs must implement ContainerConfigInterface
     */
    public function testInvalidContainerInstance()
    {
        (new Factory)->newContainer([[]]);
    }

    /**
     * @expectedException \Exception\BacklogClientException
     * @expectedExceptionMessage Container configs must implement ContainerConfigInterface
     */
    public function testFailedNewInstance()
    {
        (new Factory([\stdClass::class]))->newInstance('backlog.example', 'api-key');
    }
}
