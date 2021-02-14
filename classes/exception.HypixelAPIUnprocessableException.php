<?php 

	/**
	 * [EXCEPTION] 例外クラス(処理不可) (HypixelAPIUnprocessableException)
	 * 
	 * HypixelAPIが処理出来なかった場合に発生する。
	 * 
	 * @access public
	 * @author Tateshiki0529 <lab@ttsk3.net>
	 * @copyright Tateshiki Lab. All Rights Reserved.
	 * @package Exception
	 */
	class HypixelAPIUnprocessableException extends Exception {
		private $textFormat = "HypixelAPIでエラーが発生しました。再度やり直してください。";
		/**
		 * [INIT] コンストラクタ (__construct)
		 * 
		 * 例外を発生させる。
		 * 
		 * @throws HypixelAPIUnprocessableException APIが処理できなかった場合に発生する
		 * @see HypixelAPI::get* (Referrence: class.HypixelAPI.php)
		 */
		public function __construct() {
			parent::__construct($this->textFormat);
		}
	}
?>