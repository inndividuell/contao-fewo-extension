<?php
// rsce_my_element_config.php
return array(
    'label' => array('Fewo Verfügbarkeitskalender', 'Headline hinzufügen'),
    'types' => array('content', 'module'),
    'standardFields' => array('cssClass', 'cssID'),
    'contentCategory' => 'texts',
    'fields' => array(
        'booking_tool' => array(
            'label' => array('Buchungs Tool', ''),
            'inputType' => 'select',
            'options'=>array(
                'smoobu'=>'Smoobu',
                'easybooking' => 'easybooking',
                'booking' => 'booking.com'
            )
        ),
        'text' => array(
            'label' => array('Url', ''),
            'inputType'         => 'textarea',
            'eval'              => array('allowHtml'=>true, 'class'=>'monospace', 'rte'=>'ace|html', 'helpwizard'=>true),
            'explanation'       => 'insertTags',
            'sql'               => "mediumtext NULL",

        ),



//        'boxes' => array(
//            'label' => array('Grid Spalten Breakpoints', ''),
//            'elementLabel' => '%s. Breakpoint',
//            'inputType' => 'list',
//            'minItems' => 1,
//            'maxItems' => 100,
//            'fields' => array(
//                'columns' => array(
//                    'label' => array('Grid Spalten', ''),
//                    'inputType' => 'text',
//                ),
//                'grid_gap' => array(
//                    'label' => array('Gap einstellungen', ''),
//                    'inputType' => 'text',
//                ),
//                'breakpoint' => array(
//                    'label' => array('Screen in px für Breakpoint', ''),
//                    'inputType' => 'text',
//                ),
//            )
//        )

    ),
);

?>