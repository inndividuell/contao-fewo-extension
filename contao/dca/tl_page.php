<?php
//$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace(';{protected_legend', '{fewo_legend:hide},fewoPriceColumns,fewoPriceRows;{protected_legend}', $GLOBALS['TL_DCA']['tl_page']['palettes']['root']);

$replaceString = '{fewo_legend:hide},fewoPriceColumns,fewoPriceRows';
$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace(
    ';{protected_legend'
    ,   $replaceString.';{protected_legend'
    ,   $GLOBALS['TL_DCA']['tl_page']['palettes']['root']
);
if( !empty($GLOBALS['TL_DCA']['tl_page']['palettes']['rootfallback']) ) {
    $GLOBALS['TL_DCA']['tl_page']['palettes']['rootfallback'] = str_replace(
        '{protected_legend'
        ,$replaceString.'{protected_legend'
        ,   $GLOBALS['TL_DCA']['tl_page']['palettes']['rootfallback']
    );
}
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
            )
        )
    ),
    'sql' => "blob NULL"
);
