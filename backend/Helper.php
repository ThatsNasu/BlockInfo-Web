<?php
	class Helper {
		public static function getUrl() {
			if(!empty($_GET['url'])) {
				$arr = explode('/', $_GET['url']);
				if($arr[sizeof($arr)-1] == "") unset($arr[sizeof($arr)-1]);
				return $arr;
			}
			return array();
		}
	}
?>