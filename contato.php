<?php
include("config2.php");
$consulta = $MySQLi->query("SELECT * FROM TB_ESTABELECIMENTOS LEFT JOIN TB_CIDADES ON EST_CID_CODIGO = CID_CODIGO ORDER BY CID_NOME");
?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/logo2.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>ASMA - Contato</title>

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
            <div class="container">
                <div class="col-md-12">
                    <div class="content">
                        <div class="content">
                            <br>
                            <div class="author">
                                <center>
                                    <img class="img-no-padding img-responsive" width = "200px" src="assets/img/contato.png" alt="..."/> 
                                    <h3 style="color: #FFFFFF">Entre em contato com a gente</h3>
                                </center>
                            </div> 
                            <div style="margin: 0 auto; text-align: center; width: 800px;">
                                <?php while($resultado=$consulta->fetch_assoc()) { ?>
                                <div style="color:white;float: left; margin: 0px 15px 0px 15px; text-align: justify; width: 21%;">
                                    <b><?php echo $resultado['CID_NOME']; ?></b><br><br>
                                    Email:<br>
                                    <?php echo $resultado['EST_EMAIL']; ?><br>
                                    Endereço: <?php echo $resultado['EST_RUA'].', '.$resultado['EST_LOGRADOURO'].' - '.$resultado['EST_BAIRRO'].", ".$resultado['EST_CAIXAPOSTAL']; ?><br><br>
                                    Contato: <?php echo $resultado['EST_TELEFONE']; ?>
                                </div>
                                <?php }; ?>
                                <div style="clear: both;">
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="clearfix"></div>
                            <div class="text-center">
                                <button onclick="history.go(-1)" class="btn btn-outline-primary" style="color: #F2EFE4">Voltar</button>
                            </div>
                        </div>
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

</html>