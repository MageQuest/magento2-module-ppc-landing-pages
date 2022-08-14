<?php
/**
 * MageQuest - https://magequest.io
 * Copyright © MageQuest. All rights reserved.
 * See LICENSE.md file for details.
 */

declare(strict_types=1);

namespace MageQuest\PpcLandingPages\Observer;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\LayoutInterface;
use Magento\Framework\View\Page\Config as PageConfig;
use MageQuest\PpcLandingPages\Api\Data\PpcInterface;
use MageQuest\PpcLandingPages\Scope\Config as ScopeConfig;

/**
 * If the original request path contains '/ppc/', add '_ppc' suffix
 * to all layout handles to allow different output to standard pages
 * and override meta robots based on configuration value set
 */
class UpdateLayout implements ObserverInterface
{
    protected PpcInterface $ppc;
    protected RequestInterface $request;
    protected PageConfig $pageConfig;
    protected ScopeConfig $scopeConfig;

    public function __construct(
        PpcInterface $ppc,
        RequestInterface $request,
        PageConfig $pageConfig,
        ScopeConfig $scopeConfig
    ) {
        $this->ppc = $ppc;
        $this->request = $request;
        $this->pageConfig = $pageConfig;
        $this->scopeConfig = $scopeConfig;
    }

    public function execute(Observer $observer): void
    {
        if (!$this->scopeConfig->isEnabled()) {
            return;
        }

        $requestPath = $this->request->getOriginalPathInfo();
        $ppcUrlKey = $this->ppc->getUrlKey();
        $ppcLayoutHandle = $this->ppc->getLayoutHandle();

        if (strpos($requestPath, "/$ppcUrlKey/") !== false) {

            /** @var LayoutInterface $layout */
            $layout = $observer->getData('layout');
            foreach ($layout->getUpdate()->getHandles() as $handle) {
                if (strpos($handle, "_{$ppcLayoutHandle}") !== 0) {
                    $layout->getUpdate()->addHandle("{$handle}_{$ppcLayoutHandle}");
                }
            }

            if ($this->scopeConfig->overrideMetaRobots()) {
                $this->pageConfig->setRobots($this->scopeConfig->getMetaRobots());
            }
        }
    }
}
