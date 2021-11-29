<?php

	/**
	 * Mojang API Exception Class (exceptions.MojangAPI.php)
	 * 
	 * MojangのAPIの例外クラス群。
	 * 
	 * @access public
	 * @author Tateshiki0529
	 * @copyright (C) Tateshiki Lab. All Rights Reserved.
	 * @category Exceptions
	 * @package SkyBlockJP
	**/

	/**
	 * MojangAPIサーバ利用不可 (MojangAPIServerUnavailableException)
	 * 
	 * MojangAPIサーバが利用不可の際にスローされる例外。
	 * 
	 * @access public
	 * @param string ($text エラーテキスト)
	 * @param int ($code エラーコード)
	 * @return Exception MojangAPIServerUnavailableException
	**/
	class MojangAPIServerUnavailableException extends Exception {
		public $text = "Mojangサーバーが現在利用できません。時間をおいて再度やり直してください。";
		public $code = 50001;

		public function __construct($text = null, $code = null) {
			if (!is_null($text)) $this->text = $text;
			if (!is_null($code)) $this->code = $code;

			parent::__construct($this->text, $this->code);
		}
	}

	/**
	 * ユーザー存在なし(ユーザーネーム) (MojangAPIPlayerNotFoundException)
	 * 
	 * Minecraftユーザーが存在しないときに発生する例外。
	 * 
	 * @access public
	 * @param string $name 指定したユーザーネーム
	 * @param string ($text エラーテキスト)
	 * @param int ($code エラーコード)
	 * @return Exception MojangAPIPlayerNotFoundException
	**/
	class MojangAPIPlayerNotFoundException extends Exception {
		public $text = "指定されたユーザー名 {name} が見つかりませんでした。入力を確認して再度お試しください。";
		public $code = 40402;

		public function __construct($name, $text = null, $code = null) {
			if (!is_null($text)) $this->text = $text;
			if (!is_null($code)) $this->code = $code;

			$this->text = str_replace("{name}", $name, $this->text);

			parent::__construct($this->text, $this->code);
		}
	}

	/**
	 * ユーザー存在なし(UUID) (MojangAPIUUIDNotFoundException)
	 * 
	 * Minecraftユーザーが存在しないときに発生する例外。
	 * 
	 * @access public
	 * @param string $uuid 指定したUUID
	 * @param string ($text エラーテキスト)
	 * @param int ($code エラーコード)
	 * @return Exception MojangAPIUUIDNotFoundException
	**/
	class MojangAPIUUIDNotFoundException extends Exception {
		public $text = "指定されたUUID {uuid} が見つかりませんでした。入力を確認して再度お試しください。";
		public $code = 40402;

		public function __construct($uuid, $text = null, $code = null) {
			if (!is_null($text)) $this->text = $text;
			if (!is_null($code)) $this->code = $code;

			$this->text = str_replace("{uuid}", $uuid, $this->text);

			parent::__construct($this->text, $this->code);
		}
	}