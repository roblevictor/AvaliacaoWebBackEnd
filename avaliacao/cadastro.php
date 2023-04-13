<?php
    $display = 'none';
    if(isset($_GET['errors'])){
        $errors = json_decode($_GET['errors']);
    }
    
    if(isset($_GET['success'])){
        $success = json_decode($_GET['success']);
    }
?>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="parte2.js" defer></script>
    <title>Back-End</title>
</head>

<body>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
    </head>

    <body>
        <div class="container mx-auto bg-light mt-1 w-90">
            <header class="row">
                <div class="col-sm-9">
                    <h1>Formulario de Cadastro</h1>
                </div>
            </header>
            <article class="col-12">
                <form action="form_dados.php" method="post">
                    <div class="form-group row">
                        <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
                        <div class="col-sm-10">
                            <input class="form-control" placeholder="Digite seu nome" type="text" id="nome" name="nome"
                                 value="<?php if(isset($errors) && isset($errors->nome)) echo  $errors->nome ?>" required><br>
                        </div>
                        <div style="color: blueviolet;">
                        <?php 
                            if(isset($errors) && isset($errors->nomeError)){
                                echo $errors->nomeError;
                            }
                        ?>
                        </div>
                    </div class="col-sm-10">
                    <div class=" form-group row">
                        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                        <div class="col-sm-10">
                            <input type="E-mail" name="email" class="form-control" placeholder="Digite um email"
                                id="email" value="<?php if(isset($errors) && isset($errors->email)) echo  $errors->email ?>"  required
                                ><br>
                        </div>
                        <div style="color: red;">
                        <?php 
                            if(isset($errors) && isset($errors->emailError)){
                                echo $errors->emailError;
                            }
                        ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mensagem" class="col-sm-2 col-form-label">Senha</label>
                        <div class="col-sm-10">
                            <input type="password" id="senha" class="form-control" placeholder="Digite a senha" name="senha"
                               required><br>
                        </div>
                        <div style="color: red;">
                        <?php 
                            if(isset($errors) && isset($errors->senhaError)){
                                echo $errors->senhaError;
                            }
                        ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mensagem" class="col-sm-2 col-form-label">Confirme sua senha</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" placeholder="Confirme sua senha"
                                name="confirma_senha" id="confirma_senha"
                                >
                        </div>
                        <div style="color: red;">
                        <?php 
                            if(isset($errors) && isset($errors->confirmaError)){
                                echo $errors->confirmaError;
                            }
                        ?>
                        </div>
                    </div>
                    
                    <div class="alert alert-success" style="display: <?php if(!isset($success)){ echo 'none;'; } ?>">
                        <b>Os dados foram cadastrados!<br>
                        Nome: <?php if(isset($success) && isset($success->nome)) echo $success->nome   ?> <br>
                        Email: <?php if(isset($success) && isset($success->email)) echo $success->email  ?> <br>
                        Senha: <?php if(isset($success) && isset($success->senha)) echo $success->senha  ?> <br>
                    </div>

                    
                    
                    <div class="padding-bottom: 1.5rem">
                        <div class="button">
                            <button type="submit" class="btn btn-primary my-1"> Enviar</button>
                            <a href="users_cadastrados.php" class="btn btn-success float-right">Usuarios Cadastradas</a>
                        </div>
                </form>
            </article>

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
                integrity="sha384-ZMP7rVo3mIykV+3+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
                crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
                integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
                
                
                </html>
