<?php
namespace AHT\AHTtest\Block\Index;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \AHT\AHTtest\Model\TableFactory
     */
    private $tableFactory;

    /**
     * @param \AHT\AHTtest\Model\ResourceModel\Table\Collection
     */
    private $collectionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\AHTtest\Model\TableFactory $tableFactory,
        \AHT\AHTtest\Model\ResourceModel\Table\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->tableFactory = $tableFactory;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function test() {
        $tableData = $this->collectionFactory->create();
        return $tableData;
    }
}
