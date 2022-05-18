<?php
namespace AHT\AHTtest\Block\Index;

class Edit extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @param \AHT\AHTtest\Model\TableRepository
     */
    private $tableRepository;

    /**
     * @param \Magento\Framework\View\Result\PageFactory
     */
    private $pageFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \AHT\AHTtest\Model\TableRepository $tableRepository,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->tableRepository = $tableRepository;
        $this->pageFactory = $pageFactory;
        parent::__construct($context, $data);
    }
    public function getTable() {
        $id = $this->registry->registry('newId');
        $table = $this->tableRepository->get($id);
        return $table;
       
    }
}
