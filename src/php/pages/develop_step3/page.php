<?php

/////////////////////////////////////////////////////////////////////
dumpn($_POST, '$_POST');

$database = [
    'text1'                           => '1',
    'text2'                           => '2',
    'textinteger'                     => '30000',
    'list'                            => '2',
    'multiple'                        => '1,3',
    'textform_textinteger'            => '4',
    'textform_text'                   => '5',
    'textform_select'                 => '3',
    'textform_multiple'               => '2,3',
    'textform2__textform_textinteger' => '4',
    'textform2__textform_text'        => '5',
    'textform2__textform_select'      => '3',
    'textform2__textform_multiple'    => '2,3',
];
dumpn($database, '$database');

$source = file_get_contents(dirname(__FILE__) . '/form.xml');
$form   = new \IWA_FormBuilder\Form\Form();
$form->setPrefix('myjform');
$form->parse('xml', $source);
$form->setDataDatabase($database);
$form->handleRequest();
if ($form->isSubmitted() and $form->isValid()) {
    //
}
//dump($form->getValidateResult());
echo $form->render();

//if ($form->isSubmitted() and $form->isValid()) {
//    $task = $form->getDataFriendly();
//    $task = $form->getDataDatabase();
//}
//
//echo $form->render();


///////////////////////////////////////////////////////////////////////////////////////
/*
$form->handleRequest();

if (!$form->isSubmitted()) {
    // взять из сессии данные если есть
    if (haveDataInSession()) {
        $data = getDataFromSession();
        $form->setDataSession($data);
    } else {
    $form->setDataDatabase([]);
    $form->setDataFriendly([]);
    }
} else {
    if ($form->isValid()) {
        // можно работать с данными. сохранять в базу например
        $task = $form->getDataFriendly();
        $task = $form->getDataDatabase();

        $form->saveBefore();
        save();
        $form->saveAfter();
    } else {
        // сохранить в сессии данные если будет редирект
        $data = $form->getDataSession();
        saveDataToSession($data);
        redirect();
    }
}
*/