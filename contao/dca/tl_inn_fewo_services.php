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
$GLOBALS['TL_DCA']['tl_inn_fewo_services'] = array
(
    // Config
    'config' => array
    (
        'label' => 'Services',
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
            'label_callback'            => array('tl_inn_fewo_services', 'getListData')
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
        'default'                     => '{title_legend},title,image,icon,text,short_text,additional_boxes,published;',

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
        'title' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'image' => array
        (
            'inputType'     => 'fileTree',
            'exclude'       => true,
            'eval'          => array('fieldType'=>'radio', 'multiple'=>false, 'files'=>true, 'filesOnly'=>true, 'extensions'=>\Config::get('validImageTypes'), 'isGallery'=>false),
            'sql'           => "blob  NULL",
        ),
        'icon' => array
        (
            'inputType'     => 'fileTree',
            'exclude'       => true,
            'eval'          => array('fieldType'=>'radio', 'multiple'=>false, 'files'=>true, 'filesOnly'=>true, 'extensions'=>\Config::get('validImageTypes'), 'isGallery'=>false),
            'sql'           => "blob  NULL",
        ),
        'short_text' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'sql'                   => 'text  NULL',
            'eval'                  => ['rte'=>'tinyMCE','mandatory'=>false],
        ),
        'text' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'sql'                   => 'text  NULL',
            'eval'                  => ['rte'=>'tinyMCE','mandatory'=>false],
        ),
        'additional_boxes' => array
        (
            'inputType' => 'multiColumnWizard',
            'eval' => array
            (
                'columnFields' => array
                (
                    'headline' => array
                    (
                        'label' => &$GLOBALS['TL_LANG']['tl_table_name']['headline'],
                        'inputType' => 'text',
                    ),
                    'text' => array
                    (
                        'label' => &$GLOBALS['TL_LANG']['tl_table_name']['text'],
                        'inputType' => 'textarea',
                        'eval' => ['rte'=>'tinyMCE'],
                    )
                )
            ),
            'sql' => "blob NULL"
        ),


        'show_on_list' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default ''"
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
class tl_inn_fewo_services extends Backend
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
        } else {
            $objFile = \FilesModel::findByPk($product['icon']);
            if ($objFile->path != '') {
                $logo_path = $objFile->path ;
                $img_error = '';
            }
        }

        $html = '<div class="inn-product-row" style="display: inline-flex;align-items: center;grid-gap:20px;">';
        $html.= '<span class="p-image"><img style="max-width: 100px; max-height: 50px; height: auto;" src="' . $logo_path . '"/></span>';
        $html.= '<span class="title">' . strip_tags($product['title']) . '</span>';
        $html.= '</div>';
        return $html;
    }


}
