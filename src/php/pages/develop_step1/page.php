<?php

/////////////////////////////////////////////////////////////////////
$start = microtime(true);

$source     = file_get_contents(dirname(__FILE__) . '/form.xml');
$form       = new \IWA_FormBuilder\Form\Form();
$form->dump = 1;
$form->parse('xml', $source);

$time = microtime(true) - $start;
echo 'Время выполнения: ' . round($time * 1000, 2) . 'мс<br/>';

/////////////////////////////////////////////////////////////////////
$start = microtime(true);

$source     = include(dirname(__FILE__) . '/form.phpobject.php');
$form       = new \IWA_FormBuilder\Form\Form();
$form->dump = 1;
$form->parse('object', $source);

$time = microtime(true) - $start;
echo 'Время выполнения: ' . round($time * 1000, 2) . 'мс<br/>';

/////////////////////////////////////////////////////////////////////
$start = microtime(true);

/**
 * @var array $iface
 */
$source     = include(dirname(__FILE__) . '/form.phparray.php');
$form       = new \IWA_FormBuilder\Form\Form();
$form->dump = 1;
$form->parse('array', $source);

$time = microtime(true) - $start;
echo 'Время выполнения: ' . round($time * 1000, 2) . 'мс<br/>';

/////////////////////////////////////////////////////////////////////
$start = microtime(true);

$source     = file_get_contents(dirname(__FILE__) . '/form.json');
$form       = new \IWA_FormBuilder\Form\Form();
$form->dump = 1;
$form->parse('json', $source);

$time = microtime(true) - $start;
echo 'Время выполнения: ' . round($time * 1000, 2) . 'мс<br/>';

/////////////////////////////////////////////////////////////////////
$start = microtime(true);

$source     = file_get_contents(dirname(__FILE__) . '/form.yaml');
$form       = new \IWA_FormBuilder\Form\Form();
$form->dump = 1;
$form->parse('yaml', $source);

$time = microtime(true) - $start;
echo 'Время выполнения: ' . round($time * 1000, 2) . 'мс<br/>';

/////////////////////////////////////////////////////////////////////
