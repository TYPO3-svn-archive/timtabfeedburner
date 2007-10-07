<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if(TYPO3_MODE == 'FE') {
	require_once(t3lib_extMgm::extPath('timtab_feedburner').'class.tx_timtabfeedburner.php');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] = 'tx_timtabfeedburner->burnIfFeed';

?>