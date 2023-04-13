<?php
include('conexaobanco.php')  
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirma_senha = $_POST['confirma_senha'];

$errors = [];

function validarFormulario($nome, $email, $senha, $confirma_senha, &$errors)
{

    //nome validar
    $eValido = true;
    if (strlen($nome) == 0) {
        $eValido = false;
        $errors["nomeError"] = "O campo nome não pode ficar vazio.";
    } else if (strlen($nome) < 3 || strlen($nome) > 50) {
        $eValido = false;
        $errors["nomeError"] =  "O campo nome tem que conter no minimo 3 e no máximo 50 caracteres.";
    }

    //email validar
    if (strlen($email) == 0) {
        $eValido = false;
        $errors["emailError"] =  "O campo e-mail não pode ficar vazio.";
    } else if (!preg_match("/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z\.]{2,})$/", $email)) {
        $eValido = false;
        $errors["emailError"] =  "O e-mail informado não contém  formato válido.";
    }

    //senha validar
    if (strlen($senha) == 0) {
        $eValido = false;
        $errors["senhaError"] =  "O campo senha não pode estar vazio.";
    } else if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/", $senha)) {
        $eValido = false;
        $errors["senhaError"] =  "O campo senha precisa ter no mínimo 8 dígitos. composto por numeros, uma letra maiscula e um caractere especial";
    }

    //confirma senha 
    if ($senha != $confirma_senha) {
        $eValido = false;
        $errors["confirmaError"]  = "O campo senha e confirmação de senha não conferem.";
    }
    
    return $eValido;
}

if(!validarFormulario($nome, $email, $senha, $confirma_senha, $errors)){
    $errors["nome"] = $nome;
    $errors["email"] = $email;
    $arr = json_encode($errors);
    header("Location:cadastro.php?errors=$arr");
    exit;
}

$conn = new mysqli($host.':'.$port, $user, $password, $db);

$sql = "select * from usuario where email = '$email';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $errors["nome"] = $nome;
    $errors["email"] = $email;
    $errors["emailError"] =  "Email já cadastrado.";
    $arr = json_encode($errors);
    header("Location:cadastro.php?errors=$arr");
    exit;
}


$sql = "INSERT INTO usuario (nome, email, senha)
VALUES ('$nome', '$email', '$senha')";


if ($conn->query($sql) === TRUE) {
    $success["nome"] = $nome;
    $success["email"] = $email;
    $success["senha"] = $senha;
    $arr = json_encode($success);
    header("Location:cadastro.php?success=$arr");
    exit;
}


?>
