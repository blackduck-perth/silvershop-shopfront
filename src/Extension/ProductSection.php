<?php

namespace SilverShop\ShopFront\Extension;

use SilverShop\ShopFront\Model\ShopFrontSection;
use SilverStripe\ORM\DataExtension;

class ProductSection extends DataExtension
{
    private static $belongs_many_many = [
        'Sections' => ShopFrontSection::class
    ];
}
