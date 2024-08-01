<?php
// rsce_my_element_config.php
return array(
    'label' => array('Fewo Booking Badge', 'Headline hinzufügen'),
    'types' => array('content', 'module'),
    'standardFields' => array('cssClass', 'cssID'),
    'contentCategory' => 'texts',
    'fields' => array(
        'icon' => array(
            'label' => array(
                'de' => array('Icon', ''),
            ),
            'inputType' => 'fileTree',
            'eval' => array(
                'fieldType' => 'radio',
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'mandatory' => true,
            ),
        ),
        'url' => array(
            'label' => array('Weiterleitung', ''),
            'inputType' => 'url',
        ),


    ),
);

?>