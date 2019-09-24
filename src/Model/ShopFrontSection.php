<?php

namespace SilverShop\ShopFront\Model;

use Page;
use SilverShop\Page\ProductCategory;
use SilverShop\ShopFront\Page\ShopFrontPage;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\DataObject;
use UncleCheese\DisplayLogic\Forms\Wrapper;

class ShopFrontSection extends DataObject
{
    private static $table_name = 'ShopFrontSection';

    private static $db = [
        'Title' => 'Varchar(200)',
        'Content' => 'HTMLText',
        'HideFromDisplay' => 'Boolean',
        'Sort' => 'Int',
    ];

    private static $has_one = [
        'ShopFront' => ShopFrontPage::class, // Parent relationship - indicates which shopfront page this section is on
        'ProductCategory' => ProductCategory::class,
    ];

    private static $many_many = [
        'Products' => Page::class
    ];

    private static $many_many_extraFields = [
        'Products' => [
            'Sort' => 'Int'
        ]
    ];

    private static $indexes = [
        'Sort' => true,
    ];

    private static $summary_fields = [
        'Title',
        'HideFromDisplay.Nice'
    ];

    public function getCMSFields()
    {
        $gridField = Wrapper::create(
            new GridField(
                'Products',
                'Products (if no category is set)',
                $this->Products(),
                GridFieldConfig_RelationEditor::create()
            )
        );

        $fields = new FieldList([
            new TextField('Title'),
            new CheckboxField('HideFromDisplay', 'Hide this section from display on the website'),
            new HTMLEditorField('Content')
        ]);

        if ($this->isInDB() && $this->ShopFront()) {
            $productCategoryField = TreeDropdownField::create(
                'ProductCategoryID',
                'Product Category',
                ProductCategory::class
            );

            $productCategoryField->setTreeBaseID($this->ShopFront()->ID)->setTitle('DisplayLogicWrap');
            $fields->push(Wrapper::create($productCategoryField));
            $fields->push($gridField);
        } else {
            $helperField = LiteralField::create(
                'ProductSelectionHelper',
                '<h3>You can select products to be displayed in this section once you have saved for the first '
                    . 'time.</h3>'
            );

            $fields->push($helperField);
        }

        $this->extend('updateCMSFields', $fields);
        return $fields;
    }

    /**
     * Returns a {@link DataList} of {@link Products} to include in the section.
     *
     * If the section is attached to a category, it pulls all the products from
     * that category, otherwise uses the products attached.
     *
     * @return DataList
     */
    public function Products()
    {
        if ($this->ProductCategoryID) {
            return Page::get()->filter('ParentID', $this->ProductCategoryID);
        }

        return $this->getManyManyComponents('Products');
    }
}
