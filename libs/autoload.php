<?php

	/**
	 * Library Autoload Script (autoload.php)
	 * 
	 * ライブラリを一括ロードするスクリプト。
	 * 
	 * @access private
	 * @author Tateshiki0529
	 * @copyright (C) Tateshiki Lab. All Rights Reserved.
	 * @category Loader
	 * @package SkyBlockJP
	**/

	// 設定ファイルの読み込み
	include_once dirname(__FILE__)."/config.php";

	// 例外ファイルの読み込み
	include_once dirname(__FILE__)."/exceptions.MojangAPI.php";
	#include_once dirname(__FILE__)."/exceptions.HypixelAPI.php";

	// クラスファイルの読み込み
	include_once dirname(__FILE__)."/class.MojangAPI.php";
	include_once dirname(__FILE__)."/class.HypixelAPI.php";