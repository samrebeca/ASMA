<?php
$endereco = "localhost";
$usuario = "root";
$senha = "";
$banco = "db_asma";

$MySQLi = new mysqli($endereco,$usuario,$senha,$banco);
if(mysqli_connect_errno()){
	die(mysqli_connect_error());
	exit();
}
mysqli_set_charset($MySQLi,"utf8");

function us_br($data) {
	$data = implode("/",array_reverse(explode("-",$data)));
	return $data;
}

?>
