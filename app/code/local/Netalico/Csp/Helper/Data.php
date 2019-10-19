<?php

class Netalico_Csp_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function isEnabled()
    {
        return Mage::getStoreConfig('csp/config/enabled');
    }
    
    public function getPolicy()
    {
	    if (Mage::getStoreConfig('csp/config/policy')) {
		    if (Mage::getStoreConfig('csp/config/easy_policy')) {
			    return $this->convertToEasyPolicy(Mage::getStoreConfig('csp/config/policy'));
		    }
		    
			return Mage::getStoreConfig('csp/config/policy');    
	    } else {
		    return "default-src 'none'; form-action 'none'; frame-ancestors 'none';";
	    }
    }
    
    public function getReportUri()
    {
	    return "; report-uri " . 'https://' . Mage::getStoreConfig('csp/config/report_uri') . '.report-uri.com/r/d/csp/';
    }
    
    public function getMode()
    {
        return Mage::getStoreConfig('csp/config/mode');
    }
    
    public function getOnlyCheckout()
    {
        return Mage::getStoreConfig('csp/config/only_checkout');
    }
    
    public function getCheckoutUrl()
    {
        return Mage::getStoreConfig('csp/config/checkout_url');
    } 
    
    public function convertToEasyPolicy($policy) {
	   
	    $replacements = array(
		    'connect-src',
		    'default-src',
		    'font-src',
		    'frame-src',
		    'font-src',
		    'img-src',
		    'media-src',
		    'script-src-attr',
		    'script-src-elem',
		    'style-src-attr',
		    'style-src-elem',
		    'form-action',
		    'frame-ancestors',
		    ';'
	    );
	    $policy = str_replace($replacements, '', $policy);
	    $policy = 'default-src ' . $policy;
	    
	    return $policy;	    
	    
    }

}
