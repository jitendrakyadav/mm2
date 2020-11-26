<?php
/**
 * Ajindra : Create a simple HelloWorld frontend page, involving layout, block 
 * and template file as well
 *
 * @category   Ajindra_FrontendHelloWorldPage
 * @package    Ajindra_FrontendHelloWorldPage
 * @copyright  2020 All rights reserved.
 * @license    Proprietary
 * @author     Ajindra
 * 
 * Note: 
 * 1. This file seems like a Controller, but actually, In Magento2, this file 
 * is considered as action and the directory under which it exists, here, like
 * "Index" is considered as Controller. 
 * 
 * 2. Remember, here an action denotes a separate independent web-page.
 * 
 * 3. Here execute() method is control execution starting point after __construct() 
 * method i.e. constructor.
 */
namespace Ajindra\FrontendHelloWorldPage\Controller\Index;

class SampleFrontendPage extends \Magento\Framework\App\Action\Action 
{
    protected $pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context, 
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute() 
    {
        return $this->pageFactory->create();
    }
}
