<?php
namespace Chanshige\Backlog\Collection;

use Chanshige\Backlog\BaseTestCase;

class ArrayListTest extends BaseTestCase
{
    /** @var ArrayList */
    protected $arrayList;

    protected function setUp()
    {
        $this->arrayList = new ArrayList([
            'McDonalds' => 'マクドナルド',
            'BURGER KING' => 'バーガーキング',
            'Wendy\'s Japan' => 'ウェンディーズ',
            'MOS BURGER' => 'モスバーガー',
            'FRESHNESS' => 'フレッシュネスバーガー',
            'First Kitchen' => 'ファーストキッチン',
            'LOTTERIA' => 'ロッテリア',
            'DOM DOM HAMBURGER' => 'ドムドムハンバーガー',
            'KENTUCKY FRIED CHICKEN JAPAN' => 'ケンタッキー',
            'LUCKY PIERROT' => 'ラッキーピエロ',
            'THE CORNER Hamburger&Saloon' => 'ザ・コーナー'
        ]);
    }

    public function testToArray()
    {
        $expected = [
            'McDonalds' => 'マクドナルド',
            'BURGER KING' => 'バーガーキング',
            'Wendy\'s Japan' => 'ウェンディーズ',
            'MOS BURGER' => 'モスバーガー',
            'FRESHNESS' => 'フレッシュネスバーガー',
            'First Kitchen' => 'ファーストキッチン',
            'LOTTERIA' => 'ロッテリア',
            'DOM DOM HAMBURGER' => 'ドムドムハンバーガー',
            'KENTUCKY FRIED CHICKEN JAPAN' => 'ケンタッキー',
            'LUCKY PIERROT' => 'ラッキーピエロ',
            'THE CORNER Hamburger&Saloon' => 'ザ・コーナー'
        ];

        $this->assertEquals($expected, $this->arrayList->toArray());
        $this->assertTrue(is_iterable($this->arrayList));
    }

    public function testGet()
    {
        $this->assertEquals('ウェンディーズ', $this->arrayList->get('Wendy\'s Japan'));
        $this->assertEquals('ロッテリア', $this->arrayList->get('LOTTERIA'));
        $this->assertEquals('ラッキーピエロ', $this->arrayList->get('LUCKY PIERROT'));
        $this->assertEquals('マクドナルド', $this->arrayList->get('McDonalds'));
    }

    public function testSetKeyValue()
    {
        $this->arrayList->set('Subway Japan', 'サブウェイ');
        $this->assertTrue($this->arrayList->exists('Subway Japan'));
    }

    public function testAddValue()
    {
        $this->arrayList->add('NIHON HAMBURG & HAMBURGER ASSOCIATION');
        $this->assertTrue($this->arrayList->exists(0));
    }

    public function testSize()
    {
        $this->assertSame(11, $this->arrayList->size());
    }
}
