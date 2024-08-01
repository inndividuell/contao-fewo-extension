<?php
// rsce_my_element_config.php
return array(
    'label' => array('Fewo Service Liste', 'Swiper hinzufügen'),
    'types' => array('content', 'module'),
    'standardFields' => array('cssID','cssClass'),
    'contentCategory' => 'texts',
    'fields' => array(
        'size' => array(
            'label' => array('Bildgrößen', ''),
            'inputType' => 'imageSize',
            'options' => \System::getImageSizes()
        ),

    ),
);

?>