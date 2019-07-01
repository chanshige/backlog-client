<?php
namespace Chanshige\Backlog;

use Chanshige\Backlog\Collection\ArrayList;
use Chanshige\Backlog\Fake\Common;
use Chanshige\Backlog\Interfaces\RequestInterface;
use Chanshige\Backlog\Provider\ResourceProvider;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class BacklogClientTest
 *
 * @package Chanshige\Backlog
 */
final class BacklogClientTest extends BaseTestCase
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

    public function testGetRequest()
    {
        $space = $this->backlog->space()->get();
        $this->assertInstanceOf(ResponseInterface::class, $space);
        $this->assertEquals(RequestInterface::GET, $space->getInfo('http_method'));

        $expected = 'https://test.baclog.example/api/v2/space?apiKey=api-key-fake';
        $this->assertEquals($expected, $space->getInfo('url'));
    }

    public function testGetRequestAddPath()
    {
        $space = $this->backlog->space()->notification()->get();
        $this->assertInstanceOf(ResponseInterface::class, $space);
        $this->assertEquals(RequestInterface::GET, $space->getInfo('http_method'));

        $expected = 'https://test.baclog.example/api/v2/space/notification?apiKey=api-key-fake';
        $this->assertEquals($expected, $space->getInfo('url'));
    }

    public function testGetRequestWithParameter()
    {
        $param = (new ArrayList)
            ->set('key1', 'foo')
            ->set('key2', 'bar')
            ->set('key3', 'baz');

        $issues = $this->backlog->issues(123456)->withParameters($param)->get();
        $this->assertEquals(RequestInterface::GET, $issues->getInfo('http_method'));

        $expected = 'https://test.baclog.example/api/v2/issues/123456?apiKey=api-key-fake&key1=foo&key2=bar&key3=baz';
        $this->assertEquals($expected, $issues->getInfo('url'));
    }

    public function testPostRequest()
    {
        $issues = $this->backlog->issues()->post();
        $this->assertEquals(RequestInterface::POST, $issues->getInfo('http_method'));

        $expected = 'https://test.baclog.example/api/v2/issues?apiKey=api-key-fake';
        $this->assertEquals($expected, $issues->getInfo('url'));
    }

    /**
     * @expectedException \Exception\BacklogClientException
     * @expectedExceptionMessage Oops!! resource name:users is undefined.
     */
    public function testUndefinedResourceException()
    {
        // Fake\Common
        $this->backlog->users();
    }

    /**
     * @expectedException \Exception\BacklogClientException
     * @expectedExceptionMessage The iterable params passed to RequestInterface is empty.
     *
     */
    public function testWithParameterPassedToEmptyIt()
    {
        $this->backlog->issues()->withParameters(new ArrayList)->get();
    }

    /**
     * @expectedException \Exception\BacklogClientException
     * @expectedExceptionMessage The iterable params passed to RequestInterface is empty.
     *
     */
    public function testWithParameterPassedToEmptyArray()
    {
        $this->backlog->issues()->withParameters([])->get();
    }
}
