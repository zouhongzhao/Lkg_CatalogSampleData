<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Lkg\CatalogSampleData\Setup;

use Magento\Framework\Setup;
use Magento\Framework\App\ObjectManager;

class Installer implements Setup\SampleData\InstallerInterface
{
    /**
     * Setup class for category
     *
     * @var \Magento\CatalogSampleData\Model\Category
     */
    protected $categorySetup;

    /**
     * Setup class for product attributes
     *
     * @var \Magento\CatalogSampleData\Model\Attribute
     */
    protected $attributeSetup;

    /**
     * Setup class for products
     *
     * @var \Magento\CatalogSampleData\Model\Product
     */
    protected $productSetup;

     /**
     * @var \Magento\ProductLinksSampleData\Model\ProductLink
     */
    protected $productLink;

    /**
     * @param \Magento\CatalogSampleData\Model\Category $categorySetup
     * @param \Magento\CatalogSampleData\Model\Attribute $attributeSetup
     * @param \Magento\CatalogSampleData\Model\Product $productSetup
     */
    public function __construct(
        \Lkg\CatalogSampleData\Model\Category $categorySetup,
        \Lkg\CatalogSampleData\Model\Attribute $attributeSetup,
        // \Lkg\CatalogSampleData\Model\ProductLink $productLink,
        \Lkg\CatalogSampleData\Model\Product $productSetup
    ) {
        $this->categorySetup = $categorySetup;
        $this->attributeSetup = $attributeSetup;
        $this->productSetup = $productSetup;
        // $this->productLink = $productLink;
        // $this->productLink = ObjectManager::getInstance()->get(\Lkg\CatalogSampleData\Model\ProductLink::class);
    }
   
    /**
     * {@inheritdoc}
     */
    public function install()
    {
        file_put_contents(BP."/var/log/lkg.txt", "Installer: install".PHP_EOL, FILE_APPEND);
        $this->attributeSetup->install(['Lkg_CatalogSampleData::fixtures/attributes.csv']);
        $this->categorySetup->install(['Lkg_CatalogSampleData::fixtures/categories.csv']);
        $this->productSetup->install(
            [
                'Lkg_CatalogSampleData::fixtures/SimpleProduct/products_man.csv',
                'Lkg_CatalogSampleData::fixtures/SimpleProduct/products_woman.csv'
            ],
            [
                'Lkg_CatalogSampleData::fixtures/SimpleProduct/images_man.csv',
                'Lkg_CatalogSampleData::fixtures/SimpleProduct/images_woman.csv'
            ]
        );
        //  $this->productLink->install(
        //     ['Lkg_CatalogSampleData::fixtures/related.csv'],
        //     ['Lkg_CatalogSampleData::fixtures/upsell.csv'],
        //     ['Lkg_CatalogSampleData::fixtures/crosssell.csv']
        // );
    }
}
