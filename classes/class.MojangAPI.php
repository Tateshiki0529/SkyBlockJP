<?php

	// コンフィグ読み込み
	require_once __DIR__."/config.php";

	/**
	 * [CLASS] MojangAPI操作用クラス (MojangAPI)
	 * 
	 * MojangAPIを用いて処理を行う。
	 * 
	 * @access public
	 * @author tateshiki0529 <info@ttsk3.net>
	 * @copyright Tateshiki Lab. All Rights Reserved.
	 * @category Class
	 * @package Controller
	**/
	class MojangAPI {
		private $url;

		/**
		 * [INIT] コンストラクタ (__construct)
		 * 
		 * クラスを使う準備をする。
		 * 
		 * @access public
		 * @return void (返り値なし)
		**/
		public function __construct() {
			$this->url = MOJANG_API_URL;
		}

		/**
		 * [CONVERT] プレイヤー名->UUIDへの変換 (convert2UUID)
		 * 
		 * 与えられたユーザー名をUUIDへ変換する。
		 * 
		 * @access public
		 * @param string $name Minecraftユーザー名
		 * @param integer ($timestamp 基準となるタイムスタンプ) (Default: time())
		 * @return string $uuid ユーザー名に対応したUUID
		 * @throws UsernameNotFountException ユーザー名が存在しないときの例外
		 */
		public function convert2UUID($name, $timestamp = null) {
			if (is_null($timestamp)) $timestamp = time();
			$endpoint = $this->url."/users/profiles/minecraft/".$name;
			$params = "?".http_build_query([
				"at" => $timestamp
			]);
			$data = json_decode(file_get_contents($endpoint.$params), true);
			if (is_null($data)) throw new UsernameNotFountException($name);
			return $data["id"];
		}
	}
?>