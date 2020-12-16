<?php

declare(strict_types=1);

namespace Evoweb\PackingList\Utility;

/*
 * This file is developed by evoWeb.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class Cache
{
    protected static function getCache(): FrontendInterface
    {
        /** @var FrontendInterface $cache */
        static $cache = null;

        if ($cache === null) {
            /** @var CacheManager $cacheManager */
            $cacheManager = GeneralUtility::makeInstance(CacheManager::class);
            $cache = $cacheManager->getCache('pages');
        }

        return $cache;
    }

    public static function flushByTags(array $tags)
    {
        self::getCache()->flushByTags($tags);
    }

    public static function addCacheTags(array $tags)
    {
        self::getTypoScriptFrontendController()->addCacheTags($tags);
    }

    public static function addCacheTagByModel(array $uids, string $type)
    {
        $tags = [];
        foreach ($uids as $uid) {
            $tags[] = 'tx_packinglist_domain_model_' . $type . '_' . $uid;
        }
        self::getTypoScriptFrontendController()->addCacheTags($tags);
    }

    protected static function getTypoScriptFrontendController(): ?TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'];
    }
}
