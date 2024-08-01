<?php
// rsce_my_element_config.php
return array(
    'label' => array('Fewo Detail Headline Lage', 'Headline hinzufügen'),
    'types' => array('content', 'module'),
    'standardFields' => array('cssClass', 'cssID'),
    'contentCategory' => 'texts',
    'fields' => array(
        'headline' => array(
            'label' => array('Überschrift', ''),
            'inputType' => 'text',
            'eval' => array('rte'=>'tinyMCE')
        ),

//        'size' => array(
//            'label' => array('Bildgröße großes Bild', ''),
//            'inputType' => 'imageSize',
//            'options' => \System::getImageSizes()
//        ),
//        'size_small' => array(
//            'label' => array('Bildgrößen kleine Bilder', ''),
//            'inputType' => 'imageSize',
//            'options' => \System::getImageSizes()
//        ),


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