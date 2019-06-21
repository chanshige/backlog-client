<?php
namespace Chanshige\Backlog\Collection;

use Chanshige\Backlog\BaseTestCase;
use Closure;

/**
 * Class PathObjectTest
 *
 * @package Chanshige\Backlog\Collection
 */
final class PathObjectTest extends BaseTestCase
{
    /**
     * Protectedメソッドのテスト
     */
    public function testCreatePath()
    {
        Closure::bind(function () {
            // http://www.rfc-editor.org/rfc/rfc3092.txt
            $path = (new PathObject(['meta_syntactic_variable']))
                ->foo(1)
                ->bar(2)
                ->baz()
                ->qux(3)
                ->quux(4)
                ->corge();

            $expected = 'meta_syntactic_variable/foo/1/bar/2/baz/qux/3/quux/4/corge';
            $this->assertEquals($expected, $path->createPath());
        }, $this, PathObject::class)();
    }

    /**
     * Protectedメソッドのテスト
     */
    public function testCreatePathWithoutConstructorParam()
    {
        Closure::bind(function () {
            $path = (new PathObject)
                ->foo(1)
                ->bar(2)
                ->baz(3)
                ->qux()
                ->quux()
                ->corge(4);

            $expected = 'foo/1/bar/2/baz/3/qux/quux/corge/4';
            $this->assertEquals($expected, $path->createPath());
        }, $this, PathObject::class)();
    }
}
