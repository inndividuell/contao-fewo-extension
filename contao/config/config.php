<?php

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD'], 1, array
(
    'inn_fewo' => array
    ()
));
$GLOBALS['BE_MOD']['inn_fewo']['inn_fewos'] = array(
    'tables' => array('tl_inn_fewos')
);
$GLOBALS['BE_MOD']['inn_fewo']['inn_fewo_furnishing'] = array(
    'tables' => array('tl_inn_fewo_furnishing')
);
$GLOBALS['BE_MOD']['inn_fewo']['inn_fewo_furnishing_list'] = array(
    'tables' => array('tl_inn_fewo_furnishing_list')
);

$GLOBALS['BE_MOD']['inn_fewo']['inn_fewo_services'] = array(
    'tables' => array('tl_inn_fewo_services')
);
$GLOBALS['BE_MOD']['inn_fewo']['inn_fewo_activities'] = array(
    'tables' => array('tl_inn_fewo_activities')
);



