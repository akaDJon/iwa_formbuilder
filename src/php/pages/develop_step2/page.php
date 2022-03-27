<?php

dumpn($_POST, '$_POST');

/////////////////////////////////////////////////////////////////////

$source = file_get_contents(dirname(__FILE__) . '/form.xml');
$form   = new \IWA_FormBuilder\Form\Form();
//$form->dump = 1;
//$form->dump = 2;
$form->setPrefix('myjform');
$form->setData((array)($_POST['myjform'] ?? []));
echo $form->parseAndRender('xml', $source);
