<?php
include('conexaobanco.php');
session_start();
if(!$_SESSION['usuario']) {
	header('Location: index.php');
	exit();
}

$id = $_SESSION['usuario']['id'];//procura pelo ID, se achar no banco deleta usuario.

$sql = "delete from usuario
where id = $id";

$result = $conn->query($sql);

if(isset($_COOKIE['usuario'])){
    setcookie ("usuario", "", time() - 3600);//faz uma busca do usuario também nos cookies para deletar
}

session_destroy();
header('Location: index.php');

