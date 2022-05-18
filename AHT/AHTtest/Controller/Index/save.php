<?php
namespace AHT\AHTtest\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;

class save extends \Magento\Framework\App\Action\Action implements \Magento\Framework\App\Action\HttpPostActionInterface
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \AHT\AHTtest\Model\TableFactory
     */
    private $tableFactory;

    /**
     * @param \Magento\Framework\App\RequestInterface
     */
    private $request;

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
        \AHT\AHTtest\Model\TableFactory $tableFactory,
        \Magento\Framework\App\RequestInterface $request,
        \AHT\AHTtest\Model\TableRepository $tableRepository,
        \Magento\Framework\App\Cache\TypeListInterface $typeList,
        \Magento\Framework\App\Cache\Frontend\Pool $pool
        
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->tableFactory = $tableFactory;
        $this->request = $request;
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
        $request = ($this->request->getPostValue());
        extract($request);

        $table = $this->tableFactory->create();
        $table->setName($name);
        $table->setAge($age);
        if (isset($table_id)){
            $table->setTableId($table_id);
        } 
        // print_r($table->getData());

        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);

        if ($this->tableRepository->save($table)) {
            $redirect->setUrl('index');
        } else {
            $redirect->setUrl('create');
        }

        // $this->flushCache();
        return $redirect;

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
