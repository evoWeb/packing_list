<?php

declare(strict_types=1);

namespace Evoweb\PackingList\ViewHelpers;

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

use Evoweb\PackingList\Utility\Cache;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class CacheViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @var bool
     */
    protected $escapeChildren = false;

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments()
    {
        parent::initializeArguments();

        $this->registerArgument(
            'model',
            'object',
            'Model to get uid of',
            true
        );

        $this->registerArgument(
            'type',
            'string',
            'Typ of model',
            false,
            'listing'
        );
    }

    /**
     * Renders the content minified
     *
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     *
     * @return string
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): string {
        /** @var \TYPO3\CMS\Extbase\DomainObject\AbstractEntity|array $model */
        $model = $arguments['model'];
        $type = $arguments['type'];

        $uid = [];
        if (is_array($model) && isset($model['uid'])) {
            $uid[] = $model['uid'];
        } elseif (is_object($model) && $model instanceof \TYPO3\CMS\Extbase\DomainObject\AbstractEntity) {
            if ($model->_hasProperty('uid')) {
                $uid[] = $model->getUid();
            }
            if ($model->_getProperty('_localizedUid') != $model->getUid()) {
                $uid[] = $model->_getProperty('_localizedUid');
            }
        }

        if (count($uid)) {
            Cache::addCacheTagByModel($uid, $type);
        }

        return '';
    }
}
