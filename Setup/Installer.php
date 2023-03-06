<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Lkg\CatalogSampleData\Setup;

use Magento\Framework\Setup;

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
     * @param \Magento\CatalogSampleData\Model\Category $categorySetup
     * @param \Magento\CatalogSampleData\Model\Attribute $attributeSetup
     * @param \Magento\CatalogSampleData\Model\Product $productSetup
     */
    public function __construct(
        \Lkg\CatalogSampleData\Model\Category $categorySetup,
        \Lkg\CatalogSampleData\Model\Attribute $attributeSetup,
        \Lkg\CatalogSampleData\Model\Product $productSetup
    ) {
        $this->categorySetup = $categorySetup;
        $this->attributeSetup = $attributeSetup;
        $this->productSetup = $productSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function install()
    {
        $this->attributeSetup->install(['Lkg_CatalogSampleData::fixtures/attributes.csv']);
        $this->categorySetup->install(['Lkg_CatalogSampleData::fixtures/categories.csv']);
        $this->productSetup->install(
            [
                'Lkg_CatalogSampleData::fixtures/SimpleProduct/products_gear_bags.csv',
                'Lkg_CatalogSampleData::fixtures/SimpleProduct/products_gear_fitness_equipment.csv',
                'Lkg_CatalogSampleData::fixtures/SimpleProduct/products_gear_fitness_equipment_ball.csv',
                'Lkg_CatalogSampleData::fixtures/SimpleProduct/products_gear_fitness_equipment_strap.csv',
                'Lkg_CatalogSampleData::fixtures/SimpleProduct/products_gear_watches.csv',
            ],
            [
                'Lkg_CatalogSampleData::fixtures/SimpleProduct/images_gear_bags.csv',
                'Lkg_CatalogSampleData::fixtures/SimpleProduct/images_gear_fitness_equipment.csv',
                'Lkg_CatalogSampleData::fixtures/SimpleProduct/images_gear_watches.csv',
            ]
        );
    }
}
