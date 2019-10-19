<?php

class Netalico_Csp_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function isEnabled()
    {
        return Mage::getStoreConfig('csp/config/enabled');
    }

    public function getPolicy()
    {
        return Mage::getStoreConfig('csp/config/policy');
    }

    public function getReportUri()
    {
        return Mage::getStoreConfig('csp/config/report_uri');
    }

    public function getMode()
    {
        return Mage::getStoreConfig('csp/config/mode');
    }

    public function getCheckoutLockdown()
    {
        return Mage::getStoreConfig('csp/config/checkout_lockdown');
    }

    public function getCheckoutUrl()
    {
        return Mage::getStoreConfig('csp/config/checkout_url');
    }

		public function getDefaultPolicy() {
			return "default-src 'none'; form-action 'none'; frame-ancestors 'none';";
		}

}
