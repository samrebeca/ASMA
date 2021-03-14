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
//Cancela uma locação
if(isset($_GET['cancelar'])){
    $codigoCan = $_GET['cancelar'];
    $consultaCan = $MySQLi->query("DELETE FROM TB_ALUGACOES WHERE ALG_CODIGO = $codigoCan");
    echo
        "<script>
        location.href = 'visulocacao.php';
        </script>";
}
//Verifica histórico de locações devolvidas de todas as motos
$consultaLoc = $MySQLi->query("SELECT *, DATE_FORMAT(ALG_DATAINICIO, '%d/%m/%Y') AS INICIO, DATE_FORMAT(ALG_DATAFIM, '%d/%m/%Y') AS FIM FROM TB_ALUGACOES
    LEFT JOIN TB_USUARIOS ON ALG_USU_CODIGO = USU_CODIGO
    LEFT JOIN TB_MOTOS ON ALG_MOT_CODIGO = MOT_CODIGO
    WHERE ALG_VERIFICA = 1 AND ALG_DATAFIM < DATE_FORMAT(NOW(), '%Y-%m-%d') ORDER BY ALG_DATAFIM");
//Verifica próximas locações agendadas de todas as motos
$consultaLoc2 = $MySQLi->query("SELECT *, DATE_FORMAT(ALG_DATAINICIO, '%d/%m/%Y') AS INICIO, DATE_FORMAT(ALG_DATAFIM, '%d/%m/%Y') AS FIM FROM TB_ALUGACOES
    LEFT JOIN TB_USUARIOS ON ALG_USU_CODIGO = USU_CODIGO
    LEFT JOIN TB_MOTOS ON ALG_MOT_CODIGO = MOT_CODIGO
    WHERE ALG_DATAINICIO > DATE_FORMAT(NOW(), '%Y-%m-%d') ORDER BY ALG_DATAINICIO");
//Verifica todas as locações ativas de todas as motos
$consultaLoc3 = $MySQLi->query("SELECT *, DATE_FORMAT(ALG_DATAINICIO, '%d/%m/%Y') AS INICIO, DATE_FORMAT(ALG_DATAFIM, '%d/%m/%Y') AS FIM FROM TB_ALUGACOES
    LEFT JOIN TB_USUARIOS ON ALG_USU_CODIGO = USU_CODIGO
    LEFT JOIN TB_MOTOS ON ALG_MOT_CODIGO = MOT_CODIGO
    WHERE ALG_DATAINICIO <= DATE_FORMAT(NOW(), '%Y-%m-%d') AND ALG_DATAFIM >= DATE_FORMAT(NOW(), '%Y-%m-%d') ORDER BY MOT_MODELO");
?>
<div class="main-panel">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Visualizar locação (master)</a>  
            </div>
        </div>
    </nav>
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <h3>Próximas locações</h3>
                <div class="card">
                    <table class="table table-striped">
                        <thead><th>MOTO</th><th>INÍCIO</th><th>FIM</th><th>CLIENTE</th><th>PREÇO</th><th>CANCELAR</th></thead>
                        <tbody>
                            <?php while($resultadoLoc2=$consultaLoc2->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $resultadoLoc2['MOT_MODELO']; ?></td>
                                    <td><?php echo $resultadoLoc2['INICIO']; ?></td>
                                    <td><?php echo $resultadoLoc2['FIM']; ?></td>
                                    <td><?php echo $resultadoLoc2['USU_USUARIO']; ?></td>
                                    <td><?php echo $resultadoLoc2['ALG_VALOR']; ?></td>
                                    <td><a href="visulocacao.php?cancelar=<?php echo $resultadoLoc2['ALG_CODIGO'] ?>"><i class="ti-na icon-danger"></i></a></td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <h3>Locações ativas</h3>
                <div class="card">
                    <table class="table table-striped">
                        <thead><th>MOTO</th><th>INÍCIO</th><th>FIM</th><th>CLIENTE</th><th>PREÇO</th></thead>
                        <tbody>
                            <?php while($resultadoLoc3=$consultaLoc3->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $resultadoLoc3['MOT_MODELO']; ?></td>
                                    <td><?php echo $resultadoLoc3['INICIO']; ?></td>
                                    <td><?php echo $resultadoLoc3['FIM']; ?></td>
                                    <td><?php echo $resultadoLoc3['USU_USUARIO']; ?></td>
                                    <td><?php echo $resultadoLoc3['ALG_VALOR']; ?></td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <h3>Histórico</h3>
                <div class="card">
                    <table class="table table-striped">
                        <thead><th>MOTO</th><th>INÍCIO</th><th>FIM</th><th>CLIENTE</th><th>PREÇO</th></thead>
                        <tbody>
                            <?php while($resultadoLoc=$consultaLoc->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $resultadoLoc['MOT_MODELO']; ?></td>
                                    <td><?php echo $resultadoLoc['INICIO']; ?></td>
                                    <td><?php echo $resultadoLoc['FIM']; ?></td>
                                    <td><?php echo $resultadoLoc['USU_USUARIO']; ?></td>
                                    <td><?php echo $resultadoLoc['ALG_VALOR']; ?></td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("bot.php"); ?>