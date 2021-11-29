<?php

	/**
	 * Mojang API Controller Class (class.MojangAPI.php)
	 * 
	 * MojangのAPIを操作するためのクラス。
	 * 
	 * @access public
	 * @author Tateshiki0529
	 * @copyright (C) Tateshiki Lab. All Rights Reserved.
	 * @category Class
	 * @package SkyBlockJP
	**/

	class MojangAPI {
		private $APIEndpoint;
		private $testUUID;
		private $ctx;
		
		/** 
		 * コンストラクタ (__construct)
		 * 
		 * 引数の初期化とAPIのステータスを確認する。
		 * 
		 * @access public
		 * @param void
		 * @return void
		 * @throws MojangAPIServerUnavailableException MojangAPIサーバ利用不可
		**/
		public function __construct() {
			$this->APIEndpoint = MOJANG_API_ENDPOINT;
			$this->testUUID = "2ecf7fc3de284e969590e3ff401d8c09";
			$this->ctx = stream_context_create([
				"http" => [
					"ignore_errors" => true
				]
			]);

			$tester = file_get_contents($this->APIEndpoint . "/user/profiles/" . $this->testUUID . "/names", false, $this->ctx);

			if (strpos($http_response_header[0], "204") === false) throw new MojangAPIServerUnavailableException();

			return;
		}

		/**
		 * ユーザーネームをUUIDに変換する (convert2UUID)
		 * 
		 * 与えられたユーザーネームをUUID形式に変換する関数。
		 * 
		 * @access public
		 * @param string $name ユーザーネーム
		 * @param bool ($includeHyphens ハイフンを間に挟むかどうか) (Default: true)
		 * @return string $uuid ユーザーのUUID
		 * @throws MojangAPIPlayerNotFoundException ユーザーが存在しないエラー
		**/
		public function convert2UUID(string $name, bool $includeHyphens = true) {
			$data = file_get_contents($this->APIEndpoint . "/users/profiles/minecraft/" . $name, false, $this->ctx);

			if (strpos($http_response_header[0], "204") !== false) throw new MojangAPIPlayerNotFoundException($name);
			if (!$includeHyphens) {
				return json_decode($data, true)["id"];
			} else {
				return preg_replace("/([0-9a-fA-F]{8})([0-9a-fA-F]{4})([0-9a-fA-F]{4})([0-9a-fA-F]{4})([0-9a-fA-F]{12})/", "$1-$2-$3-$4-$5", json_decode($data, true)["id"]);
			}
		}

		/**
		 * UUIDをユーザーネームに変換する (convert2Username)
		 * 
		 * 与えられたUUIDをユーザーネームに変換する関数。
		 * 
		 * @access public
		 * @param string $uuid UUID
		 * @return string $name ユーザーネーム
		 * @throws MojangAPIUUIDNotFoundException ユーザーが存在しないエラー
		**/
		public function convert2Username(string $uuid) {
			$data = json_decode(file_get_contents($this->APIEndpoint . "/user/profiles/" . str_replace("-", "", $uuid) . "/names", false, $this->ctx), true);

			if (strpos($http_response_header[0], "204") !== false) throw new MojangAPIUUIDNotFoundException($uuid);

			return $data[count($data) - 1]["name"];
		}
	}