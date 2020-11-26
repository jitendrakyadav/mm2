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
 */
namespace Ajindra\FrontendHelloWorldPage\Block\Index;

class SampleFrontendPage extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
    {
        parent::__construct($context);
    }

    public function sayHello()
    {
        return __('Hello World');
    }
}