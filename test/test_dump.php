<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

if (!defined('ROOTPROJECT')) {
    define('ROOTPROJECT', 'D:\SOFT\PROGRAM\OpenServer\domains\iwa_formbuilder');
}

require_once(ROOTPROJECT . '/src/php/config.php');

dump(['key' => 'value']);
dumpn(['key' => 'value'], 'array');
