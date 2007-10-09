<?php

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['hook_eofe'][] = 'EXT:timtab_feedburner/class.tx_timtabfeedburner.php:tx_timtabfeedburner->burnIfFeed';

?>