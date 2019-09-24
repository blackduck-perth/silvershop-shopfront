<?php

namespace SilverShop\ShopFront\Controller;

use PageController;
use SilverShop\ShopFront\Model\ShopFrontSection;
use SilverStripe\ORM\DataList;

class ShopFrontPageController extends PageController
{
    /**
     * Returns only the list of ShopFrontSection objects that are suitable for display (aren't hidden), optionally
     * overloaded by other extensions to return a differently filtered list of objects.
     *
     * @return DataList<ShopFrontSection>|null
     */
    public function SectionsForDisplay(): ?DataList
    {
        $sections = $this->data()->Sections()->filter('HideFromDisplay', 0)->sort('Sort ASC');

        $this->extend('updateSectionsForDisplay', $sections);

        return $sections;
    }
}
