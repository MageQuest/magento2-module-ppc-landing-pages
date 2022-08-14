<?php
/**
 * MageQuest - https://magequest.io
 * Copyright © MageQuest. All rights reserved.
 * See LICENSE.md file for details.
 */

declare(strict_types=1);

namespace MageQuest\PpcLandingPages\Api\Data;

interface PpcInterface
{
    public const URL_KEY = 'ppc';
    public const LAYOUT_HANDLE = 'ppc';

    public function getUrlKey(): string;

    public function getLayoutHandle(): string;
}
