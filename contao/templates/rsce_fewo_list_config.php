<?php
// rsce_my_element_config.php
return array(
    'label' => array('Fewo List/Grid', 'Headline hinzufügen'),
    'types' => array('content', 'module'),
    'standardFields' => array('cssClass', 'cssID'),
    'contentCategory' => 'texts',
    'fields' => array(
        'icon' => array(
            'label' => array(
                'de' => array('Icon für Weiterleitung', ''),
            ),
            'inputType' => 'fileTree',
            'eval' => array(
                'fieldType' => 'radio',
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'mandatory' => true,
            ),
        ),
        'size' => array(
            'label' => array('Bildgrößen', ''),
            'inputType' => 'imageSize',
            'options' => \System::getImageSizes()
        ),

        'boxes' => array(
            'label' => array('Grid Spalten Breakpoints', ''),
            'elementLabel' => '%s. Breakpoint',
            'inputType' => 'list',
            'minItems' => 1,
            'maxItems' => 100,
            'fields' => array(
                'columns' => array(
                    'label' => array('Grid Spalten', ''),
                    'inputType' => 'text',
                ),
                'grid_gap' => array(
                    'label' => array('Gap einstellungen', ''),
                    'inputType' => 'text',
                ),
                'breakpoint' => array(
                    'label' => array('Screen in px für Breakpoint', ''),
                    'inputType' => 'text',
                ),
            )
        )

    ),
);

?>