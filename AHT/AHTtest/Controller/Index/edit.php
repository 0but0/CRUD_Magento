<?php
namespace AHT\AHTtest\Controller\Index;

class edit extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Framework\App\RequestInterface
     */
    private $request;

    /**
     * @param \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Registry $registry
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->request = $request;
        $this->registry = $registry;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->request->getParam('id');
        $this->registry->register('newId', $id);
        return $this->_pageFactory->create();
    }
}
