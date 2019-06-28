<?php
namespace Chanshige\Backlog\Factory;

use Chanshige\Backlog\BaseTestCase;
use Chanshige\Backlog\Http\Uri;
use Chanshige\Backlog\Interfaces\UriInterface;

/**
 * Class ResourceFactoryTest
 *
 * @package Chanshige\Backlog\Factory
 */
final class ResourceFactoryTest extends BaseTestCase
{
    /** @var ResourceFactory */
    private $factory;

    protected function setUp()
    {
        $map['resource'] = function (array $param, UriInterface $uri) {
            return [
                'param' => $param,
                'uri' => (string)$uri
            ];
        };

        $this->factory = new ResourceFactory($map);
    }

    public function testNewInstance()
    {
        $expected = [
            'param' => ['test'],
            'uri' => 'https://host:443/?apiKey=apiKey'
        ];

        $actual = $this->factory->newInstance('resource', ['test'], new Uri('host', 'apiKey'));
        $this->assertEquals($expected, $actual);
    }

    public function testToString()
    {
        $expected = "array (\n  'resource' => \n  Closure::__set_state(array(\n  )),\n)";
        $this->assertEquals($expected, (string)$this->factory);
    }
}
