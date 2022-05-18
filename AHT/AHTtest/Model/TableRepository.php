<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\AHTtest\Model;

use AHT\AHTtest\Api\Data\TableInterfaceFactory;
use AHT\AHTtest\Api\Data\TableSearchResultsInterfaceFactory;
use AHT\AHTtest\Api\TableRepositoryInterface;
use AHT\AHTtest\Model\ResourceModel\Table as ResourceTable;
use AHT\AHTtest\Model\ResourceModel\Table\CollectionFactory as TableCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class TableRepository implements TableRepositoryInterface
{

    protected $tableFactory;

    protected $dataObjectHelper;

    protected $extensibleDataObjectConverter;
    private $collectionProcessor;

    private $storeManager;

    protected $searchResultsFactory;

    protected $resource;

    protected $extensionAttributesJoinProcessor;

    protected $dataObjectProcessor;

    protected $dataTableFactory;

    protected $tableCollectionFactory;


    /**
     * @param ResourceTable $resource
     * @param TableFactory $tableFactory
     * @param TableInterfaceFactory $dataTableFactory
     * @param TableCollectionFactory $tableCollectionFactory
     * @param TableSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceTable $resource,
        TableFactory $tableFactory,
        TableInterfaceFactory $dataTableFactory,
        TableCollectionFactory $tableCollectionFactory,
        TableSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->tableFactory = $tableFactory;
        $this->tableCollectionFactory = $tableCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataTableFactory = $dataTableFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \AHT\AHTtest\Api\Data\TableInterface $table
    ) {
        /* if (empty($table->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $table->setStoreId($storeId);
        } */
        
        // $tableData = $this->extensibleDataObjectConverter->toNestedArray(
        //     $table,
        //     [],
        //     \AHT\AHTtest\Api\Data\TableInterface::class
        // );
        
        // $tableModel = $this->tableFactory->create()->setData($tableData);
        
        try {
            $this->resource->save($table);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the table: %1',
                $exception->getMessage()
            ));
        }
        return $table->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($tableId)
    {
        $table = $this->tableFactory->create();
        $this->resource->load($table, $tableId);
        if (!$table->getId()) {
            throw new NoSuchEntityException(__('table with id "%1" does not exist.', $tableId));
        }
        return $table->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->tableCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \AHT\AHTtest\Api\Data\TableInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \AHT\AHTtest\Api\Data\TableInterface $table
    ) {
        try {
            $tableModel = $this->tableFactory->create();
            $this->resource->load($tableModel, $table->getTableId());
            $this->resource->delete($tableModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the table: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($tableId)
    {
        return $this->delete($this->get($tableId));
    }
}
