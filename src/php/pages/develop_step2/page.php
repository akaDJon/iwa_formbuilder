<?php

dumpn($_POST, '$_POST');

$subpage = (!empty($_GET['subpage']) ? $_GET['subpage'] : '1');

/////////////////////////////////////////////////////////////////////
if ($subpage == 1) {
    $source     = file_get_contents(dirname(__FILE__) . '/form1.xml');
    $form       = new \IWA_FormBuilder\Form\Form();
    $form->dump = 1;
//$form->dump = 2;
    $form->setPrefix('myjform');
    $form->handleRequest();
    echo $form->parseAndRender('xml', $source);
}

if ($subpage == 2) {
    $source     = file_get_contents(dirname(__FILE__) . '/form2.xml');
    $form       = new \IWA_FormBuilder\Form\Form();
    $form->dump = 1;
//$form->dump = 2;
    $form->setPrefix('myjform');
    $form->handleRequest();
    echo $form->parseAndRender('xml', $source);
}

if ($subpage == 3) {
    $source     = file_get_contents(dirname(__FILE__) . '/form3.xml');
    $form       = new \IWA_FormBuilder\Form\Form();
    $form->dump = 1;
//$form->dump = 2;
    $form->setPrefix('myjform');
    $form->handleRequest();
    echo $form->parseAndRender('xml', $source);
}

if ($subpage == 4) {
    $source     = file_get_contents(dirname(__FILE__) . '/form4.xml');
    $form       = new \IWA_FormBuilder\Form\Form();
    $form->dump = 1;
//$form->dump = 2;
    $form->setPrefix('myjform');
    $form->handleRequest();
    echo $form->parseAndRender('xml', $source);
}
