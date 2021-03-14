<?php 
include("config2.php");
include("verifica.php");
include("top.php");
//Verifica se é usuário master 
if ($isMaster == false){
    echo
        "<script>
        location.href = 'index.php';
        </script>";
}
//Variável usada para forçar a atualização da imagem no cache do navegador
$aux = uniqid(time());
//Indica que a moto foi devolvida
if(isset($_GET['verificar'])) {
    $codigoVer = $_GET['verificar'];
    $consultaVer = $MySQLi->query("UPDATE TB_ALUGACOES SET ALG_VERIFICA=1 WHERE ALG_CODIGO = $codigoVer");
    $consultaVer2 = $MySQLi->query("SELECT ALG_MOT_CODIGO FROM TB_ALUGACOES WHERE ALG_CODIGO = $codigoVer");
    $resultadoVer2 = $consultaVer2->fetch_assoc();
    $codigo = $resultadoVer2['ALG_MOT_CODIGO'];
    echo
        "<script>
        location.href = 'vermotom.php?codigo=$codigo';
        </script>";
}
//Verifica se alguma moto foi selecionada e puxa seus dados/locações
if(isset($_GET['codigo'])){
    $codigo = intval($_GET['codigo']);
    $consulta = $MySQLi->query("SELECT * FROM TB_MOTOS LEFT JOIN TB_CIDADES ON MOT_CID_CODIGO = CID_CODIGO WHERE MOT_CODIGO = $codigo");
    $resultado = $consulta->fetch_assoc();
    $consultaLoc = $MySQLi->query("SELECT *, DATE_FORMAT(ALG_DATAINICIO, '%d/%m/%Y') AS INICIO, DATE_FORMAT(ALG_DATAFIM, '%d/%m/%Y') AS FIM FROM TB_ALUGACOES LEFT JOIN TB_USUARIOS ON ALG_USU_CODIGO = USU_CODIGO WHERE ALG_MOT_CODIGO = $codigo AND ALG_VERIFICA = 0 AND ALG_DATAFIM < DATE_FORMAT(NOW(), '%Y-%m-%d') ORDER BY ALG_DATAFIM");
    $consultaLoc2 = $MySQLi->query("SELECT *, DATE_FORMAT(ALG_DATAINICIO, '%d/%m/%Y') AS INICIO, DATE_FORMAT(ALG_DATAFIM, '%d/%m/%Y') AS FIM FROM TB_ALUGACOES LEFT JOIN TB_USUARIOS ON ALG_USU_CODIGO = USU_CODIGO WHERE ALG_MOT_CODIGO = $codigo AND ALG_VERIFICA = 1 AND ALG_DATAFIM < DATE_FORMAT(NOW(), '%Y-%m-%d') ORDER BY ALG_DATAFIM");
}else{
    header("Location: index.php");
}

?>

<div class="main-panel">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Detalhes sobre a moto</a>
            </div>    
        </div>
    </nav>
    <div class="content" style="margin: 2%;">
        <div class="container-fluid">
            <div class="content">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content">
                                <div class="content" style="margin-left: 3%; margin-bottom: 3%">
                                    <form action = "?" method = "POST">
                                        <div class="col-md-6" style="position: absolute; right: 5%; top: 0">
                                            <img class="img-no-padding img-responsive" style="height: 600px" src="<?php echo $resultado['MOT_IMAGEM'].'?'.$aux; ?>" alt="..."/>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2 class="product-name" style="color: black"><?php echo $resultado['MOT_MODELO']; ?></h2>
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
                                                <b><label style="color: black">Cidade:</label></b>
                                                <label style="background-color: white; border-radius: 0px; border-color: #c7d4e2; border-width: 3px"><?php echo $resultado['CID_NOME']; ?></label><br>
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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>Locações pendentes</h3>
                                                <div class="card">
                                                    <table class="table table-striped">
                                                        <thead><th>INÍCIO</th><th>FIM</th><th>CLIENTE</th><th>PREÇO</th><th>
                                                        DEVOLVIDA</th></thead>
                                                        <tbody>
                                                            <?php while($resultadoLoc=$consultaLoc->fetch_assoc()) { ?>
                                                            <tr>
                                                                <td><?php echo $resultadoLoc['INICIO']; ?></td>
                                                                <td><?php echo $resultadoLoc['FIM']; ?></td>
                                                                <td><?php echo $resultadoLoc['USU_USUARIO']; ?></td>
                                                                <td><?php echo $resultadoLoc['ALG_VALOR']; ?></td>
                                                                <td><a href="vermotom.php?verificar='<?php echo $resultadoLoc['ALG_CODIGO']; ?>'"><i class="ti-check"></i></a></td>
                                                            </tr>
                                                            <?php }; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h3>Locações devolvidas</h3>
                                                <div class="card">
                                                    <table class="table table-striped">
                                                        <thead><th>INÍCIO</th><th>FIM</th><th>CLIENTE</th><th>PREÇO</th></thead>
                                                        <tbody>
                                                            <tr>
                                                            <?php while($resultadoLoc2=$consultaLoc2->fetch_assoc()) { ?>
                                                                <td><?php echo $resultadoLoc2['INICIO']; ?></td>
                                                                <td><?php echo $resultadoLoc2['FIM']; ?></td>
                                                                <td><?php echo $resultadoLoc2['USU_USUARIO']; ?></td>
                                                                <td><?php echo $resultadoLoc2['ALG_VALOR']; ?></td>
                                                            </tr>
                                                            <?php }; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-left">
                                                    <a href="vermotosm.php" class="btn btn-info btn-fill btn-wd" style="color: #F2EFE4;">Voltar</a>
                                                    <a href="motos-editar.php?codigo=<?php echo $codigo ; ?>" class="btn btn-danger btn-fill btn-wd" style="float: right">Editar</a>
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
</div>
<?php include("bot.php"); ?>