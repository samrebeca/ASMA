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
//Ativa uma moto caso ela esteja desativada
if(isset($_GET['ativar'])) {
    $codigoAti = $_GET['ativar'];
    $consultaAti = $MySQLi->query("UPDATE TB_MOTOS SET MOT_ESTADO=1 WHERE MOT_CODIGO = $codigoAti");
    header("Location: vermotosm.php");
}
//Desativa uma moto caso ela esteja ativada
if(isset($_GET['desativar'])) {
    $codigoDes = $_GET['desativar'];
    $consultaDes = $MySQLi->query("UPDATE TB_MOTOS SET MOT_ESTADO=0 WHERE MOT_CODIGO = $codigoDes");
    header("Location: vermotosm.php");
}
//Verifica motos ativadas
$consulta = $MySQLi->query("SELECT * FROM TB_MOTOS WHERE MOT_ESTADO = 1 ORDER BY MOT_MODELO");
//Verifica motos desativadas
$consulta2 = $MySQLi->query("SELECT * FROM TB_MOTOS WHERE MOT_ESTADO = 0 ORDER BY MOT_MODELO");
$consulta33 = $MySQLi->query("SELECT * FROM TB_MOTOS ORDER BY MOT_MODELO");
?>
<div class="main-panel">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Gerenciar disponibilidade das motos (master)</a>  
            </div>
        </div>
    </nav>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <?php while($resultado33=$consulta33->fetch_assoc()) { ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-bookmark-alt"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7" style="height: 100px">
                                        <div class="numbers">
                                            <p><?php echo $resultado33['MOT_MODELO']; ?></p>
                                            <p style="color: #A9A9A9;"><?php echo $resultado33['MOT_PLACA']; ?></p>
                                            <a href="vermotom.php?codigo=<?php echo $resultado33['MOT_CODIGO']; ?>">
                                                <i class="ti-link"></i>
                                            </a>
                                            <a href="motos-editar.php?codigo=<?php echo $resultado33['MOT_CODIGO']; ?>">
                                                <i class="ti-pencil"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                           </div>
                       </div>
                   </div>  
              <?php } ?>
           </div>
           <div class="row">
            <div class="col-md-12">
                <div class="text-left">
                    <a class="btn btn-info btn-fill btn-wd" href = "motos-novo.php"><i class="ti-plus"></i> Adicionar</a> 
                </div>
            </div>
        </div>
            <div class="col-md-12">
                <h3>Motos ativas</h3>
                <div class="card">
                    <table class="table table-striped">
                        <thead><th>MODELO</th><th>PLACA</th><th>COR</th><th>IPVA</th><th>DPVT</th><th>AÇÃO</th></thead>
                        <tbody>
                            <?php while($resultado=$consulta->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $resultado['MOT_MODELO']; ?></td>
                                <td><?php echo $resultado['MOT_PLACA']; ?></td>
                                <td><?php echo $resultado['MOT_COR']; ?></td>
                                <td>R$ <?php echo $resultado['MOT_IPVA']; ?></td>
                                <td>R$ <?php echo $resultado['MOT_DPVAT']; ?></td>
                                <td><a href="vermotosm.php?desativar=<?php echo $resultado['MOT_CODIGO']; ?>"><i class="ti-arrow-circle-down icon-danger"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <h3>Motos desativas</h3>
                <div class="card">
                    <table class="table table-striped">
                        <thead><th>MODELO</th><th>PLACA</th><th>COR</th><th>IPVA</th><th>DPVT</th><th>AÇÃO</th></thead>
                        <tbody>
                            <?php while($resultado2=$consulta2->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $resultado2['MOT_MODELO']; ?></td>
                                <td><?php echo $resultado2['MOT_PLACA']; ?></td>
                                <td><?php echo $resultado2['MOT_COR']; ?></td>
                                <td>R$ <?php echo $resultado2['MOT_IPVA']; ?></td>
                                <td>R$ <?php echo $resultado2['MOT_DPVAT']; ?></td>
                                <td><a href="vermotosm.php?ativar=<?php echo $resultado2['MOT_CODIGO']; ?>"><i class="ti-arrow-circle-up"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("bot.php"); ?>