<?php

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD'], 1, array
(
    'inn_fewo' => array
    ()
));
$GLOBALS['BE_MOD']['inn_fewo']['inn_fewo_furnishing'] = array(
    'tables' => array('tl_inn_fewo_furnishing')
);

/**
 * Front end modules
 */
//$GLOBALS['FE_MOD']['perisoft'] = array
//(
//    'pp_project_view'     => 'ModulePpProjectView',
//    'pp_project_view_active'     => 'ModulePpProjectViewActive',
//    'pp_project_view_finished'     => 'ModulePpProjectViewFinished',
//    'pp_project_view_partner'     => 'ModulePpProjectViewPartner',
//    'pp_project_where_plant'     => 'ModulePpProjectWherePlant',
//    'pp_project_gallery'     => 'ModulePpProjectGallery',
//    'pp_update_counters'     => 'ModulePpUpdateCounters',
//);
