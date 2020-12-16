<?php

defined('TYPO3_MODE') || die();

call_user_func(function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'PackingList',
        'Display',
        [
            \Evoweb\PackingList\Controller\DisplayController::class => 'list,show,shared'
        ],
        [],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'PackingList',
        'Edit',
        [
            \Evoweb\PackingList\Controller\EditController::class => 'list,edit,share,copy,import'
        ],
        [
            \Evoweb\PackingList\Controller\EditController::class => 'edit,share,copy,import'
        ],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '@import \'EXT:packing_list/Configuration/TsConfig/Page/Mod/Wizards/NewContentElement.tsconfig\''
    );
});
