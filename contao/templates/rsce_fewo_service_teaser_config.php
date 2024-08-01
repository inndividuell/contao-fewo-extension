<?php
// rsce_my_element_config.php
return array(
    'label' => array('Fewo Service Teaser', 'Swiper hinzufügen'),
    'types' => array('content', 'module'),
    'standardFields' => array('cssID','cssClass'),
    'contentCategory' => 'texts',
    'fields' => array(
        'size' => array(
            'label' => array('Bildgrößen', ''),
            'inputType' => 'imageSize',
            'options' => \System::getImageSizes()
        ),
        'text' => array(
            'label' => array('Text', 'Abstand zwischen den Slides'),
            'inputType' => 'text',
            'eval' => array('rte'=>'tinyMCE')
        ),
        'button_text' => array(
            'label' => array('Button Text', 'Abstand zwischen den Slides'),
            'inputType' => 'text',
        ),
        'button_url' => array(
            'label' => array('Button Url', 'Abstand zwischen den Slides'),
            'inputType' => 'url',
        ),
        'button_blank' => array(
            'label' => array('Neuer Tab', 'Abstand zwischen den Slides'),
            'inputType' => 'checkbox',
        ),

    ),
);

?>