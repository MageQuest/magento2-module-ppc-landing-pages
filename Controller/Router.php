<?php
/**
 * MageQuest - https://magequest.io
 * Copyright © MageQuest. All rights reserved.
 * See LICENSE.md file for details.
 */

declare(strict_types=1);

namespace MageQuest\PpcLandingPages\Controller;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use MageQuest\PpcLandingPages\Api\Data\PpcInterface;
use MageQuest\PpcLandingPages\Scope\Config;

/**
 * If request path contains '/ppc/', remove it so the URL rewrite router
 * can match the original URL successfully and load the relevant page
 */
class Router implements RouterInterface
{
    protected Config $config;
    protected PpcInterface $ppc;

    public function __construct(
        PpcInterface $ppc,
        Config $config
    ) {
        $this->ppc = $ppc;
        $this->config = $config;
    }

    public function match(RequestInterface $request)
    {
        if (!$this->config->isEnabled()) {
            return;
        }

        $requestPath = $request->getPathInfo();
        $ppcUrlKey = $this->ppc->getUrlKey();

        if (strpos($requestPath, "/$ppcUrlKey/") !== false) {
            $request->setPathInfo(
                str_replace("/$ppcUrlKey/", '/', $requestPath)
            );
        }
    }
}
