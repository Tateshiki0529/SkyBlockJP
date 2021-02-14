<?php 

	/**
	 * [EXCEPTION] 例外クラス(処理不可) (HypixelAPIPlayerNotFoundException)
	 * 
	 * HypixelAPIのデータにプレイヤー情報がなかった場合(未プレイ等)に発生する。
	 * 
	 * @access public
	 * @author Tateshiki0529 <lab@ttsk3.net>
	 * @copyright Tateshiki Lab. All Rights Reserved.
	 * @package Exception
	 */
	class HypixelAPIPlayerNotFoundException extends Exception {
		private $textFormat = "'%s' というユーザー名は存在しません。";
		/**
		 * [INIT] コンストラクタ (__construct)
		 * 
		 * 例外を発生させる。
		 * 
		 * @throws HypixelAPIPlayerNotFoundException プレイヤー情報がなかった場合に発生する
		 * @see HypixelAPI::get* (Referrence: class.HypixelAPI.php)
		 */
		public function __construct($name) {
			parent::__construct(sprintf($this->textFormat, $name));
		}
	}
?>