<?php
use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\CoreBundle\Exception\PaletteNotFoundException;
use Contao\Controller;
use Contao\Database;
foreach ($GLOBALS['TL_DCA']['tl_page']['palettes'] as $name => $palette)
{
    if ($name == '__selector__') {
        continue;
    }

    $GLOBALS['TL_DCA']['tl_page']['palettes'][$name] = str_replace('{meta_legend}', '{fewo_legend:hide},fewoName,fewoListText1,fewoListText2,fewoImage,fewoSliderImages,fewoPersons,fewoPersonsText,fewoQM,fewoQMText,fewoBeds,fewoBedsText,fewoFurnishings;{meta_legend}', $palette);
    $GLOBALS['TL_DCA']['tl_page']['fields']['type']['eval']['gallery_types'][] = $name;
}
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoImage'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['fewoImage'],
    'inputType'     => 'fileTree',
    'exclude'       => true,
    'eval'          => array('fieldType'=>'radio', 'multiple'=>false, 'files'=>true, 'filesOnly'=>true, 'extensions'=>\Config::get('validImageTypes'), 'isGallery'=>false),
    'sql'           => "blob NULL",
);
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoSliderImages'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['fewoSliderImages'],
    'inputType'     => 'fileTree',
    'exclude'       => true,
    'eval'          => array('fieldType'=>'radio', 'orderField'=>'fewoImageOrder', 'multiple'=>false, 'files'=>true, 'filesOnly'=>true, 'extensions'=>\Config::get('validImageTypes'), 'isGallery'=>false),
    'sql'           => "blob NULL",
);
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoImageOrder'] = array
(
    'eval'          => array('doNotShow'=>true),
    'sql'           => "blob NULL",
);
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoListText1'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['fewoListText1'],
    'exclude'               => true,
    'search'                => true,
    'inputType'             => 'text',
    'sql'                   => 'text  NULL'
);
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoListText2'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['fewoListText2'],
    'exclude'               => true,
    'search'                => true,
    'inputType'             => 'text',
    'sql'                   => 'text  NULL'
);
$GLOBALS['TL_DCA']['tl_page']['fields']['fewoName'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['fewoName'],
    'exclude'               => true,
    'search'                => true,
    'inputType'             => 'text',
    'sql'                   => 'text  NULL'
);
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
    'eval'                    => ['multiple'=>true],
    'options_callback'        => ['tl_inn_page', 'getTableLabels'],
    'sql'                   => 'blob  NULL'
);
class tl_inn_page {
    public function getTableLabels()
    {
        $options = \Database::getInstance()->query("SELECT id,title FROM tl_inn_fewo_furnishing WHERE published=1 ORDER BY title")->fetchAllAssoc();
        $return_array = array();
        foreach ($options as $option){
            $return_array[$option['id']] = $option['title'];
        }
        return $return_array;
    }
}
