<?php
//$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace(';{chmod_legend', '{fewo_legend:hide},fewoPriceColumns,fewoPriceRows;{chmod_legend}', $GLOBALS['TL_DCA']['tl_page']['palettes']['root']);

$replaceString = '{fewo_legend:hide},fewoPriceColumns,fewoPriceRows';
//$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = str_replace(
//    ';{date_legend}'
//    ,   $replaceString.';{date_legend}'
//    ,   $GLOBALS['TL_DCA']['tl_settings']['palettes']['default']
//);
$dc = &$GLOBALS['TL_DCA']['tl_settings'];
$dc['palettes']['default'] = str_replace('{chmod_legend', $replaceString.';{chmod_legend', $dc['palettes']['default']);


$GLOBALS['TL_DCA']['tl_settings']['fields']['fewoPriceColumns'] = array
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
            )
        )
    ),
    'sql' => "blob NULL"
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['fewoPriceRows'] = array
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
            )
        )
    ),
    'sql' => "blob NULL"
);
