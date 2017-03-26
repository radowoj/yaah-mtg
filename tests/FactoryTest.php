<?php

namespace Radowoj\Yaah\AuctionDecorators\Mtg;

use PHPUnit\Framework\TestCase;
use Radowoj\Yaah\Constants\Conditions;
use Radowoj\Yaah\Auction;

class FactoryTest extends TestCase
{

    protected $idCategoryToClass = [
        6089 => 'Artifacts',
        6091 => 'Black',
        6095 => 'Blue',
        6096 => 'Green',
        6093 => 'Lands',
        6094 => 'Multicolor',
        6087 => 'Other',
        6092 => 'Red',
        6097 => 'Sets',
        6090 => 'White',
    ];

    protected $factory = null;

    public function setUp()
    {
        $this->factory = new Factory();
    }

    public function providerIdCategories()
    {
        return array_map(function($idCategory){
            return (array)$idCategory;
        }, array_keys($this->idCategoryToClass));
    }


    /**
     * @dataProvider providerIdCategories
     */
    public function testCreateEmptyByCategory($idCategory)
    {
        $decorator = $this->factory->createByIdCategory($idCategory);

        $this->assertSame([
            'category' => $idCategory
        ], $decorator->toArray());

        $expectedClassName = "Radowoj\\Yaah\\AuctionDecorators\\Mtg\\{$this->idCategoryToClass[$idCategory]}Auction";
        $this->assertSame($expectedClassName, get_class($decorator));
    }


    /**
     * @dataProvider providerIdCategories
     */
    public function testCreateNonEmptyByCategory($idCategory)
    {
        $auction = $this->getMockBuilder(Auction::class)
            ->setMethods(['toArray'])
            ->getMock();

        $auction->expects($this->once())
            ->method('toArray')
            ->willReturn([
                1 => 'some title',
            ]);

        $decorator = $this->factory->createByIdCategory($idCategory, $auction);

        $this->assertEquals([
            'category' => $idCategory,
            'title' => 'some title'
        ], $decorator->toArray());

        $expectedClassName = "Radowoj\\Yaah\\AuctionDecorators\\Mtg\\{$this->idCategoryToClass[$idCategory]}Auction";
        $this->assertSame($expectedClassName, get_class($decorator));
    }


    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Category id=1 is not supported
     */
    public function testExceptionOnNotSupportedCategory()
    {
        $decorator = $this->factory->createByIdCategory(1);
    }

}
