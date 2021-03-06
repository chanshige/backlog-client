<?php
namespace Chanshige\Backlog\Http;

use Chanshige\Backlog\BaseTestCase;
use Chanshige\Backlog\Interfaces\RequestInterface;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Closure;

/**
 * Class RequestTest
 *
 * @package Chanshige\Backlog\Http
 */
final class RequestTest extends BaseTestCase
{
    public function testStream()
    {
        $expected = (new MockHttpClient())->stream(new MockResponse());
        $this->assertEquals($expected, (new Request(new MockHttpClient()))->stream(new MockResponse()));
    }

    public function testBuildOptions()
    {
        Closure::bind(function () {
            $request = (new Request(new MockHttpClient()))
                ->withTimeout(500)
                ->withAuthBearer('token')
                ->withHeaders(['header'])
                ->withQuery(['foo', 'bar'])
                ->withBody('body');

            $expected = [
                'timeout' => 500,
                'auth_bearer' => 'token',
                'headers' => ['header'],
                'query' => ['foo', 'bar'],
                'body' => 'body'
            ];
            $this->assertEquals($expected, $request->buildOptions());
        }, $this, Request::class)();
    }

    /**
     * @expectedException \Exception\BacklogClientException
     * @expectedExceptionMessage The response factory iterator passed to MockHttpClient is empty.
     */
    public function testException()
    {
        $request = (new Request(new MockHttpClient(new \ArrayIterator())));
        $request(RequestInterface::GET, 'https://backlog-cilent.example');
    }
}
