<?php

$languageFile = 'LLL:EXT:packing_list/Resources/Private/Language/locallang_tca.xlf:';

return [
    'ctrl' => [
        'title' => $languageFile . 'tx_packinglist_domain_model_listing',
        'label' => 'name',
        'label_alt' => 'owner',
        'label_alt_force' => true,
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
                owner,
                public,
                shared,
                categories,
                list_items,
            '
        ]
    ],

    'columns' => [
        'name' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listing.name',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 255,
                'eval' => 'trim,required',
                'autocomplete' => false,
            ]
        ],
        'owner' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listing.owner',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'foreign_table_where' => 'ORDER BY fe_users.username',
                'minitems' => 1,
            ]
        ],
        'public' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listing.public',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
            ]
        ],
        'shared' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listing.shared',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
            ]
        ],
        'categories' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listing.categories',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_packinglist_domain_model_category',
                'foreign_field' => 'listing',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                ]
            ]
        ],
        'list_items' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listing.list_items',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_packinglist_domain_model_listitem',
                'foreign_field' => 'listing',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'category' => [
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
