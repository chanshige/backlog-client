<?php
namespace Chanshige\Backlog;

use Chanshige\Backlog\Fake\Common;
use Chanshige\Backlog\Provider\ResourceProvider;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class ApiTest
 *
 * @package Chanshige\Backlog
 */
final class ApiTest extends BaseTestCase
{
    /** @var ResourceProvider $backlog */
    private $backlog;

    protected function setUp()
    {
        $this->backlog = (new Factory([Common::class]))
            ->newInstance('https://test.baclog.example', 'api-key-fake');
    }

    protected function tearDown()
    {
        $this->backlog = null;
    }

    /**
     * GetTest
     */
    public function testGetRequest()
    {
        $space = $this->backlog->space()->get();
        $this->assertInstanceOf(ResponseInterface::class, $space);
        $this->assertEquals('GET', $space->getInfo('http_method'));
        $this->assertEquals('https://test.baclog.example/api/v2/space?apiKey=api-key-fake', $space->getInfo('url'));
    }
}
