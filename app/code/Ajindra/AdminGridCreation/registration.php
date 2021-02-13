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
 * Note: It's primary mandatory file needed to create a module. Here we mention
 * <vendorName>_<moduleName>
 */
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'Ajindra_AdminGridCreation',
    __DIR__
);
