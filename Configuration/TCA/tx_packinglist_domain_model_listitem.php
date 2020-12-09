<?php

$languageFile = 'LLL:EXT:packing_list/Resources/Private/Language/locallang_tca.xlf:';

return [
    'ctrl' => [
        'title' => $languageFile . 'tx_packinglist_domain_model_listitem',
        'label' => 'name',
        'default_sortby' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',

        'searchFields' => 'name, description, url',
        'iconfile' => 'EXT:store_finder/Resources/Public/Icons/tx_storefinder_domain_model_location.gif',
    ],

    'types' => [
        '0' => [
            'showitem' => '
                name,
                listing,
                category,
                shelf,
                description,
                url,
                --palette--;;values,
            '
        ]
    ],

    'columns' => [
        'name' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listitem.name',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 255,
                'eval' => 'trim,required',
                'autocomplete' => false,
            ]
        ],
        'listing' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listitem.listing',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_packinglist_domain_model_listing',
                'foreign_table_where' => 'ORDER BY tx_packinglist_domain_model_listing.name',
                'items' => [
                    [
                        '',
                        0
                    ],
                ],
            ]
        ],
        'category' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listitem.category',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_packinglist_domain_model_category',
                'foreign_table_where' => 'ORDER BY tx_packinglist_domain_model_category.name',
                'items' => [
                    [
                        '',
                        0
                    ],
                ],
            ]
        ],
        'shelf' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listitem.shelf',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_packinglist_domain_model_shelf',
                'minitems' => 1,
            ]
        ],
        'description' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listitem.description',
            'config' => [
                'type' => 'text',
                'cols' => 50,
                'eval' => 'trim',
            ]
        ],
        'url' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listitem.url',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'size' => 50,
                'eval' => 'trim',
                'autocomplete' => false,
                'fieldControl' => [
                    'linkPopup' => [
                        'options' => [
                            'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
                        ],
                    ],
                ],
            ]
        ],
        'weight' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listitem.weight',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'nospace,trim',
                'autocomplete' => false,
            ]
        ],
        'unit' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listitem.unit',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'size' => 1,
                'default' => 'g',
                'items' => [
                    [
                        'g',
                        'g'
                    ],
                    [
                        'kg',
                        'kg'
                    ],
                    [
                        'lb',
                        'lb'
                    ],
                    [
                        'oz',
                        'oz'
                    ]
                ],
            ]
        ],
        'quantity' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listitem.quantity',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'nospace,trim',
                'autocomplete' => false,
            ]
        ],
        'price' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listitem.price',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'nospace,trim',
                'autocomplete' => false,
            ]
        ],
        'worn' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listitem.worn',
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
        'consumable' => [
            'label' => $languageFile . 'tx_packinglist_domain_model_listitem.consumable',
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
    ],

    'palettes' => [
        'values' => [
            'showitem' => '
                weight,
                unit,
                --linebreak--,
                quantity,
                price,
                --linebreak--,
                worn,
                consumable,
            ',
        ],
    ],
];
