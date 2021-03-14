<?php 
include("config2.php");
include("verifica.php");
include("top.php");
//Verifica se existe alguma moto selecionada e puxa seus dados
if(isset($_GET['codigo'])){
    $codigo = intval($_GET['codigo']);
    $consulta = $MySQLi->query("SELECT * FROM TB_MOTOS WHERE MOT_CODIGO = $codigo");
    $resultado = $consulta->fetch_assoc();
}else{
    header("Location: index.php");
}
$consultaLoc = $MySQLi->query("SELECT DATE_FORMAT(ALG_DATAINICIO, '%d/%m/%Y') AS INICIO, DATE_FORMAT(ALG_DATAFIM, '%d/%m/%Y') AS FIM FROM TB_ALUGACOES WHERE ALG_MOT_CODIGO = $codigo AND ALG_DATAFIM >= DATE_FORMAT(NOW(), '%Y-%m-%d') ORDER BY ALG_DATAINICIO");
?>

<div class="main-panel">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Detalhes sobre a moto</a>
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
                                        <img class="img-no-padding img-responsive" style="height: 600px" src="<?php echo $resultado['MOT_IMAGEM']; ?>" alt="..."/>
                                    </center>
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
                                            <a href="alugarmoto.php?codigo=<?php echo $resultado['MOT_CODIGO']; ?>" class="btn btn-danger btn-fill btn-wd" style="margin-left: 5%">Alugar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Locações agendadas</h3>
                                        <div class="card">
                                            <table class="table table-striped">
                                                <thead><th>INÍCIO</th><th>FIM</th></thead>
                                                <tbody>
                                                    <?php while($resultadoLoc=$consultaLoc->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo $resultadoLoc['INICIO']; ?></td>
                                                        <td><?php echo $resultadoLoc['FIM']; ?></td>
                                                    </tr>
                                                    <?php }; ?>
                                                </tbody>
                                            </table>
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

<?php include("bot.php"); ?>