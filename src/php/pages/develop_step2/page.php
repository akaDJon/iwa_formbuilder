<?php

echo '$_POST:';
dump($_POST);

/////////////////////////////////////////////////////////////////////

$source = file_get_contents(dirname(__FILE__) . '/form.xml');
$form   = new \IWA_FormBuilder\Form\Form();
//$form->dump = true;
$form->setPrefix('myjform');
$form->parse('xml', $source);
echo $form->render();

echo '$form->getInputs():';
dump($form->getInputs());
