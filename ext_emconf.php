<?php

$EM_CONF['packing_list'] = [
    'title' => 'Packing list',
    'description' => 'Plan your packing list for the next hike and fiddle around with different load outs',
    'category' => 'frontend',
    'state' => 'stable',
    'clearCacheOnLoad' => 0,
    'author' => 'Sebastian Fischer',
    'author_email' => 'typo3@evoweb.de',
    'author_company' => 'evoWeb',
    'version' => '0.0.1',
    'constraints' => [
        'depends' => [
            'php' => '7.2.0-0.0.0',
            'typo3' => '10.4.0-10.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
