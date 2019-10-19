<?php
Class Netalico_Csp_Model_Observer extends Varien_Event_Observer
{
    public function enforce(Varien_Event_Observer $observer)
    {
	    $helper = Mage::helper('netalico_csp');

		if (!$helper->isEnabled()) {
			return;
		}
		
		$controllerAction = $observer->getEvent()->getControllerAction();
     	$response = $controllerAction->getResponse();
     	
     	$policy = $helper->getPolicy();
     	$reportUri = $helper->getReportUri();
     	
     	if ($helper->getCheckoutLockdown()) {
	 		if (strpos(Mage::app()->getStore()->getCurrentUrl(), $helper->getCheckoutUrl()) !== false) {
		 		$response->setHeader("Content-Security-Policy", $policy . "; report-uri " . $reportUri . 'enforce');
		 		return;
			}
	     	
     	}
		
		switch ($helper->getMode()) {
			case "0": // Wizard
				$response->setHeader("Content-Security-Policy-Report-Only", $policy . "; report-uri " . $reportUri . 'wizard');
				break;
			case "1": // Reporting
				$response->setHeader("Content-Security-Policy-Report-Only", $policy . "; report-uri " . $reportUri . 'reportOnly');
				break;
			case "2": // Enforce
				$response->setHeader("Content-Security-Policy", $policy . "; report-uri " . $reportUri . 'enforce');
				break;
			case "3": // Disabled
				break;
				
		}
	    
	
    }
}

?>