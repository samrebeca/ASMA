<?php
//Verifica se o usuário está logado
session_start();
$isMaster = false;
if(!isset($_SESSION['codigousuario'])){
	header("Location: inicio.php");
}else{
	//Define se o usuário é master
	$consulta2 = $MySQLi->query("SELECT USM_USU_CODIGO FROM TB_USUARIOSMASTER;");
	while ($resultado2 = $consulta2->fetch_assoc()) {
		if ($resultado2['USM_USU_CODIGO'] == $_SESSION['codigousuario']) {
			$isMaster = true;
		};
	};
};?>