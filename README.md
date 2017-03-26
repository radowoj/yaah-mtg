# yaah-mtg
Yaah Auction decorators for Allegro categories related to Magic: The Gathering

## Example

**New auction via category-specific decorator. More human readable (associative array instead of numeric FID-indexed array). Also, with the help of multiple decorators (one per category) you can map the same array key (i.e. condition) to different category-specific FIDs.**

```php
use Radowoj\Yaah\Auction;
use Radowoj\Yaah\Constants\AuctionTimespans;
use Radowoj\Yaah\Constants\AuctionFids;
use Radowoj\Yaah\Constants\Conditions;
use Radowoj\Yaah\Constants\SaleFormats;
use Radowoj\Yaah\Constants\ShippingPaidBy;
use Radowoj\Yaah\HelperFactory\Factory;

use Radowoj\Yaah\AuctionDecorators\Mtg\RedAuction;
use Radowoj\Yaah\AuctionDecorators\Mtg\BlueAuction;

$helper = (new Factory())->create([
    'apiKey'        => 'your-allegro-api-key',
    'login'         => 'your-allegro-login',
    'passwordHash'  => 'your-sha-256-hashed-and-then-base64-encoded-allegro-password',
    'countryCode'   => 'your-country-code',
    'isSandbox'     => 'true-if-you-intend-to-use-sandbox'
]);

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

```
