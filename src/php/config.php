<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

if (!defined('ROOTPROJECT')) {
    define('ROOTPROJECT', 'D:\SOFT\PROGRAM\OpenServer\domains\iwa_formbuilder');
}

require_once(ROOTPROJECT . '/vendor/autoload.php');

\IWA_FormBuilder\Entity\Service\TranslatorManager::init('ru_RU');
