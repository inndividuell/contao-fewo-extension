<?php
use Contao\Automator;
use Contao\Backend;
use Contao\BackendUser;
use Contao\Config;
use Contao\CoreBundle\Exception\AccessDeniedException;
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Contao\CoreBundle\Util\LocaleUtil;
use Contao\DataContainer;
use Contao\DC_Table;
use Contao\Idna;
use Contao\Image;
use Contao\Input;
use Contao\LayoutModel;
use Contao\Message;
use Contao\Messages;
use Contao\Model;
use Contao\PageModel;
use Contao\StringUtil;
use Contao\System;
use Contao\Versions;

 function getPriceColumns(){
    $options = unserialize(\Config::get('fewoPriceColumns'));
    $returnOptions = array();
    $returnOptions[] = array(
        'label' => 'ReihenWert',
        'inputType' => 'select',
        'options' => getPriceRows()
    );

    foreach ($options as $option){
        $returnOptions[] = array(
            'label' => $option['text'],
            'inputType' => 'text',
        );
    }
    return $returnOptions;
}

function getPriceRows(){
    $options = unserialize(\Config::get('fewoPriceRows'));
    $returnOptions = array();


    foreach ($options as $option){
        $returnOptions[] = $option['text'];
    }
    return $returnOptions;
}

$GLOBALS['TL_DCA']['tl_inn_fewos'] = array
(
    // Config
    'config' => array
    (
        'label' => 'Ferienwohnungen',
        'dataContainer'               => 'Table',
        'enableVersioning'            => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => DataContainer::MODE_TREE,
            'fields'                  => array('id'),
            'panelLayout'             => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('id','image', 'title'),
            'showColumns'             => true,
            'label_callback'            => array('tl_inn_fewos', 'getListData')
        ),
        'global_operations' => array
        (
            'toggleNodes' => array
            (
                'href'                => 'ptg=all',
                'class'               => 'header_toggle',
                'showOnSelect'        => true
            ),
            'all' => array
            (
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'href'                => 'act=edit',
                'icon'                => 'edit.svg',
//				'button_callback'     => array('tl_inn_team_members', 'editPage')
            ),
            'cut' => array
            (
                'href'                => 'act=paste&amp;mode=cut',
                'icon'                => 'cut.svg',
                'attributes'          => 'onclick="Backend.getScrollOffset()"',
//                'button_callback'     => array('tl_page', 'cutPage')
            ),
            'copy' => array
            (
                'href'                => 'act=paste&amp;mode=copy',
                'icon'                => 'copy.svg',
                'attributes'          => 'onclick="Backend.getScrollOffset()"',
//				'button_callback'     => array('tl_inn_team_members', 'copyPage')
            ),

            'delete' => array
            (
                'href'                => 'act=delete',
                'icon'                => 'delete.svg',
                'attributes'          => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\'))return false;Backend.getScrollOffset()"',
//				'button_callback'     => array('tl_inn_team_members', 'deletePage')
            ),
            'toggle' => array
            (
                'href'                => 'act=toggle&amp;field=published',
                'icon'                => 'visible.svg',
//				'button_callback'     => array('tl_inn_team_members', 'toggleIcon')
            ),
            'feature' => array
            (
                'href'                => 'act=toggle&amp;field=featured',
                'icon'                => 'featured.svg',
            ),
            'show' => array
            (
                'href'                => 'act=show',
                'icon'                => 'show.svg'
            ),
        )
    ),

    // Select

    // Palettes

    'palettes' => array
    (
        'default'                     => '{title_legend},name,name_for_list,list_additional_text,additional_name,image,text,detail_page,custom_url,published;{data_legend},galleryImages,sliderImages,persons,beds,qm,level,balconies,parking_slots,bathrooms,furnishings,furnishings_list_elements;{pricing_legend},price_for_list,simple_price,simple_price_additional,simple_price_tax,prices;{address_legend},address_street,address_city,address_postcode;',

    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'label'                   => array('ID'),
            'search'                  => true,
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default 0"
        ),
        'sorting' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default 0"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default 0"
        ),
        'name' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'sql'                   => 'text  NULL',
            'eval'                  => ['rte'=>'tinyMCE','mandatory'=>true],
        ),
        'name_for_list' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'sql'                   => 'text  NULL',
            'eval'                  => ['rte'=>'tinyMCE','mandatory'=>false],
        ),
        'list_additional_text' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'sql'                   => 'text  NULL',
            'eval'                  => ['rte'=>'tinyMCE','mandatory'=>false],
        ),
        'additional_name' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'image' => array
        (
            'inputType'     => 'fileTree',
            'exclude'       => true,
            'eval'          => array('fieldType'=>'radio', 'multiple'=>false, 'files'=>true, 'filesOnly'=>true, 'extensions'=>\Config::get('validImageTypes'), 'isGallery'=>false),
            'sql'           => "blob  NULL",
        ),
        'galleryImages' => array
        (
            'inputType'     => 'fileTree',
            'exclude'       => true,
            'eval'          => array('fieldType'=>'checkbox', 'orderField'=>'galleryImagesOrder', 'multiple'=>true, 'files'=>true, 'filesOnly'=>true, 'extensions'=>\Config::get('validImageTypes'), 'isGallery'=>false),
            'sql'           => "blob NULL",
        ),
        'galleryImagesOrder' => array
        (
            'eval'          => array('doNotShow'=>true),
            'sql'           => "blob NULL",
        ),
        'sliderImages' => array
        (
            'inputType'     => 'fileTree',
            'exclude'       => true,
            'eval'          => array('fieldType'=>'checkbox', 'orderField'=>'sliderImagesOrder', 'multiple'=>true, 'files'=>true, 'filesOnly'=>true, 'extensions'=>\Config::get('validImageTypes'), 'isGallery'=>false),
            'sql'           => "blob NULL",
        ),
        'sliderImagesOrder' => array
        (
            'eval'          => array('doNotShow'=>true),
            'sql'           => "blob NULL",
        ),

        'address_street' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'address_city' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'address_postcode' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),

        'persons' => array
        (
            'exclude'                 => true,
            'fewo_field'              => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'beds' => array
        (
            'exclude'                 => true,
            'fewo_field'              => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'qm' => array
        (
            'exclude'                 => true,
            'fewo_field'              => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'parking_slots' => array
        (
            'exclude'                 => true,
            'fewo_field'              => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'bathrooms' => array
        (
            'exclude'                 => true,
            'fewo_field'              => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'level' => array
        (
            'exclude'                 => true,
            'fewo_field'              => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'balconies' => array
        (
            'exclude'                 => true,
            'fewo_field'              => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'furnishings' => array
        (
            'exclude'               => true,
            'search'                => true,
            'inputType'             => 'checkbox',
            'eval'                    => ['multiple'=>true],
            'options_callback'        => ['tl_inn_fewos', 'getTableLabels'],
            'sql'                   => 'blob  NULL'
        ),
        'furnishings_list_elements' => array
        (
            'exclude'               => true,
            'search'                => true,
            'inputType'             => 'checkbox',
            'eval'                    => ['multiple'=>true],
            'options_callback'        => ['tl_inn_fewos', 'getFurnishingListItems'],
            'sql'                   => 'blob  NULL'
        ),
        'detail_page' => array
        (
            'exclude'                 => true,
            'inputType'               => 'pageTree',
            'eval'                    => array('fieldType'=>'radio'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
            'foreignKey'              => 'tl_page.title',
            'relation'                => array('type'=>'belongsTo', 'load'=>'lazy'),
        ),
        'price_for_list' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'sql'                   => 'text  NULL',
            'eval'                  => ['rte'=>'tinyMCE','mandatory'=>false],
        ),
        'simple_price' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'sql'                   => 'text  NULL',
            'eval'                  => ['rte'=>'tinyMCE','mandatory'=>false],
        ),
        'simple_price_additional' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'sql'                   => 'text  NULL',
            'eval'                  => ['rte'=>'tinyMCE','mandatory'=>false],
        ),
        'simple_price_tax' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'sql'                   => 'text  NULL',
            'eval'                  => ['rte'=>'tinyMCE','mandatory'=>false],
        ),

        'prices' => array
        (
            'inputType' => 'multiColumnWizard',
            'eval' => array
            (
                'columnFields' =>  getPriceColumns()
            ),
            'sql' => "blob NULL"
        ),
        'custom_url' => array
        (
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array('rgxp'=>'url', 'maxlength'=>255),
            'sql' => "varchar(255) NOT NULL default ''",
        ),

        'published' => array
        (
            'exclude'                 => true,
            'toggle'                  => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('doNotCopy'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'featured' => array
        (
            'exclude'                 => true,
            'toggle'                  => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('doNotCopy'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
    )
);

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_inn_fewos extends Backend
{
    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import(BackendUser::class, 'User');
    }

    public function getListData($product,$label) {
        $objFile = \FilesModel::findByPk($product['image']);
        if ($objFile->path != '') {
            $logo_path = $objFile->path ;
            $img_error = '';
        }
        $html = '<div class="inn-product-row" style="display: inline-flex;align-items: center;grid-gap:20px;">';
        $html.= '<span class="p-image"><img style="max-width: 100px; max-height: 50px; height: auto;" src="' . $logo_path . '"/></span>';
        $html.= '<span class="title">' . strip_tags($product['name']) . '</span>';
        $html.= '</div>';
        return $html;
    }
    public function getTableLabels()
    {
        $options = \Database::getInstance()->query("SELECT id,title FROM tl_inn_fewo_furnishing WHERE published=1 ORDER BY title")->fetchAllAssoc();
        $return_array = array();
        foreach ($options as $option){
            $return_array[$option['id']] = $option['title'];
        }
        return $return_array;
    }
    public function getFurnishingListItems()
    {
        $option_groups = \Database::getInstance()->query("SELECT id,title FROM tl_inn_fewo_furnishing_list WHERE published=1 AND type='group' ORDER BY sorting ASC")->fetchAllAssoc();
        $return_array = array();
        foreach ($option_groups as $option_group){

            $options = \Database::getInstance()->query("SELECT id,title FROM tl_inn_fewo_furnishing_list WHERE published=1 AND type='furnishing' AND pid=" . $option_group['id'] . " ORDER BY sorting ASC")->fetchAllAssoc();
            foreach ($options as $option) {
                $return_array[$option_group['title']][$option['id']] = $option['title'];
            }
        }
        return $return_array;
    }



}
