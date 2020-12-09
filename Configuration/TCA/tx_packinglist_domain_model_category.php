<?php

$languageFile = 'LLL:EXT:packing_list/Resources/Private/Language/locallang_tca.xlf:';

return [
    'ctrl' => [
        'title' => $languageFile . 'tx_packinglist_domain_model_category',
        'label' => 'name',
        'default_sortby' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',

        'searchFields' => 'name',
        'iconfile' => 'EXT:store_finder/Resources/Public/Icons/tx_storefinder_domain_model_location.gif',
    ],

    'types' => [
        '0' => [
            'showitem' => '
                name,
                listing,
                list_items,
            '
        ]
    ],

    'columns' => [
        'name' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_category.name',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 255,
                'eval' => 'trim,required',
                'autocomplete' => false,
            ]
        ],
        'listing' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_category.listing',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_packinglist_domain_model_listing',
                'foreign_table_where' => 'ORDER BY tx_packinglist_domain_model_listing.name',
                'minitems' => 1,
            ]
        ],
        'list_items' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_category.list_items',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_packinglist_domain_model_listitem',
                'foreign_field' => 'category',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'listing' => [
                            'config' => [
                                'readOnly' => true,
                            ]
                        ],
                        'shelf' => [
                            'config' => [
                                'readOnly' => true,
                            ]
                        ],
                    ],
                ],
            ]
        ],
    ]
];
