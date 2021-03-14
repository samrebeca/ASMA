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
    <link href="assets/css/custom-admin.css" rel="stylesheet" />

</head>
<body>
    <div class="wrapper">
        <div class="sidebar adm-sidebar" data-background-color="white" data-active-color="danger">
            <div class="sidebar-wrapper" style="background-color: #0D1F26">
                <div class="logo">
                    <center><img width = "70%" src="assets/img/logonome.png" alt="..."/></center>
                </div>
                <ul class="nav">
                    <li>
                        <a href="index.php" style="color:#FF5733">
                            <i class="ti-arrow-circle-right"></i>
                            <p>Início</p>
                        </a>
                    </li>
                    <li>
                        <a href="perfil.php" style="color:#FF5733">
                            <i class="ti-user"></i>
                            <p>Perfil</p>
                        </a>
                    </li>
                    <?php if($isMaster == true) { ?>
                    <li>
                        <a href="vermotosm.php" style="color:#FF5733">
                            <i class="fa fa-bars"></i>
                            <p>Visualizar motos</p>
                        </a>
                    </li>
                    <li>
                        <a href="visuclientes.php" style="color:#FF5733">
                            <i class="fa fa-bars"></i>
                            <p>Visualizar clientes</p>
                        </a>
                    </li>
                    <li>
                        <a href="visulocacao.php" style="color:#FF5733">
                            <i class="fa fa-bars"></i>
                            <p>Visualizar locações</p>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if($isMaster == false) { ?>
                    <li>
                        <a href="condicoes.php" style="color:#FF5733">
                            <i class="ti-hand-stop"></i>
                            <p>Condições de aluguel</p>
                        </a>
                    </li>
                    <li>
                        <a href="https://docs.google.com/document/d/1yfqknbs75eswLrXmWFSG-z95WK_cTwUsvUcdWVRBn2g/edit#" style="color:#FF5733" target="_blank">
                            <i class="ti-marker-alt"></i>
                            <p>Contrato completo</p>
                        </a>
                    </li>
                    <li>
                        <a href="sobrenos.php" style="color:#FF5733">
                            <i class="ti-info"></i>
                            <p>Sobre nós</p>
                        </a>
                    </li>
                    <li>
                        <a href="contato.php" style="color:#FF5733">
                            <i class="ti-comments"></i>
                            <p>Contato</p>
                        </a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="sair.php">
                            <i class="ti-shift-right"></i>
                            <p>Sair</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

