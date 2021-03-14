<?php 
include("config2.php");
include("verifica2.php");
$msg=0;
$erro=array();
$ok=0;
if(isset($_POST['email'])){

    $email = $MySQLi->escape_string($_POST['email']);
    $cpf = $MySQLi->escape_string($_POST['cpf']);

    $checagem = $MySQLi->query("SELECT USU_EMAIL, USU_CPF, USU_SENHA FROM TB_USUARIOS;");

    //Verifica se o e-mail e CPF indicam a um msm usuário
    while($check=$checagem->fetch_assoc()){
        if($check['USU_EMAIL']==$email && $check['USU_CPF']==$cpf){
            $senha = $check['USU_SENHA'];
            $ok=1;
        }
    }
    if ($ok==1) {
        echo
        "<script>
        confirm('Sua senha é: '+$senha);
        location.href = 'esqsenha.php';
        </script>";
    }

    if($ok!=1){
        echo
        "<script>
        confirm('E-mail ou CPF incorretos. Tente novamente.');
        location.href = 'esqsenha.php';
        </script>";
    }
    
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/logo2.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>ASMA - Recuperar senha</title>

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

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <link href="assets/css/styleModal.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


</head>
<body>

    <div class="wrapper" style="display:flex;justify-content:center;align-items:center;background-color: #0D1F26;">
        <div class="content">
            <div class="container">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="content">
                        <div class="content">
                            <br>
                            <form action = "?" method = "POST">
                                <div class="author">
                                    <center>
                                        <img class="img-no-padding img-responsive" width = "200px" src="assets/img/logoimg.png" alt="..."/> 
                                        <h3 style="color: #FFFFFF">Recuperar senha</h3>
                                    </center>
                                </div> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="color: #F2EFE4">Email</label>
                                            <input type="text" class="form-control border-input" name = "email" placeholder=" exemplo@hotmail.com" required>
                                        </div>
                                    </div>                                         
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="color: #F2EFE4">CPF</label>
                                            <input type="text" class="form-control border-input" name = "cpf" placeholder="123.456.789-10" required>
                                        </div>
                                    </div>                                         
                                </div>
                                <br>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-danger btn-fill btn-wd">Enviar</button>
                                    <a href="login.php" class="btn btn-primary btn-fill btn-wd" style="color: #F2EFE4; float: left">Voltar</a>
                                </div>
                            </form>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php 
                                    if($msg==1){
                                        echo '<div class="alert alert-danger">
                                        <span><b> Um email foi enviado com sua senha.</span>
                                        </div>';
                                    }else if($msg==2){
                                        echo '<div class="alert alert-danger">
                                        <span><b> Ocorreu um erro no envio. Tente novamente.</span>
                                        </div>';
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>



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

<script src="assets/js/scriptModal.js"></script>

</html>