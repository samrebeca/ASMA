<?php 
include("config2.php");
include("verifica.php");
include("top.php");
$codigousuario = $_SESSION['codigousuario'];
//Variável usada para forçar a atualização da imagem no cache do navegador
$aux = uniqid(time());
if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $csenha = $_POST['senhac'];
    if($csenha!=$senha){
        echo
        "<script>
        confirm('As senhas são diferentes');
        location.href = 'perfil-editar.php';
        </script>";
    }else{
        if(isset($_FILES['imagem'])){
            $imagem = $_FILES['imagem'];
            $nomeImagem = $_POST['imagemNome'];
            //Subistitui o antigo arquivo da imagem por um novo
            move_uploaded_file($imagem['tmp_name'], $nomeImagem);
        }
        $editar = $MySQLi->query("UPDATE TB_USUARIOS SET USU_NOME='$nome', USU_USUARIO='$usuario', USU_EMAIL='$email', USU_CPF='$cpf', USU_TELEFONE='$telefone', USU_SENHA ='$senha' WHERE USU_CODIGO = '$codigousuario'");
        echo
            "<script>
            location.href = 'perfil.php';
            </script>";
    }
}

$consultacod = $MySQLi->query("SELECT * FROM TB_USUARIOS WHERE USU_CODIGO = '$codigousuario'");
$resultadocod = $consultacod->fetch_assoc();
?>

<div class="main-panel">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div style="display: flex;justify-content: space-between;align-items: center;">
            <a class="navbar-brand" href="#">Editar Perfil</a>
                <button class="btn btn-dark btn-fill btn-wd" id="show-menu" data-clique="false">Menu</button>
            </div>
        </div>
    </nav>
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card"><div class="content">
                    <div class="content">
                        <form action = "?" method = "POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" placeholder="<?php echo $resultadocod['USU_NOME'];?>" value="<?php echo $resultadocod['USU_NOME'];?>" class="form-control border-input" name="nome" required>
                                    </div>
                                </div>
                                <div class="col-md-2 ">
                                    <center>
                                        <img class="img-circle img-no-padding img-responsive " width = "70%" src="<?php echo $resultadocod['USU_FOTO']."?".$aux;?>" alt="..."/>
                                    </center>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" placeholder="<?php echo $resultadocod['USU_EMAIL'];?>" value="<?php echo $resultadocod['USU_EMAIL'];?>"class="form-control border-input" name = "email" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nome de Usuário</label>
                                        <input type="text" placeholder="<?php echo $resultadocod['USU_USUARIO'];?>" value="<?php echo $resultadocod['USU_USUARIO'];?>" class="form-control border-input" name = "usuario" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <input type="file" placeholder="<?php echo $resultadocod['USU_USUARIO'];?>" value="<?php echo $resultadocod['USU_USUARIO'];?>" class="form-control border-input" name = "imagem">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CPF</label>
                                        <input type="text" placeholder="<?php echo $resultadocod['USU_CPF'];?>" value="<?php echo $resultadocod['USU_CPF'];?>"class="form-control border-input" name = "cpf" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <input type="telefone" placeholder="<?php echo $resultadocod['USU_TELEFONE'];?>" value="<?php echo $resultadocod['USU_TELEFONE'];?>" class="form-control border-input" name = "telefone" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Senha</label>
                                        <input type="password" value="<?php echo $resultadocod['USU_SENHA'];?>"class="form-control border-input" name = "senha" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirmar senha</label>
                                        <input type="password" value="<?php echo $resultadocod['USU_SENHA'];?>" class="form-control border-input" name = "senhac" required>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo $resultadocod['USU_FOTO'];?>" class="form-control border-input" name = "imagemNome" required>
                            <div class="text-right">
                                <button type="submit" class="btn btn-info btn-fill btn-wd"><i class="ti-save"></i> Salvar</button>
                                <a style="background-color:#954A4A;border-color: #954A4A; float: left" class="btn btn-info btn-fill btn-wd" href="perfil.php"><i class="ti ti-arrow-circle-left ti-fill"></i>  Voltar </a>
                            </div>

                            <div class="clearfix"></div>
                        </form>  
                    </div>
                </div>
            </div>
        </div>                     
        
        <?php include("bot.php"); ?>


        
        
