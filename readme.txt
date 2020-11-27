/**
 * How can we create a basic frontend hello world page including layout, block & template as well
 *
 * Reference: https://www.mageplaza.com/magento-2-module-development/view-block-layout-template-magento-2.html
 */

 Create files in following orders. Please look every file's note, written just after copyright information, 
 where mentioned why that file has been created i.e. what is purpose behind to crete that file:
 1. app/code/Ajindra/FrontendHelloWorldPage/registration.php
 2. app/code/Ajindra/FrontendHelloWorldPage/etc/module.xml
 3. app/code/Ajindra/FrontendHelloWorldPage/etc/frontend/routes.xml
 4. app/code/Ajindra/FrontendHelloWorldPage/Controller/Index/SampleFrontendPage.php
 5. app/code/Ajindra/FrontendHelloWorldPage/view/frontend/layout/helloworld_index_samplefrontendpage.xml
 6. app/code/Ajindra/FrontendHelloWorldPage/Block/Index/SampleFrontendPage.php
 7. app/code/Ajindra/FrontendHelloWorldPage/view/frontend/templates/index/samplefrontendpage.phtml

 After copy this module, make the same effective & view the web-page, use following commands: 
 1. php bin/magento setup:upgrade && php bin/magento setup:di:compile 
 2. php bin/magento setup:static-content:deploy -f && php bin/magento cache:clean && php bin/magento cache:flush
 3. chmod -R 777 var generated pub/static
 4. rm -R var/cache/* var/page_cache/* var/view_preprocessed/* generated/* pub/static/*
 5. chmod -R 777 var generated pub/static
 6. If theme is not working/applying properly on developed frontend hello world webpage, then again use command:
    php bin/magento setup:static-content:deploy -f

 How our developed frontend hello world web-page looks like, please look following print-screen:
 print-screen-frontend-hello-world-page.png


