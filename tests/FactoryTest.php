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
    public function testExceptionNewInstance()
    {
        (new Factory([\stdClass::class]))->newInstance('backlog.example', 'api-key');
    }

    /**
     * @expectedException \Exception\BacklogClientException
     * @expectedExceptionMessage Container configs must implement ContainerConfigInterface
     */
    public function testExceptionNewContainer()
    {
        (new Factory)->newContainer([[]]);
    }
}
