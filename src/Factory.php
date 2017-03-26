<?php

namespace Radowoj\Yaah\AuctionDecorators\Mtg;

use Radowoj\Yaah\Auction;
use InvalidArgumentException;

class Factory
{

    protected $classMap = [
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


    public function createByIdCategory($idCategory, Auction $auction = null)
    {
        if (!array_key_exists($idCategory, $this->classMap)) {
            throw new InvalidArgumentException("Category id={$idCategory} is not supported");
        }

        $class = "Radowoj\\Yaah\\AuctionDecorators\Mtg\\{$this->classMap[$idCategory]}Auction";

        if (is_null($auction)) {
            $auction = new Auction();
        }

        return new $class($auction);
    }

}
