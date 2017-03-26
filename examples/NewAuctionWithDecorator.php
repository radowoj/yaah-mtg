<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once 'config.php';

use Radowoj\Yaah\Auction;
use Radowoj\Yaah\Constants\AuctionTimespans;
use Radowoj\Yaah\Constants\AuctionFids;
use Radowoj\Yaah\Constants\Conditions;
use Radowoj\Yaah\Constants\SaleFormats;
use Radowoj\Yaah\Constants\ShippingPaidBy;
use Radowoj\Yaah\HelperFactory\Factory;

use Radowoj\Yaah\AuctionDecorators\Mtg\RedAuction;
use Radowoj\Yaah\AuctionDecorators\Mtg\BlueAuction;

try {
    $helper = (new Factory())->create(require('config.php'));

    $redAuction = new RedAuction(new Auction());
    $redAuction->fromArray([
        'title' => 'Test auction for a Red card',
        'description' => 'Test auction description',
        'timespan' => AuctionTimespans::TIMESPAN_3_DAYS,
        'quantity' => 100,
        'country' => 1,
        'region' => 15,
        'city' => 'SomeCity',
        'postcode' => '12-345',
        'condition' => Conditions::CONDITION_NEW,
        'sale_format' => SaleFormats::SALE_FORMAT_SHOP,
        'buy_now_price' => 43.21,
        'shipping_paid_by' => ShippingPaidBy::SHIPPING_PAID_BY_BUYER,
        'post_package_priority_price' => 12.34,
    ]);

    $redAuction->setPhotos([
        //array of (no more than 8) paths to photo files
    ]);

    $blueAuction = new BlueAuction(new Auction());
    $blueAuction->fromArray([
        'title' => 'Test auction for a Blue card',
        'description' => 'Test auction description',
        'timespan' => AuctionTimespans::TIMESPAN_3_DAYS,
        'quantity' => 100,
        'country' => 1,
        'region' => 15,
        'city' => 'SomeCity',
        'postcode' => '12-345',
        'condition' => Conditions::CONDITION_NEW,
        'sale_format' => SaleFormats::SALE_FORMAT_SHOP,
        'buy_now_price' => 43.21,
        'shipping_paid_by' => ShippingPaidBy::SHIPPING_PAID_BY_BUYER,
        'post_package_priority_price' => 12.34,
    ]);

    $blueAuction->setPhotos([
        //array of (no more than 8) paths to photo files
    ]);

    $localId = 1;

    $allegroItemId = $helper->newAuction($redAuction, $localId++);
    echo "Created auction with itemId = {$allegroItemId}\n";

    $allegroItemId = $helper->newAuction($blueAuction, $localId++);
    echo "Created auction with itemId = {$allegroItemId}\n";

} catch (Exception $e) {
    echo "Exception: {$e->getMessage()}\nFile: {$e->getFile()}; Line: {$e->getLine()}\n\n";
}
