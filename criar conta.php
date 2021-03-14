<?php 
include("config2.php");
$msg = 0;
if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $csenha = $_POST['senha1'];
    $imagem = $_FILES['foto'];
    $situacao = 1;
    $checagem = $MySQLi->query("SELECT USU_EMAIL FROM TB_USUARIOS;");
    //Verifica se o email indicado no cadastro já existe no banco de dados
    while($check=$checagem->fetch_assoc()){
        if($check['USU_EMAIL']==$email){
            $msg = 3; 
        };
    };
    //Verifica se o nome de usuário indicado no cadastro já existe no banco de dados
    $checagem2 = $MySQLi->query("SELECT USU_USUARIO FROM TB_USUARIOS;");
    while($check2=$checagem2->fetch_assoc()){
        if($check2['USU_USUARIO']==$usuario){
            $msg = 4; 
        };
    };
    //Verifica se as duas senhas são iguais
    if($csenha!=$senha){
        $msg = 1;
    }else if($csenha==$senha&&$msg==0){
        //Verifica a extensão do arquivo da imagem
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $extensao);
        //Cria um nome para essa imagem a partir do tempo atual, de uma forma que esse nome não se repita e criptografado
        $nomeImagem = md5(uniqid(time())).'.'.$extensao[1];
        //Indica a localização que o arquivo deve estar
        $nomeImagem = "assets/img/usuarios/".$nomeImagem;
        //Salva a imagem
        move_uploaded_file($imagem['tmp_name'], $nomeImagem);
        $consulta = $MySQLi->query("INSERT INTO TB_USUARIOS (USU_NOME, USU_USUARIO, USU_EMAIL, USU_CPF, USU_TELEFONE, USU_SENHA, USU_FOTO, USU_SITUACAO) VALUES ('$nome', '$usuario', '$email', '$cpf', '$telefone', '$senha', '$nomeImagem', $situacao)");
        header("Location: login.php");
    };
};
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/logo2.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>ASMA - criar conta</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper" style="display:flex;justify-content:center;align-items:center;background-color: #0D1F26;">
        <div class="content">
            <form action = "?" method = "POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="author">
                        <center>
                            <img class="img-no-padding img-responsive" width = "40%" src="assets/img/logo2.png" alt="..."/> 
                        </center>              
                    </div>      
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label style="color: #F2EFE4">Nome</label>
                            <input type="text" class="form-control border-input" name = "nome" placeholder="João Félix Sequeira" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label style="color: #F2EFE4">Nome de Usuário</label>
                            <input type="text" class="form-control border-input" name = "usuario" placeholder="João, o brabo" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label style="color: #F2EFE4">Email</label>
                            <input type="text" class="form-control border-input" name = "email" placeholder="joaofelix79@outlook.com" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="color: #F2EFE4">CPF</label>
                            <input type="text" class="form-control border-input" name = "cpf" placeholder="123.456.789-00" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="color: #F2EFE4">Telefone</label>
                            <input type="text" class="form-control border-input" name = "telefone" placeholder="12345678910" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="color: #F2EFE4">Senha</label>
                            <input type="password" class="form-control border-input" name = "senha" placeholder="*****" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="color: #F2EFE4">Confirmar Senha</label>
                            <input type="password" class="form-control border-input" name = "senha1" placeholder="****" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label style="color: #F2EFE4">Foto</label>
                        <input  type="file" name = "foto" class="form-control border-input" placeholder=" Disponível" required>
                    </div>
                </div>
                <a href="login.php" style="color: #F24C3D">Já tenho uma conta</a>
                <br>
                <br>
                <div class="text-right">
                    <button type="submit" class="btn btn-danger btn-fill btn-wd">Criar</button>
                    <button onclick="history.go(-1)" class="btn btn-primary btn-fill btn-wd" style="color: #F2EFE4; float: left">Voltar</button>
                </div>
            </form>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <?php 
                    if($msg==1){
                        echo '<div class="alert alert-danger">
                        <span><b> As senhas não batem. Tente novamente. </span>
                        </div>';
                    }if($msg==3){
                        echo '<div class="alert alert-danger">
                        <span><b> Email já cadastrado. </span>
                        </div>';
                    }if($msg==4){
                            echo '<div class="alert alert-danger">
                            <span><b> Nome de usuário já cadastrado. </span>
                            </div>';
                    } 
                    ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>

