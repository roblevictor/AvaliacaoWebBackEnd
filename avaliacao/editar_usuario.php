<?php
include('conexaobanco.php');
session_start();
if (!$_SESSION['usuario'] || !$_POST['nome']) {
    header('Location: index.php');
    exit();
}

$errors = [];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$id = $_SESSION['usuario']['id'];

if (validarFormulario($nome, $senha, $errors)) {

    if ($nome && !empty($senha)) {

        $sql = "update usuario
                set nome = '$nome'
                ,senha = '$senha'
                where id = $id";
        $result = $conn->query($sql);
    }

    if (!empty($nome) && empty($senha)) {
        $sql = "update usuario
                set nome = '$nome'
                where id = $id";
        $result = $conn->query($sql);
    }

    $sql = "select * from usuario where id = $id";
    $result = $conn->query($sql);

    $usuario = $result->fetch_assoc();
    $_SESSION['usuario'] = $usuario;

    if (isset($_COOKIE['usuario'])) {
        $hour = time() + 3600 * 24 * 30;
        setcookie('usuario', json_encode($usuario), $hour);
    }

    header('Location: tela_usuario.php?success=1');
    exit;
} else {
    $arr = json_encode($errors);
    header("Location:tela_usuario.php?errors=$arr");
    exit;
}



function validarFormulario($nome, $senha, &$errors)
{
    //nome validar
    $eValido = true;
    if (strlen($nome) == 0) {
        $eValido = false;
        $errors["nomeError"] = "O campo nome não pode ficar vazio.";
    } else if (strlen($nome) < 3 || strlen($nome) > 50) {
        $eValido = false;
        $errors["nomeError"] = "O campo nome tem que conter no minimo 3 e no máximo 50 caracteres.";
    }

    if (strlen($senha) == 0) {
        $eValido = false;
        $errors["senhaError"] = "O campo senha não pode estar vazio.";
    } else if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/", $senha)) {
        $eValido = false;
        $errors["senhaError"] = "O campo senha precisa ter no mínimo 8 dígitos. composto por numeros, uma letra maiscula e um caractere especial";

    return $eValido;
}