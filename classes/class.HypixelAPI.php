<?php 

	// コンフィグ読み込み
	require_once __DIR__."/config.php";

	// クラス読み込み
	require_once __DIR__."/class.MojangAPI.php";

	// 例外読み込み
	require_once __DIR__."/exception.HypixelAPIUnprocessableException.php";
	require_once __DIR__."/exception.HypixelAPIPlayerNotFoundException.php";
	require_once __DIR__."/exception.HypixelAPIUnknownException.php";

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
		private $key;
		private $MojangAPI;
		private $id;
		private $context;

		private $getPlayer_cache;

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
			$this->key = API_KEY;
			$this->context = stream_context_create(["http" => ["ignore_errors" => true]]);
			$this->MojangAPI = new MojangAPI();
			if (strlen($id) == 32 or strlen($id) == 36) {
				$this->id = str_replace("-", "", $id);
			} else {
				$this->id = $this->MojangAPI->convert2UUID($id);
			}
		}

		/**
		 * [GET] プレイヤー情報取得 (getPlayer)
		 * 
		 * プレイヤー情報を取得して返す。
		 * 
		 * @access public
		 * @return array $data 取得したプレイヤー
		 * @throws HypixelAPIUnprocessableException 処理できなかった場合
		 * @throws HypixelAPIPlayerNotFoundException Hypixelプレイヤーが存在しなかった場合
		 * @throws HypixelAPIUnknownException 不明なエラー
		 */
		public function getPlayer() {
			if (!is_null($this->getPlayer_cache)) return $this->getPlayer_cache;
			$endpoint = $this->url."/player";
			$params = "?".http_build_query([
				"uuid" => preg_replace("/([0-9a-f]{8})([0-9a-f]{4})([0-9a-f]{4})([0-9a-f]{4})([0-9a-f]{12})/", "$1-$2-$3-$4-$5", $this->id),
				"key" => $this->key
			]);
			#var_dump($endpoint.$params);
			$data = json_decode(file_get_contents($endpoint.$params, false, $this->context), true);
			#var_dump($data);
			if (strpos($http_response_header[0], "422") !== false) {
				throw new HypixelAPIUnprocessableException();
			} elseif (is_null($data["player"])) {
				throw new HypixelAPIPlayerNotFoundException();
			} elseif ($data["success"] == false) {
				if (isset($data["cause"])) {
					throw new HypixelAPIUnprocessableException();
				} else {
					throw new HypixelAPIUnknownException();
				}
			}
			if (is_null($this->getPlayer_cache)) $this->getPlayer_cache = $data;
			return $data;
		}

		/**
		 * [TEST] GETリクエスト (get)
		 * 
		 * GETリクエストを送信する。
		 * 
		 * @param string $endpoint エンドポイント
		 * @param array $params パラメータ
		 * @return array $data 取得済みデータ
		 */
		public function get($endpoint, $params) {
			$url = $this->url."/".$endpoint;
			$params = "?".http_build_query($params);
			$data = json_decode(file_get_contents($url.$params, false, $this->context), true);
			return $data;
		}
	}
?>