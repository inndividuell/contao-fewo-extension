<?php
$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace(';{protected_legend', '{fewo_legend:hide},fewoPriceColumns,fewoPriceRows;{protected_legend}', $GLOBALS['TL_DCA']['tl_page']['palettes']['root']);

$GLOBALS['TL_DCA']['tl_page']['fields']['fewoPriceColumns'] = array
(
    'inputType' => 'multiColumnWizard',
    'eval' => array
    (
        'columnFields' => array
        (
            'text' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_table_name']['text'],
                'inputType' => 'textarea',
                'eval' => ['rte'=>'tinyMCE'],
            )
        )
    ),
    'sql' => "blob NULL"
);
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoPriceRows'] = array
(
    'inputType' => 'multiColumnWizard',
    'eval' => array
    (
        'columnFields' => array
        (
            'text' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_table_name']['text'],
                'inputType' => 'textarea',
                'eval' => ['rte'=>'tinyMCE'],
            )
        )
    ),
    'sql' => "blob NULL"
);
