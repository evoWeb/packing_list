<?php

defined('TYPO3_MODE') || die();

call_user_func(function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'PackingList',
        'List',
        [
            \Evoweb\PackingList\Controller\ListController::class => 'list,add'
        ],
        [
            \Evoweb\PackingList\Controller\ListController::class => 'add,edit'
        ],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '@import \'EXT:packing_list/Configuration/TsConfig/Page/Mod/Wizards/NewContentElement.tsconfig\''
    );
});
