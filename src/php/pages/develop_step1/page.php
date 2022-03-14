<?php

/////////////////////////////////////////////////////////////////////
echo '<br/>--- Xml ---';

$start = microtime(true);

$iface = file_get_contents(dirname(__FILE__) . '/form.xml');
$form  = new \IWA_FormBuilder\Form\Format\Xml($iface);
echo $form->generate();

$time = microtime(true) - $start;
echo 'Время выполнения: ' . round($time * 1000, 2) . 'мс<br/>';

/////////////////////////////////////////////////////////////////////
echo '<br/>--- PhpObject ---';

$start = microtime(true);

$iface = include(dirname(__FILE__) . '/form.phpobject.php');
$form  = (new \IWA_FormBuilder\Form\Format\PhpObject($iface));
echo $form->generate();

$time = microtime(true) - $start;
echo 'Время выполнения: ' . round($time * 1000, 2) . 'мс<br/>';

/////////////////////////////////////////////////////////////////////
echo '<br/>--- PhpArray ---';

$start = microtime(true);

$iface = include(dirname(__FILE__) . '/form.phparray.php');
$form  = (new \IWA_FormBuilder\Form\Format\PhpArray($iface));
echo $form->generate();

$time = microtime(true) - $start;
echo 'Время выполнения: ' . round($time * 1000, 2) . 'мс<br/>';

/////////////////////////////////////////////////////////////////////
echo '<br/>--- Json ---';

$start = microtime(true);

$iface = file_get_contents(dirname(__FILE__) . '/form.json');
$form  = (new \IWA_FormBuilder\Form\Format\Json($iface));
echo $form->generate();

$time = microtime(true) - $start;
echo 'Время выполнения: ' . round($time * 1000, 2) . 'мс<br/>';

/////////////////////////////////////////////////////////////////////
echo '<br/>--- Yaml ---';

$start = microtime(true);

$iface = file_get_contents(dirname(__FILE__) . '/form.yaml');
$form  = (new \IWA_FormBuilder\Form\Format\Yaml($iface));
echo $form->generate();

$time = microtime(true) - $start;
echo 'Время выполнения: ' . round($time * 1000, 2) . 'мс<br/>';

/////////////////////////////////////////////////////////////////////
