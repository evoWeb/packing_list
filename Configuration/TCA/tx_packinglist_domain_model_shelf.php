<?php

$languageFile = 'LLL:EXT:packing_list/Resources/Private/Language/locallang_tca.xlf:';

return [
    'ctrl' => [
        'title' => $languageFile . 'tx_packinglist_domain_model_shelf',
        'label' => 'owner',
        'default_sortby' => 'crdate',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',

        'searchFields' => 'owner',
        'iconfile' => 'EXT:store_finder/Resources/Public/Icons/tx_storefinder_domain_model_location.gif',
    ],

    'types' => [
        '0' => [
            'showitem' => '
                owner,
                list_items,
            '
        ]
    ],

    'columns' => [
        'owner' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_shelf.owner',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'foreign_table_where' => 'ORDER BY fe_users.username',
                'minitems' => 1,
            ]
        ],
        'list_items' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_shelf.list_items',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_packinglist_domain_model_listitem',
                'foreign_field' => 'shelf',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                ]
            ]
        ],
    ]
];
