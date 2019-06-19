<?php
namespace Chanshige\Backlog\Http;

use Chanshige\Backlog\BaseTestCase;

/**
 * Class UriTest
 *
 * @package Chanshige\Backlog\Http
 */
final class UriTest extends BaseTestCase
{
    /** @var Uri */
    private $uri;

    public function setUp()
    {
        $this->uri = new Uri(
            'https://localhost.test',
            '20190101',
            'foo/var',
            ['abc' => 1, 'def' => 100]
        );
    }

    public function testConstructUri()
    {
        $expected = "https://localhost.test:443/foo/var?apiKey=20190101&abc=1&def=100";

        $this->assertEquals($expected, (string)$this->uri);
    }

    public function testGetMethods()
    {
        $this->assertEquals('https', $this->uri->getScheme());
        $this->assertEquals('localhost.test', $this->uri->getHost());
        $this->assertEquals('443', $this->uri->getPort());
        $this->assertEquals('foo/var', $this->uri->getPath());
        $this->assertEquals(['apiKey' => '20190101', 'abc' => 1, 'def' => 100], $this->uri->getQuery());
    }

    public function testWithSchemaAndPort()
    {
        $uri = $this->uri->withScheme('http')
            ->withPort(8080);

        $this->assertEquals('http', $uri->getScheme());
        $this->assertEquals('8080', $uri->getPort());
    }

    public function testWithHostAndPath()
    {
        $uri = $this->uri->withHost('whoisproxy.info')
            ->withPath('baz');

        $this->assertEquals('whoisproxy.info', $uri->getHost());
        $this->assertEquals('foo/var/baz', $uri->getPath());
    }

    public function testWithQuery()
    {
        $uri = $this->uri->withQuery(['ghi' => 500]);

        $this->assertEquals(
            ['apiKey' => '20190101', 'abc' => 1, 'def' => 100, 'ghi' => 500],
            $uri->getQuery()
        );
    }

    public function testImmutable()
    {
        $uri = $this->uri->withScheme('http')
            ->withPort(8001)
            ->withHost('domain.local')
            ->withPath('hogemoge')
            ->withQuery(['key' => 'value']);

        $this->assertEquals(
            "http://domain.local:8001/foo/var/hogemoge?apiKey=20190101&abc=1&def=100&key=value",
            (string)$uri
        );

        $this->assertEquals(
            "https://localhost.test:443/foo/var?apiKey=20190101&abc=1&def=100",
            (string)$this->uri
        );
    }
}
