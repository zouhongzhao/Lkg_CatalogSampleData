<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Lkg\CatalogSampleData\Setup;

use Magento\Framework\App\State;
use Magento\Framework\Indexer\IndexerInterfaceFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Recurring data install.
 */
class RecurringData implements InstallDataInterface
{
    /**
     * @var State
     */
    private $state;

    /**
     * @var \Magento\Indexer\Model\Indexer\CollectionFactory
     */
    private $indexerCollectionFactory;

    /**
     * Init
     *
     * @param IndexerInterfaceFactory $indexerInterfaceFactory
     */
    public function __construct(
        State $state,
        \Magento\Indexer\Model\Indexer\CollectionFactory $indexerCollectionFactory
    ) {
        $this->state = $state;
        $this->indexerCollectionFactory = $indexerCollectionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        file_put_contents(BP."/var/log/lkg.txt", "RecurringData: install".PHP_EOL, FILE_APPEND);
        $this->state->emulateAreaCode(
            \Magento\Framework\App\Area::AREA_CRONTAB,
            [$this, 'reindex']
        );
    }

    /**
     * Perform full reindex
     */
    public function reindex()
    {
        file_put_contents(BP."/var/log/lkg.txt", "RecurringData: reindex".PHP_EOL, FILE_APPEND);
        foreach ($this->indexerCollectionFactory->create()->getItems() as $indexer) {
            $indexer->reindexAll();
        }
    }
}
