<?php

namespace SilverShop\ShopFront\Page;

use Page;
use SilverShop\ShopFront\Controller\ShopFrontPageController;
use SilverShop\ShopFront\Model\ShopFrontSection;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class ShopFrontPage
 * @package SilverShop\ShopFront\Page
 *
 * A page type that allows the creation of multiple 'sections', each of which that can contain multiple products or
 * product categories (actually just any page object).
 */
class ShopFrontPage extends Page
{
    private static $controller_name = ShopFrontPageController::class;

    private static $has_many = [
        'Sections' => ShopFrontSection::class
    ];

    private static $owns = ['Sections'];

    private static $cascade_duplicates = ['Sections'];

    private static $cascade_deletes = ['Sections'];

    private static $singular_name = 'Shop Front Page';

    private static $plural_name = 'Shop Front Pages';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $config = GridFieldConfig_RecordEditor::create();
        $config->addComponent(new GridFieldOrderableRows('Sort'));

        $grid = GridField::create('Sections', 'Sections', $this->Sections(), $config);
        $fields->addFieldToTab('Root.Main', $grid);

        return $fields;
    }
}
