<?php 

	// NBTパーサライブラリ読み込み
	require_once __DIR__."/class.NBT.php";

	/**
	 * [CLASS] NBTパースクラス (NBTParser)
	 * 
	 * HypixelAPIから返されるNBTデータ(gzencode, base64_encode済み)を解析する。
	 * 
	 * @access public
	 * @author Tateshiki0529 <lab@ttsk3.net>
	 * @copyright Tateshiki Lab. All Rights Reserved.
	 * @category Class
	 * @package Parser
	 */
	class NBTParser {
		private $nbt;
		private $type;
		private $nbtClass;
		
		public const NBT_ARMOR = 1;
		public const NBT_QUIVER = 2;
		public const NBT_ENDERCHEST = 3;
		public const NBT_WARDROBE = 4;
		public const NBT_POTION_BAG = 5;
		public const NBT_INVENTORY = 6;
		public const NBT_TALISMAN_BAG = 7;
		public const NBT_CANDY_BAG = 8;

		/**
		 * [INIT] コンストラクタ (__construct)
		 * 
		 * NBTデータとタイプの指定をし、インスタンスを作成する。
		 * 
		 * @access public
		 * @param string $nbt HypixelAPIから返されるNBTデータ
		 * @param int $type NBTのタイプ
		 * @return void (返り値なし)
		 */
		public function __construct($nbt, $type) {
			$this->type = $type;
			$this->nbt = new NBT();
			$this->nbt->loadString(gzdecode(base64_decode($nbt)));
		}

		/**
		 * [PROCESS] パース関数 (parseNBT)
		 * 
		 * NBTを指定された形式でパースする。
		 * 
		 * @access public
		 * @return array $nbt パースしたNBT
		 */
		public function parseNBT() {
			switch($this->type) {
				case self::NBT_ARMOR:
					$rawdata = $this->nbt->result[""]["i"];
					$i = 0;
					foreach ($rawdata as $v) {
						switch ($i) {
							case 0:
								$itemType = "Boots";
								break;
							case 1:
								$itemType = "Leggings";
								break;
							case 2:
								$itemType = "Chestplate";
								break;
							case 3:
								$itemType = "Helmet";
								break;
						}
						$nbt[$itemType]["itemId"] = $v["id"];
						$nbt[$itemType]["itemName"] = $v["tag"]["display"]["Name"];
						$nbt[$itemType]["itemLore"] = $v["tag"]["display"]["Lore"];
						$nbt[$itemType]["itemEnchants"] = $v["tag"]["ExtraAttributes"]["enchantments"];
						$nbt[$itemType]["itemTextId"] = $v["tag"]["ExtraAttributes"]["id"];
						$nbt[$itemType]["itemTextReforge"] = $v["tag"]["ExtraAttributes"]["modifier"];
						$i++;
					}
					break;
				default:
					throw new NBTParseTypeUndefinedException();
					break;
			}

			return $rawdata;
		}
	}
?>