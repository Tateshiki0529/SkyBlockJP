<?php 

	/**
	 * [EXCEPTION] 例外クラス(ユーザー名該当なし) (UsernameNotFoundException)
	 * 
	 * 入力されたユーザー名が存在しないときに発生する。
	 * 
	 * @access public
	 * @author Tateshiki0529 <lab@ttsk3.net>
	 * @copyright Tateshiki Lab. All Rights Reserved.
	 * @package Exception
	 */
	class UsernameNotFoundException extends Exception {
		private $textFormat = "'%s' というユーザー名は存在しません。";
		/**
		 * [INIT] コンストラクタ (__construct)
		 * 
		 * 例外を発生させる。(Code: 10101)
		 * 
		 * @param string $name 入力されたユーザー名
		 * @throws UsernameNotFoundException ユーザー名が存在しないときの例外
		 * @see MojangAPI::convert2UUID (Referrence: class.MojangAPI.php)
		 */
		public function __construct($name) {
			parent::__construct(sprintf($textFormat, $name), 10101);
		}
	}
?>