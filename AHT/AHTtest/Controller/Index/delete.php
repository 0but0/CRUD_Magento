<?php
namespace AHT\AHTtest\Controller\Index;

class delete extends \Magento\Framework\App\Action\Action
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
     * @param \AHT\AHTtest\Model\TableRepository
     */
    private $tableRepository;

    /**
     * @param \Magento\Framework\App\Cache\TypeListInterface
     */
    private $typeList;

    /**
     * @param \Magento\Framework\App\Cache\Frontend\Pool
     */
    private $pool;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Registry $registry,
        \AHT\AHTtest\Model\TableRepository $tableRepository,
        \Magento\Framework\App\Cache\TypeListInterface $typeList,
        \Magento\Framework\App\Cache\Frontend\Pool $pool
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->request = $request;
        $this->registry = $registry;
        $this->tableRepository = $tableRepository;
        $this->typeList = $typeList;
        $this->pool = $pool;
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

        $this->tableRepository->deleteById($id);
        
        $this->flushCache();
        $this->_redirect('hihi/index');
    }

    public function flushCache()
    {
        $_types = [
            'config',
            'layout',
            'block_html',
            'collections',
            'reflection',
            'db_ddl',
            'eav',
            'config_integration',
            'config_integration_api',
            'full_page',
            'translate',
            'config_webservice'
        ];

        foreach ($_types as $type) {
            $this->typeList->cleanType($type);
        }
        foreach ($this->pool as $poolvalue) {
            $poolvalue->getBackend()->clean();
        }
    }
}
