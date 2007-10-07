<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2007 Ingo Renner <typo3@ingo-renner.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


/**
 * TIMTAB Feedburner
 *
 * @author	Ingo Renner <typo3@ingo-renner.com>
 * @package	TYPO3
 * @subpackage	tx_timtabfeedburner
 */
class tx_timtabfeedburner {

	var $pageConfig;

	/**
	 * checks whether the current page is a feed and redirects to a
	 * feedburner URL if that's the case
	 *
	 * @return	void
	 */
	function burnIfFeed(&$params) {
		$this->pageConfig = $this->getConfig();

		if(trim($this->pageConfig['feedburnerURL']) != '' && !$this->isFeedburnerClient()) {
			$this->redirectToFeedburner();
		}
	}

	/**
	 * loads the configuration for the current page
	 *
	 * @return	array	TS configuration for the current page
	 */
	function getConfig() {
		$typeNum = t3lib_div::_GET('type');
		$setup   = $GLOBALS['TSFE']->tmpl->setup;

		$pageTypeName = $setup['types.'][$typeNum];

		return $setup[$pageTypeName.'.'];
	}

	/**
	 * checks whether the client requesting the feed is Feedburner itself
	 *
	 * @return	boolean	true in case Feedburner requested the feed, false for anybody else
	 */
	function isFeedburnerClient() {
		return preg_match('/feedburner|feedvalidator/i', $_SERVER['HTTP_USER_AGENT']);
	}

	/**
	 * redirects the request to the Feedburner URL
	 *
	 * @return	void
	 */
	function redirectToFeedburner() {
		header('Location:' . trim($this->pageConfig['feedburnerURL']));
		header('HTTP/1.1 307 Temporary Redirect');

		exit;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/timtab_feedburner/class.tx_timtabfeedburner.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/timtab_feedburner/class.tx_timtabfeedburner.php']);
}

?>