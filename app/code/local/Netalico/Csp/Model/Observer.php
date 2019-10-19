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

     	if (!$helper->getOnlyCheckout()) {
	 		$this->_enforcePolicy($response, $mode);
	 		return;
     	} else {
	     	if (strpos(Mage::app()->getStore()->getCurrentUrl(), $helper->getCheckoutUrl()) !== false) {
		 		$this->_enforcePolicy($response, $mode);
		 		return;
			}
     	}

    }
    
    private function _enforcePolicy($response, $mode) 
    {
	    $helper = Mage::helper('netalico_csp');
	    
	    switch ($helper->getMode()) {
			case "0": // Wizard
				$response->setHeader("Content-Security-Policy-Report-Only", $helper->getPolicy() . "; report-uri " . $helper->getReportUri() . 'wizard');
				break;
			case "1": // Reporting
				$response->setHeader("Content-Security-Policy-Report-Only", $helper->getPolicy() . "; report-uri " . $helper->getReportUri() . 'reportOnly');
				break;
			case "2": // Enforce
				$response->setHeader("Content-Security-Policy", $helper->getPolicy() . "; report-uri " . $helper->getReportUri() . 'enforce');
				break;

		}
    }
}

?>
