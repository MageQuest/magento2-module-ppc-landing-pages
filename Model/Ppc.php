<?php
/**
 * MageQuest - https://magequest.io
 * Copyright © MageQuest. All rights reserved.
 * See LICENSE.md file for details.
 */

declare(strict_types=1);

namespace MageQuest\PpcLandingPages\Model;

use MageQuest\PpcLandingPages\Api\Data\PpcInterface;

class Ppc implements PpcInterface
{
    public function getUrlKey(): string
    {
        return self::URL_KEY;
    }

    public function getLayoutHandle(): string
    {
        return self::LAYOUT_HANDLE;
    }
}
