<?php

namespace Abzertech\Smtp\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Data Helper
 */
class Data extends AbstractHelper
{

    /**
     * @var null $storeId
     */
    protected $storeId = null;

    /**
     * @var bool $testMode
     */
    protected $testMode = false;

    /**
     * @var array $testConfig
     */
    protected $testConfig = [];

    /**
     * Get Test Config Data.
     *
     * @param null $key
     * @return array|string
     */
    public function getTestConfig($key = null)
    {
        if ($key === null) {
            return $this->testConfig;
        } elseif (!array_key_exists($key, $this->testConfig)) {
            return '';
        } else {
            return $this->testConfig[$key];
        }
    }

    /**
     * Set Test Config Data.
     *
     * @param null $fields
     * @return $this
     */
    public function setTestConfig($fields)
    {
        $this->testConfig = (array) $fields;
        return $this;
    }

    /**
     * @param null $store_id
     * @return bool
     */
    public function isActive($store_id = null)
    {
        if ($store_id == null && $this->getStoreId() > 0) {
            $store_id = $this->getStoreId();
        }

        return $this->scopeConfig->isSetFlag(
            'abzer/smtp/active',
            ScopeInterface::SCOPE_STORE,
            $store_id
        );
    }

    /**
     * Get local client name
     *
     * @param ScopeInterface::SCOPE_STORE $store
     * @return string
     */
    public function getConfigName($store_id = null)
    {
        return 'localhost';
    }

    /**
     * Get system config password
     *
     * @param ScopeInterface::SCOPE_STORE $store
     * @return string
     */
    public function getConfigPassword($store_id = null)
    {
        return $this->getConfigValue('password', $store_id);
    }

    /**
     * Get system config username
     *
     * @param ScopeInterface::SCOPE_STORE $store
     * @return string
     */
    public function getConfigUsername($store_id = null)
    {
        return $this->getConfigValue('username', $store_id);
    }

    /**
     * Get system config auth
     *
     * @param ScopeInterface::SCOPE_STORE $store
     * @return string
     */
    public function getConfigAuth($store_id = null)
    {
        return $this->getConfigValue('auth', $store_id);
    }

    /**
     * Get system config ssl
     *
     * @param ScopeInterface::SCOPE_STORE $store
     * @return string
     */
    public function getConfigSsl($store_id = null)
    {
        return $this->getConfigValue('protocol', $store_id);
    }

    /**
     * Get system config host
     *
     * @param ScopeInterface::SCOPE_STORE $store
     * @return string
     */
    public function getConfigSmtpHost($store_id = null)
    {
        return $this->getConfigValue('host', $store_id);
    }

    /**
     * Get system config port
     *
     * @param ScopeInterface::SCOPE_STORE $store
     * @return string
     */
    public function getConfigSmtpPort($store_id = null)
    {
        return $this->getConfigValue('port', $store_id);
    }

    /**
     * Get system config
     *
     * @param String path
     * @param ScopeInterface::SCOPE_STORE $store
     * @return string
     */
    public function getConfigValue($path, $store_id = null)
    {
        //send test mail
        if ($this->isTestMode()) {
            return $this->getTestConfig($path);
        }
       
        return $this->getScopeConfigValue(
            "abzer/smtp/{$path}",
            $store_id
        );
    }

    /**
     * Get Scope Config Value
     *
     * @param String path
     * @param ScopeInterface::SCOPE_STORE $store
     * @return mixed
     */
    public function getScopeConfigValue($path, $store_id = null)
    {
        //use global store id
        if ($store_id === null && $this->getStoreId() > 0) {
            $store_id = $this->getStoreId();
        }
        
        //return value from core config
        return $this->scopeConfig->getValue(
            $path,
            ScopeInterface::SCOPE_STORE,
            $store_id
        );
    }

    /**
     * Get StoreId
     *
     * @return int|null
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * Get StoreId
     *
     * @param int|null $storeId
     */
    public function setStoreId($storeId = null)
    {
        $this->storeId = $storeId;
    }

    /**
     * Get Test Mode
     *
     * @return bool
     */
    public function isTestMode()
    {
        return (bool) $this->testMode;
    }

    /**
     * set Test Mode
     *
     * @param bool $testMode
     * @return Data
     */
    public function setTestMode(bool $testMode)
    {
        $this->testMode = $testMode;
        return $this;
    }
}
