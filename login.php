<?php 
include("config2.php");
include("verifica2.php");
$msg=0;
//Verifica o banco de dados se o e-mail e a senha estão no banco de dados e se a conta está habilitada
if(isset($_POST['email'])) {
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$consulta = $MySQLi->query("SELECT * FROM
       TB_USUARIOS WHERE USU_EMAIL = '$email'
       AND USU_SENHA = '$senha' AND USU_SITUACAO = 1");
	if($resultado = $consulta->fetch_assoc()){
    	$_SESSION['codigousuario'] = $resultado['USU_CODIGO'];
        $_SESSION['nomeusuario'] = $resultado['USU_NOME'];
        header("Location: index.php");
    }
$msg = 1;
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/logo2.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>ASMA - login</title>

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
            <form action="?" method="POST">
                <div class="row">
                    <div class="author">
                        <center>
                            <img class="img-circle img-no-padding img-responsive" width = "35%" src="assets/img/foto de perfil.png" alt="..."/> 
                        </center>              
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label style="color: #F2EFE4">E-mail:</label>
                            <input name = "email" class="form-control border-input" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label style="color: #F2EFE4">Senha:</label>
                            <input  type="password" name = "senha" class="form-control border-input" required>
                            <a href="esqsenha.php" style="color: #F24C3D">Esqueci minha senha</a>
                        </div>
                    </div>       
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php if($msg==1) echo '<div class="alert alert-danger">
                        <span><b> Usuário/Senha inválido ou Conta desativada</span>
                        </div>'; ?>
                        
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-info btn-fill btn-wd">LOGAR</button>
                </div>
                <br>
                <div class="text-center" style="color: #F2EFE4">
                    ou <a href="criar conta.php">CRIAR CONTA</a>
                </div>
                <div class="text-left">
                    <button onclick="history.go(-1)" class="btn btn-primary btn-fill btn-wd" style="color: #F2EFE4; float: left">Voltar</button>
                </div>
            </form>
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
