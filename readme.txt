/** What is Magento **/
Magento is an open-source e-commerce platform written in PHP.

Magento provides it's 3 versions:
1. Magento Open Source: It is an open-source eCommerce platform and previously named as Magento Community Edition. Developers can implement the core files and extend its functionality by adding new plug-in modules provided by other developers.
2. Magento Commerce: It's an eCommerce platform as a service i.e. it provides hosting(i.e. space where application's code reside) on it's own as well.
3. Magento Commerce (On-Premises): It's previously named as "Magento Enterprise Edition". It's originated from Magento Open Source and has the same core files. Unlike Open Source, this is not free but has more features and functionality. This product is designed for large businesses that require technical support with installation, usage, configuration, and troubleshooting. Here Magento only provides Enterprise Edition code and website owner put it at their own purchased hosting like AWS or Google cloud.

Magento serves to three levels of businesses; small business, mid-market, and enterprise. Although Magento Commerce has annual maintenance fees, neither Open Source nor Commerce(On-Premises) include hosting.

/** 
 * When you are inside a controller action page like app/code/Ajindra/BookAppointment/Controller/Index/Index.php under execute() method, you can do followings: 
 * As we know, here, Magento treats directory "Index" as controller and the actual file "Index.php" as action. 
 * URL to access this controller: http://www.xyx.com/<frontname>/index/index or http://www.xyz.com/<frontname>
 * Here <frontname> exists in <module-root-directory>/etc/frontend/routes.xml or <module-root-directory>/etc/adminhtml/routes.xml
 **/

<?php
namespace Ajindra\BookAppointment\Controller\Index;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Ajindra\BookAppointment\Model\AvailableAppointmentFactory;
 
class Index extends Action
{
    /**
     * @var \Ajindra\BookAppointment\Model\AvailableAppointmentFactory
     */
    protected $modelAvailableAppointmentFactory;
    
    /**
     * @var \Magento\Framework\Escaper
     */
    protected $escaper;
 
    /**
     * @param Context $context
     * @param AvailableAppointmentFactory $modelAvailableAppointmentFactory
     * @param \Magento\Framework\Escaper $escaper
     */
    public function __construct(
        Context $context,
        AvailableAppointmentFactory $modelAvailableAppointmentFactory,
        \Magento\Framework\Escaper $escaper
    ) {
        parent::__construct($context);
        $this->modelAvailableAppointmentFactory = $modelAvailableAppointmentFactory;
        $this->escaper = $escaper;
    }
 
    public function execute()
    {
        /**
         * When Magento get your model, it will generate a Factory class
         * for your model at var/generaton folder and we can get your
         * model by this way
         */
        $availableAppointmentModel = $this->modelAvailableAppointmentFactory->create();
 
        // Load the item with ID is 1
        $item = $availableAppointmentModel->load(1);
        echo "<pre>";
        var_dump($item->getData());
 
        // Get appointment_available collection
        $availableAppointmentCollection = $availableAppointmentModel->getCollection();
        // Load all data of collection
        var_dump($availableAppointmentCollection->getData());
        //above code must be removed
        
       
        
        /*** Start: Get users of a particular role in magento **************************************/
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
     
        /**** Start: Get/Call Block function in Controller ****/ 
        $layoutFactory = $objectManager->create('\Magento\Framework\View\Result\LayoutFactory');
        $layout = $layoutFactory->create()->getLayout();
        $block = $layout->createBlock('\Ajindra\BookAppointment\Block\BookAppointment');
        if ($block) {
            var_dump($block->getResult());
        }
        /**** End: Get/Call Block function in Controller ****/
     
        /**** Start: In .phtml/template file, we can access block function as follows **/
        //Here in this section, $this & $block is pre-available variable in .phtml/template files
        //echo $this->getResult(); //It is not phtml file that's why I have commented it
        echo "<br>".$block->getResult(); //It is not phtml file that's why I have commented it
        echo "<br>".$block->getLayout()->createBlock('\Ajindra\BookAppointment\Block\BookAppointment')->getResult(); 
        //or
        //echo "<br>".$this->getLayout()->createBlock('\Ajindra\BookAppointment\Block\BookAppointment')->getResult(); 
        //It is not phtml file that's why I have commented the above line
        //Through above line, you can get another block object & call their functions in .phtml/
        //template file although this template is not mapped to this block in layout/.xml file
        /**** Start: In .phtml/template file, we can access block function as follows **/
     
        /**** Start: Get response(page) build by block & view ****/ 
        $pageFactory = $objectManager->create('\Magento\Framework\View\Result\PageFactory');
        $page = $pageFactory->create();
        //return $page;   //commented because it will result to return the response and 
        //no processing would happen for remaining code
        /**** End: Get response(page) build by block & view ****/
     
        // instance of the admin_role (in magento-2 the table name is 'authorization_role' )
        //$model = Mage::getModel('admin/role');   (This line for magento-1 is equivalent to following line )
        $model = $objectManager->create('\Magento\Authorization\Model\Role');
        // fetch all roles with name of 'Partner', but get only the first item since two roles cannot have same name
        $role = $model->getCollection()
            ->addFieldToFilter('role_name', ['eq' => 'Partner'])
            ->getFirstItem();
        // check to make sure the role exists
        if ($roleId = $role->getId())
        {
            // get a collection of all the user roles having the Staff role id as a parent_id
            $staffUsers = $model->getCollection()
                ->addFieldToFilter('parent_id', ['eq' => $roleId]);
            // ensure the collection has size
            if ($staffUsers->getSize())
            {
                // loop through each object and get the user_id values
                foreach ($staffUsers as $staffUser)
                {
                    // you can still check to make sure the user_id field is not null
                    if ($staffUser->getUserId())
                    {
                        // get the user object and do anything with it
                        //In magento-1: Mage::getModel('admin/user') is equivalent to magento-2: $objectManager->create('\Magento\User\Model\User')
                        $user = $objectManager->create('\Magento\User\Model\User')->load($staffUser->getUserId());
                        $output[$user->getId()] = $user->getFirstName() . " " . $user->getLastName();
                    }
                }
            }
        }
        var_dump($output);
        /*** End: Get users of a particular role in magento **************************************/
        
        
        
        /*** Start: Get Guest orders ************************************************************/
        $orderCollecion = $objectManager->create('\Magento\Sales\Model\ResourceModel\Order\CollectionFactory')
            ->create()
            ->addFieldToSelect('*');
        $orderCollecion->addFieldToFilter(
            'customer_id',
            array(
                'null' => true
            )
        );
        $param = 10;
        $orderCollecion->getSelect()->limit((int)$param);
        
        //var_dump($orderCollecion);
        //Get data from object as an array as following
        var_dump($orderCollecion->getData());
        /*** End: Get Guest orders **************************************************************/
        
        /******** Start: Example of fetching data from table using from, where, etc keyword: ********/ 
        //module-authorization\Model\ResourceModel\Role.php: getRoleUsers
        /******** End: Example of fetching data from table using from, where, etc keyword: ********/
        
        
        
        /**** Start: Get Customer in Magento 2, Table: customer_entity  ************************/
        echo "<br><br>=======================================================<br>Customer<br><br>";
        $customer = $objectManager->create('\Magento\Customer\Model\CustomerFactory')->create();
        $dataItem = $customer->getCollection()->getFirstItem();
        echo "<br>".$dataItem->getId();
        echo "<br>".$dataItem->getName();
        echo "<br>".$dataItem->getEmail();
        echo "<br>".$dataItem->getGender();
        echo "<br>";
        var_dump($dataItem->getDefaultBilling());
        echo "<br>";
        var_dump($dataItem->getDefaultShipping());
        echo "<br>";
        var_dump($customer->load(2)->getEmail());
        echo "<br>";
        var_dump($customer->load(2)->getData());
        /**** End: Get Customer in Magento 2  ************************/
        
        
        
        /**** Start: Get Customer Address in Magento 2 Table: customer_address_entity ***********/
        echo "<br><br>=======================================================<br>Customer Address<br><br>";
        echo 'Jitendra';
        $address = $objectManager->create('\Magento\Customer\Model\AddressFactory')->create();
        echo "<br>";
        var_dump($this->escaper->escapeHtml($address->load(2)->getCity()));
        echo "<br>";
        //var_dump($address->load(1)->getAttributes());
        echo "<br>";
        //var_dump($address->load(1)->getData());
        //die();
        $addressCollection = $address->getCollection();
        $addressCollection->addFieldToFilter('parent_id', array('eq'=>3));
        $addressCollection->getSelect();
        var_dump($addressCollection->getData());
        /**** End: Get Customer Address in Magento 2  ************************/
        
        
        
        /**** Start: Get Catalog Category in Magento 2 Table: catalog_category_entity ***********/
        echo "<br><br>=======================================================<br>Catalog Category<br><br>";
        $category = $objectManager->create('\Magento\Catalog\Model\CategoryFactory')->create();
        $dataItem = $category->getCollection()->getFirstItem();
        echo "<br>".$dataItem->getId();
        echo "<br>".$dataItem->getPath();
        
        $categoryObj = $category->load(2);
        echo "<br>".$categoryObj->getName();
        echo "<br>";
        $childCats = $categoryObj->getChildrenCategories();
        var_dump($childCats->getData());
        echo '<br>----------------------------------------<br>';
        echo 'how to iterate collection object to get entity object like category, customer, product, etc.';
        echo '<br>----------------------------------------<br>';
        foreach ($childCats as $cat) {
            echo "<br>".$cat->getName();
        }
        echo '<br>----------------------------------------<br>';        
        echo "<br>";
        var_dump($categoryObj->getCreatedAt());
        echo "<br>";
        var_dump($categoryObj->getData());
        /**** End: Get Catalog Category in Magento 2 Table: catalog_category_entity  ************/
        
        
        
        /**** Start: Get Catalog Product in Magento 2 Table: catalog_product_entity ***********/
        echo "<br><br>=======================================================<br>Catalog Product<br><br>";
        $product = $objectManager->create('\Magento\Catalog\Model\ProductFactory')->create();
        $dataItem = $product->getCollection()->getFirstItem();
        echo "<br>".$dataItem->getId();
        echo "<br>".$dataItem->getSku();
        
        $productObj = $product->load(2);
        echo "<br>".$productObj->getName();
        echo "<br>";
        $productCats = $productObj->getCategoryCollection();
        var_dump($productCats->getData());
        echo '<br>----------------------------------------<br>';
        echo 'how to iterate collection object to get entity object like category, customer, product, etc.';
        echo '<br>----------------------------------------<br>';
        foreach ($productCats as $cat) {
            echo "<br>".$cat->getPath().' jky '.$cat->getName();
        }
        echo '<br>----------------------------------------<br>';        
        echo "<br>";
        var_dump($productObj->getCreatedAt());
        echo "<br>";
        //var_dump($productObj->getData());  //It is ok, but longer time to load, that's why commented
        /**** End: Get Catalog Product in Magento 2 Table: catalog_product_entity  ************/
        
        
        
        /**** Start: Get Order in Magento 2 Table: sales_order ***********/
        echo "<br><br>=======================================================<br>Sales Order<br><br>";
        $order = $objectManager->create('\Magento\Sales\Model\OrderFactory')->create();
        $dataItem = $order->getCollection()->getFirstItem();
        echo "<br>".$dataItem->getId();
        echo "<br>".$dataItem->getState();
        
        $orderObj = $order->load(3);
        //echo "<br>".$orderObj->getName();
        echo "<br>Partner ID: ";
        var_dump($orderObj->getPartnerId());
        echo "<br>";
        var_dump($orderObj->getCreatedAt());
        echo "<br>";
        var_dump($orderObj->getData());
        
        //start: Get comment of an order
        $order = $objectManager->create('\Magento\Sales\Model\OrderFactory')->create()->loadByIncrementId('000000003');
        $history = $order->getStatusHistoryCollection()
                    ->setOrder('created_at', 'desc')->getFirstItem();
        $comment = $history->getComment();
        //end: Get comment of an order
        /**** End: Get Order in Magento 2 Table: sales_order  ************/
        
        
        /*********** 
        Start: Logging: Psr\Log\LoggerInterface mapped to Magento\Framework\Logger\Monolog 
        that extends Monolog\Logger
        ************/
        /*$logger = $objectManager->create('Psr\Log\LoggerInterface');
        //debug() logs to var/log/debug.log
        $logger->debug('Jitendra Logging debug: '.date('Y-m-d H:i:s').' : This is debug log message');
        //all following functions log to var/log/system.log
        $logger->info('Jitendra Logging info: '.date('Y-m-d H:i:s').' : This is info log message');
        $logger->notice('Jitendra Logging notice: '.date('Y-m-d H:i:s').' : This is notice log message');
        $logger->warning('Jitendra Logging warning: '.date('Y-m-d H:i:s').' : This is warning log message');
        $logger->error('Jitendra Logging error: '.date('Y-m-d H:i:s').' : This is error log message');
        // method “critical” for logging exception from try-catch
        // $this->_logger->critical($e);
        // instance of $e will be converted to string (magic metod __toString() will be called).
        $logger->critical('Jitendra Logging critical: '.date('Y-m-d H:i:s').' : This is critical log message');
        $logger->alert('Jitendra Logging alert: '.date('Y-m-d H:i:s').' : This is alert log message');
        $logger->emergency('Jitendra Logging emergency: '.date('Y-m-d H:i:s').' : This is emergency log message');*/
        /*********** 
        End: Logging: Psr\Log\LoggerInterface mapped to Magento\Framework\Logger\Monolog 
        that extends Monolog\Logger
        ************/
        
        
        /**** Start: Get Invoice in Magento 2 Table: sales_invoice ***********/
        echo "<br><br>=======================================================<br>Sales Invoice<br><br>";
        // Not any separate InvoiceFactory class like OrderFactory
        // Invoice related to order object
        //Magento\Sales\Model\Order\Invoice
        if ($orderObj->hasInvoices()) {
            var_dump($orderObj->getInvoiceCollection());
        }
        
        //start: Get invoice comment
        $invoices = $order->getInvoiceCollection();
        $invoice = $invoices->addFieldToFilter('increment_id', array('eq' => '000000003'))
            ->getFirstItem();
        
        $commentInvoice = $invoice->getCommentsCollection()
            ->setOrder('created_at', 'desc')
            ->getFirstItem()
            ->getComment();
        //end: Get invoice comment
        /**** End: Get Invoice in Magento 2 Table: sales_invoice  ************/
        
        
        
        /**** Start: Get Shipment in Magento 2 Table: sales_shipment ***********/
        echo "<br><br>=======================================================<br>Sales Shipment<br><br>";
        // Magento\Sales\Model\Order\ShipmentFactory but not like OrderFactory to create
        // Shipment object. You would need to provide Order object to create Shipment object from ShipmentFactory
        // Shipment related to order object
        // Magento\Sales\Model\Order\Shipment
        if ($orderObj->hasShipments()) {
            var_dump($orderObj->getShipmentsCollection());
            //other related functions - getShippingAmount(),getShippingCanceled(),getShippingDescription()
            //getShippingDiscountAmount(), getShippingDiscountTaxCompensationAmount(), getShippingInclTax()
            //getShippingInvoiced(), getShippingRefunded(), getShippingTaxAmount(), getShippingTaxRefunded()
        }
        
        //start: Get shipment comment
        $shipments = $order->getShipmentsCollection();
        $shipment = $shipments->addFieldToFilter('increment_id', array('eq' => '000000003'))
            ->getFirstItem();
        
        $commentsShipment = $shipment->getCommentsCollection()
            ->setOrder('created_at', 'desc')
            ->getFirstItem()
            ->getComment();
        //end: Get shipment comment
        /**** End: Get Shipment in Magento 2 Table: sales_shipment  ************/
        
        
        
        /**** Start: Get Creditmemo in Magento 2 Table: sales_creditmemo ***********/
        echo "<br><br>=======================================================<br>Sales Creditmemo<br><br>";
        // Magento\Sales\Model\Order\CreditmemoFactory but not like OrderFactory to create
        // Creditmemo object. You would need to provide Order object to create Creditmemo object from CreditmemoFactory
        // Creditmemo related to order object
        // Magento\Sales\Model\Order\Creditmemo
        if ($orderObj->hasCreditmemos()) {
            var_dump($orderObj->getCreditmemosCollection());
        }
        
        //start: Get credit-memos comment
        $creditMemos = $order->getCreditmemosCollection();
        $creditMemo = $creditMemos->addFieldToFilter('increment_id', array('eq' => '000000002'))
            ->getFirstItem();
        
        $commentCreditMemo = $creditMemo->getCommentsCollection()
            ->setOrder('created_at', 'desc')
            ->getFirstItem()
            ->getComment();
        //end: Get credit-memos comment
        /**** End: Get CreditMemo in Magento 2 Table: sales_creditmemo  ************/
    }
}
