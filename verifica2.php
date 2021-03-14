<?php
//verifica se o usuário não está logado
session_start();
if(isset($_SESSION['codigousuario'])){
	header("Location: index.php");
}?>