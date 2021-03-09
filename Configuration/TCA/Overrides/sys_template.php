<?php

defined('TYPO3') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'packing_list',
    'Configuration/TypoScript',
    'Packing List'
);
