<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\AHTtest\Model;

use AHT\AHTtest\Api\Data\TableInterface;
use AHT\AHTtest\Api\Data\TableInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Table extends \Magento\Framework\Model\AbstractModel implements TableInterface
{

    protected $tableDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'aht_ahttest_table';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param TableInterfaceFactory $tableDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \AHT\AHTtest\Model\ResourceModel\Table $resource
     * @param \AHT\AHTtest\Model\ResourceModel\Table\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        TableInterfaceFactory $tableDataFactory,
        DataObjectHelper $dataObjectHelper,
        \AHT\AHTtest\Model\ResourceModel\Table $resource,
        \AHT\AHTtest\Model\ResourceModel\Table\Collection $resourceCollection,
        array $data = []
    ) {
        $this->tableDataFactory = $tableDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve table model with table data
     * @return TableInterface
     */
    public function getDataModel()
    {
        $tableData = $this->getData();
        
        $tableDataObject = $this->tableDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $tableDataObject,
            $tableData,
            TableInterface::class
        );
        
        return $tableDataObject;
    }
}
