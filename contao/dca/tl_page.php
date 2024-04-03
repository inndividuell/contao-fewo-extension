<?php
foreach ($GLOBALS['TL_DCA']['tl_page']['palettes'] as $name => $palette)
{
    if ($name == '__selector__') {
        continue;
    }

    $GLOBALS['TL_DCA']['tl_page']['palettes'][$name] = str_replace('{meta_legend}', '{fewo_legend:hide},fewoPersons,fewoPersonsText,fewoQM,fewoQMText,fewoBeds,fewoBedsText;{meta_legend}', $palette);
    $GLOBALS['TL_DCA']['tl_page']['fields']['type']['eval']['gallery_types'][] = $name;
}
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoPersons'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['fewoPersons'],
    'exclude'               => true,
    'search'                => true,
    'inputType'             => 'text',
    'sql'                   => 'text  NULL'
);
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoPersonsText'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['fewoPersonsText'],
    'exclude'               => true,
    'search'                => true,
    'inputType'             => 'text',
    'sql'                   => 'text  NULL'
);
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoQM'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['fewoQM'],
    'exclude'               => true,
    'search'                => true,
    'inputType'             => 'text',
    'sql'                   => 'text  NULL'
);
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoQMText'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['fewoQMText'],
    'exclude'               => true,
    'search'                => true,
    'inputType'             => 'text',
    'sql'                   => 'text  NULL'
);
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoBeds'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['fewoBeds'],
    'exclude'               => true,
    'search'                => true,
    'inputType'             => 'text',
    'sql'                   => 'text  NULL'
);
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoBedsText'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['fewoBedsText'],
    'exclude'               => true,
    'search'                => true,
    'inputType'             => 'text',
    'sql'                   => 'text  NULL'
);
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoFurnishings'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['fewoFurnishings'],
    'exclude'               => true,
    'search'                => true,
    'inputType'             => 'checkbox',
    'options_callback'        => ['tl_inn_fewo_furnishing', 'getTableLabels'],
    'sql'                   => 'blob  NULL'
);
