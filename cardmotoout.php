<?php 
include("config2.php");
//Essa página pode ser acessada sem um login, então caso ele já esteja logado e deseje vir para essa página mesmo sem necessidade, ele será redirecionada ao index.
include("verifica2.php");
//Verifica se existe alguma moto selecionada e puxa seus dados
if(isset($_GET['codigo'])){
    $codigo = intval($_GET['codigo']);
    $consulta = $MySQLi->query("SELECT * FROM TB_MOTOS WHERE MOT_CODIGO = $codigo");
    $resultado = $consulta->fetch_assoc();
}else{
    header("Location: index.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/logo2.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>ASMA - Alugue Sua Moto Agora</title>

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
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


</head>
<body style="background-color: #f4f3ef">
    <div class="wrapper" style="background-color: #f4f3ef">
        <div class="sidebar" style="width: 5%; background-color: #0D1F26; top:0; bottom:0; height: 100%; min-height: 100%; float: left; position: fixed;overflow: hidden;">
            <div class="sidebar-wrapper" style="background-color: #0D1F26;">
                <br><br><br>
                <ul class="nav">
                    <li>
                        <a href="inicio.php" style="color:#FF5733" title="Catálogo">
                            <i class="ti-arrow-circle-right"></i>
                            <p style="color: transparent;"> .</p>
                        </a>
                    </li>
                    <li>
                        <a href="sobrenos.php" style="color:#FF5733" title="Sobre nós">
                            <i class="ti-info"></i>
                            <p style="color: transparent;"> .</p>
                        </a>
                    </li>
                    <li>
                        <a href="condicoes.php" style="color:#FF5733" title="Condições de aluguel">
                            <i class="ti-hand-stop"></i>
                            <p style="color: transparent;"> .</p>
                        </a>
                    </li>
                    <li>
                        <a href="https://docs.google.com/document/d/1yfqknbs75eswLrXmWFSG-z95WK_cTwUsvUcdWVRBn2g/edit#" style="color:#FF5733" title="Contrato completo">
                            <i class="ti-marker-alt"></i>
                            <p style="color: transparent;"> .</p>
                        </a>
                    </li>
                    <li>
                        <a href="contato.php" style="color:#FF5733" title="Contato">
                            <i class="ti-comments"></i>
                            <p style="color: transparent;"> .</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>  
        <div style="margin-left: 5%;">
            <nav class="navbar navbar-default" style="background-color: #0D1F26;">
                <div class="container-fluid">
                    <div class="navbar-header" style="margin-top: 1%; margin-bottom: 1%">
                        <img width = "10%" src="assets/img/logoimg.png" alt="..."/>
                        <img width = "20%" src="assets/img/logonome.png" alt="..."/>
                    </div>
                    <div class="text-right" style="margin-top: 0.5%">        
                        <a class="btn btn-info btn-fill btn-wd" href="criar conta.php"> CRIAR CONTA</a>
                        <a class="btn btn-danger btn-fill btn-wd" href="login.php"> ENTRAR</a>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content">
                                <div class="content" style="margin-left: 3%; margin-bottom: 3%">
                                    <form action = "?" method = "POST">
                                        <div class="col-md-6" style="position: absolute; right: 5%; top: 0">
                                            <center>
                                            <img class="img-no-padding img-responsive" style="height: 600px" src="<?php echo $resultado['MOT_IMAGEM']; ?>" alt="..."/></center>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2 class="product-name" style="color: black"><?php echo $resultado['MOT_MODELO'];?></h2>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <b><label style="color: black">Cor:</label></b>
                                                <label style="background-color: white; border-radius: 0px; border-color: #c7d4e2; border-width: 3px"><?php echo $resultado['MOT_COR']; ?></label><br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <b><label style="color: black">Placa:</label></b>
                                                <label style="background-color: white; border-radius: 0px; border-color: #c7d4e2; border-width: 3px"><?php echo $resultado['MOT_PLACA']; ?></label><br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">              
                                                <b><label style="color: black">Ano:</label></b>
                                                <label style="background-color: white; border-radius: 0px; border-color: #c7d4e2; border-width: 3px"><?php echo $resultado['MOT_ANO']; ?></label><br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <b><label style="color: black">Motor:</label></b>
                                                <label style="background-color: white; border-radius: 0px; border-color: #c7d4e2; border-width: 3px"><?php echo $resultado['MOT_MOTOR']; ?> cc</label><br>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <b><label style="color: black">Potência:</label></b>
                                                <label style="background-color: white; border-radius: 0px; border-color: #c7d4e2; border-width: 3px"><?php echo $resultado['MOT_POTENCIA']; ?></label><br>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <b><label style="color: black">Altura do banco:</label></b>
                                                <label style="background-color: white; border-radius: 0px; border-color: #c7d4e2; border-width: 3px"><?php echo $resultado['MOT_ALTURABANCO']; ?></label><br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <b><label style="color: black">Peso:</label></b>
                                                <label style="background-color: white; border-radius: 0px; border-color: #c7d4e2; border-width: 3px"><?php echo $resultado['MOT_PESO']; ?></label><br>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <b><label style="color: black">Diária:</label></b>
                                                <label style="background-color: white; border-radius: 0px; border-color: #c7d4e2; border-width: 3px">R$ <?php echo $resultado['MOT_DIARIA']; ?></label><br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <b><label style="color: black">Fim de semana:</label></b>
                                                <label style="background-color: white; border-radius: 0px; border-color: #c7d4e2; border-width: 3px">R$ <?php echo $resultado['MOT_FIMDESEMANA']; ?></label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="text-left">
                                                    <a href="index.php" class="btn btn-info btn-fill btn-wd" style="color: #F2EFE4;">Voltar</a>
                                                    <a onclick="exibirModalConfirm()" class="btn btn-danger btn-fill btn-wd" style="margin-left: 5%">Alugar</a>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de confirmação de caso o usuário queira cadastrar uma conta -->
    <div class="modal-confirmacao">
        <h4 id="tituloAtencao">
            <span class="material-icons">
                report_problem
            </span>
            Atenção!
        </h4>
        <h3 id="textoModal">Para alugar esse produto é necessário um cadastro, deseja realizá-lo?</h3>
        <div class="botoes-confirmacao">
            <button class="btn btn-secondary" onclick="fecharModal()">Não</button>
            <button class="btn btn-primary" onclick="window.location.href = 'criar conta.php'">Sim</button>
        </div>
    </div>
    <div class="mask" onclick="fecharModal()"></div>
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

<script src="assets/js/script.js"></script>

</html>