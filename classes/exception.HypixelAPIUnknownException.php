<?php 

	/**
	 * [EXCEPTION] 例外クラス(不明なエラー) (HypixelAPIUnknownException)
	 * 
	 * 不明なエラーの時に発生する。
	 * 
	 * @access public
	 * @author Tateshiki0529 <lab@ttsk3.net>
	 * @copyright Tateshiki Lab. All Rights Reserved.
	 * @package Exception
	 */
	class HypixelAPIUnknownException extends Exception {
		private $textFormat = "HypixelAPIで不明なエラーが発生しました。";
		/**
		 * [INIT] コンストラクタ (__construct)
		 * 
		 * 例外を発生させる。
		 * 
		 * @throws HypixelAPIUnknownException 不明なエラーの場合に発生する
		 * @see HypixelAPI::get* (Referrence: class.HypixelAPI.php)
		 */
		public function __construct() {
			parent::__construct($this->textFormat);
		}
	}
?>