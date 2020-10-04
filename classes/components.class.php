<?php


class components {

	private $value;

	public function textValue($classname, $msg) {
		$this->value = "<h6 class='$classname'><b>$msg</b></h6>";
		echo $this->value;
	}
}


?>