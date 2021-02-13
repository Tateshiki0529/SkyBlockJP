<?php 

	// クラス読み込み
	require_once __DIR__."/class.MojangAPI.php";

	/**
	 * [API] HypixelAPI操作用クラス (HypixelAPI)
	 * 
	 * HypixelAPIを用いて処理を行う。
	 * 
	 * @access public
	 * @author tateshiki0529 <lab@ttsk3.net>
	 * @copyright Tateshiki Lab. All Rights Reserved.
	 * @category Class
	 * @package Controller
	 */
	class HypixelAPI {
		private $url;
		private $MojangAPI;
		private $id;

		/**
		 * [INIT] コンストラクタ (__construct)
		 * 
		 * 変数の設定を行う。
		 * 
		 * @access public
		 * @param $id ユーザー名もしくはUUID
		 * @return void (返り値なし)
		 */
		public function __construct($id) {
			$this->url = HYPIXEL_API_URL;
			$this->MojangAPI = new MojangAPI();
			if (strlen($id) == 32 or strlen($id) == 36) {
				$this->id = $id;
			} else {
				$this->id = $this->MojangAPI->convert2UUID($id);
			}
		}


	}
?>