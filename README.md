# Shop Front Module

An extension to the [SilverShop module](https://github.com/silvershop/) that provides a custom page type for a 'shop front'. The shop front allows a CMS author to create 'sections', each of which can contain arbitrary products (or a product category).
 
## Maintainer Contact

 * [madmatt](https://github.com/madmatt/)

## Requirements

 * silvershop/core: ^3

## Installation Instructions

 * Install via composer: `composer require silvershop/shopfront`
 * Run `vendor/bin/sake dev/build flush=1` to add the new page types
 * Create a new 'Shop Front page' in the CMS, define your sections and add products to each one
 * The module ships with a super basic template that you are expected to override in your own theme:
   * Create a new file under `themes/<your_theme>/templates/SilverShop/ShopFront/Page/Layout/ShopFrontPage.ss` 
   * Add your custom styles and classes to this file, using the existing file as an example
