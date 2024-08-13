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
$GLOBALS['TL_DCA']['tl_inn_fewo_activities'] = array
(
    // Config
    'config' => array
    (
        'label' => 'Ausstattungen',
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
            'label_callback'            => array('tl_inn_fewo_activities', 'getListData')
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
        '__selector__' => ['type'],
        'default'                     => '{title_legend},title,type;',
        'group'                     => '{title_legend},title,type,icon,published;',
        'activity'                     => '{title_legend},title,type,image,text,url,published;',

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
        'type' => array
        (
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'select',
            'eval'                    => array('helpwizard'=>true, 'submitOnChange'=>true),
            'options'               => array(
                'group' => 'Gruppe',
                'activity' => 'Aktivität'
            ),
            'sql'                     => "varchar(64) NOT NULL default 'activity'"
        ),
        'title' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('rte'=>'tinyMCE','mandatory'=>true, 'maxlength'=>1024),
            'sql'                     => "varchar(1024) NOT NULL default ''"
        ),
        'icon' => array
        (
            'inputType'     => 'fileTree',
            'exclude'       => true,
            'eval'          => array('mandatory'=>true,'fieldType'=>'radio', 'multiple'=>false, 'files'=>true, 'filesOnly'=>true, 'extensions'=>\Config::get('validImageTypes'), 'isGallery'=>false),
            'sql'           => "blob  NULL",
        ),
        'image' => array
        (
            'inputType'     => 'fileTree',
            'exclude'       => true,
            'eval'          => array('mandatory'=>true,'fieldType'=>'radio', 'multiple'=>false, 'files'=>true, 'filesOnly'=>true, 'extensions'=>\Config::get('validImageTypes'), 'isGallery'=>false),
            'sql'           => "blob  NULL",
        ),
        'text' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false,'rte'=>'tinyMCE', 'maxlength'=>1024),
            'sql'                     => "varchar(1024) NOT NULL default ''"
        ),
        'url' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
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
class tl_inn_fewo_activities extends Backend
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

    public function getFewoFields()
    {
        \Controller::loadDataContainer('tl_inn_fewos');
        $return_array = array();
        $fewo_fields = $GLOBALS['TL_DCA']['tl_inn_fewos']['fields'];
        foreach ($fewo_fields as $field_name =>$field){
            if(isset($field["fewo_field"])){
                if($field["fewo_field"]){
                    $return_array[$field_name] = $field_name;
                }
            }
        }
        return $return_array;
    }


}
