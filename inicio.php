<?php 
include("config2.php");
include("verifica2.php");
//Verifica se algum filtro foi selecionado
if(isset($_GET['filtro'])){
    $filtro = intval($_GET['filtro']);
    $consulta = $MySQLi->query("SELECT * FROM TB_MOTOS
    LEFT JOIN TB_CIDADES ON MOT_CID_CODIGO = CID_CODIGO
    WHERE MOT_CID_CODIGO = $filtro AND MOT_ESTADO = 1");
}else{
    $consulta = $MySQLi->query("SELECT * FROM TB_MOTOS
    LEFT JOIN TB_CIDADES ON MOT_CID_CODIGO = CID_CODIGO
    WHERE MOT_ESTADO = 1");
}
$consultaCid = $MySQLi->query("SELECT * FROM TB_CIDADES JOIN TB_MOTOS ON CID_CODIGO = MOT_CID_CODIGO GROUP BY CID_NOME ORDER BY CID_NOME");
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
    <link href="assets/css/custom.css" rel="stylesheet">

</head>
<body style="background-color: #f4f3ef">
    <div class="wrapper" style="background-color: #f4f3ef">
        <div class="sidebar" id="sidebar">
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
                        <a href="https://docs.google.com/document/d/1yfqknbs75eswLrXmWFSG-z95WK_cTwUsvUcdWVRBn2g/edit#" style="color:#FF5733" title="Contrato completo" target="_blank">
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
        <div class="main-painel" style="margin-left: 5%;">
            <nav class="navbar navbar-default" style="background-color: #0D1F26;">
                <div class="container-fluid">
                    <div class="navbar-header" style="margin-top: 1%; margin-bottom: 1%">
                        <img width = "10%" src="assets/img/logoimg.png" alt="..."/>
                        <img width = "20%" src="assets/img/logonome.png" alt="..."/>
                    </div>
                    <div id="itens-menu-mobile">      
                        <button class="btn btn-dark btn-fill btn-wd" id="show-menu" data-clique="false" >Menu</button>
                        <div>
                            <a class="btn btn-info btn-fill btn-wd" href="criar conta.php"> CRIAR CONTA</a>
                            <a class="btn btn-danger btn-fill btn-wd" href="login.php"> ENTRAR</a>    
                        </div>
                    </div>  
                </div>  
            </nav>
            <div class="content" style="margin: 2%;">
                <div class="container-fluid">
                    <div class="row">
                        <select id="filtro" style="margin-bottom: 2%; margin-right: 2%; float: right; display: flex;justify-content: center;align-items: center; font-size: 18px">   
                            <option>Escolha a cidade</option>
                            <option value="inicio.php">Todas</option>   
                            <?php while($resultadoCid=$consultaCid->fetch_assoc()){ ?>
                            <option value="inicio.php?filtro=<?php echo $resultadoCid['CID_CODIGO']; ?>"><?php echo $resultadoCid['CID_NOME']; ?></option>
                            <?php } ?>   
                        </select>
                    </div>
                    <div class="row">
                        <?php while($resultado=$consulta->fetch_assoc()){ ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <img class="img-no-padding img-responsive" style="height: 250px" src="<?php echo $resultado['MOT_IMAGEM']; ?>" alt="..."/>
                                        <h3 class="product-name" style="color: black"><?php echo $resultado['MOT_MODELO']; ?></h3>
                                        <h5 class="product-name" style="color: gray"><?php echo $resultado['CID_NOME']; ?></h3>
                                        <a href="cardmotoout.php?codigo=<?php echo $resultado['MOT_CODIGO']; ?>" class="btn btn-primary" style="margin: 10px; margin-bottom: 15px;">Ver moto</a>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <?php }; ?>
                    </div>
                </div>
            </div>
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

<script src="assets/js/script.js"></script>
</html>
