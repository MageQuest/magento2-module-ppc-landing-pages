<?php
/**
 * MageQuest - https://magequest.io
 * Copyright © MageQuest. All rights reserved.
 * See LICENSE.md file for details.
 */

declare(strict_types=1);

namespace MageQuest\PpcLandingPages\Scope;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    protected const XML_PATH_ENABLED = 'catalog/ppc_landing_page/enabled';
    protected const XML_PATH_OVERRIDE_META_ROBOTS = 'catalog/ppc_landing_page/override_meta_robots';
    protected const XML_PATH_META_ROBOTS = 'catalog/ppc_landing_page/meta_robots';

    protected ScopeConfigInterface $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function overrideMetaRobots(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_OVERRIDE_META_ROBOTS,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getMetaRobots(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_META_ROBOTS,
            ScopeInterface::SCOPE_STORE
        );
    }
}
