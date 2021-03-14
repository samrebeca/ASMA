<?php
include("config2.php");
include("verifica.php");
include("top.php");
$codigousuario = intval($_SESSION['codigousuario']);
//Variável usada para forçar a atualização da imagem no cache do navegador
$aux = uniqid(time());
//Desabilita a conta
if(isset($_GET['excluir'])) {
    $codigo = intval($_GET['excluir']);

    $editar = $MySQLi->query("UPDATE TB_USUARIOS SET USU_SITUACAO=0 WHERE USU_CODIGO = $codigo");
    echo
        '<script>
        confirm("Sua senha conta está sendo desativada, se desejar recuperá-la acesse a aba de contatos");
        location.href = "sair.php";
        </script>';
}
$perfil = $MySQLi->query("SELECT * FROM TB_USUARIOS WHERE USU_CODIGO=$codigousuario");
//Verifica as próximas locações agendadas por esse usuário
$consulta = $MySQLi->query("SELECT *, DATE_FORMAT(ALG_DATAINICIO, '%d/%m/%Y') AS INICIO, DATE_FORMAT(ALG_DATAFIM, '%d/%m/%Y') AS FIM FROM TB_ALUGACOES
    LEFT JOIN TB_MOTOS ON MOT_CODIGO = ALG_MOT_CODIGO
    WHERE ALG_DATAINICIO > DATE_FORMAT(NOW(), '%Y-%m-%d') AND ALG_USU_CODIGO = $codigousuario AND MOT_ESTADO = 1 ORDER BY ALG_CODIGO");
//Verifica o histórico de locações agendadas por esse usuário
$consulta2 = $MySQLi->query("SELECT *, DATE_FORMAT(ALG_DATAINICIO, '%d/%m/%Y') AS INICIO, DATE_FORMAT(ALG_DATAFIM, '%d/%m/%Y') AS FIM FROM TB_ALUGACOES
    LEFT JOIN TB_MOTOS ON MOT_CODIGO = ALG_MOT_CODIGO
    WHERE ALG_DATAFIM < DATE_FORMAT(NOW(), '%Y-%m-%d') AND ALG_USU_CODIGO = $codigousuario ORDER BY ALG_CODIGO");
//Verifica as locações agendadas para o momento atual por esse usuário
$consulta3 = $MySQLi->query("SELECT *, DATE_FORMAT(ALG_DATAINICIO, '%d/%m/%Y') AS INICIO, DATE_FORMAT(ALG_DATAFIM, '%d/%m/%Y') AS FIM FROM TB_ALUGACOES
    LEFT JOIN TB_MOTOS ON MOT_CODIGO = ALG_MOT_CODIGO
    WHERE ALG_DATAFIM <= DATE_FORMAT(NOW(), '%Y-%m-%d') AND ALG_DATAINICIO >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND ALG_USU_CODIGO = $codigousuario ORDER BY ALG_CODIGO");
$resuperf = $perfil->fetch_assoc();

?>


<div class="main-panel">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div style="display: flex;justify-content: space-between;align-items: center;">
                <a class="navbar-brand" href="#">Perfil do usuário</a>
                <button class="btn btn-dark btn-fill btn-wd" id="show-menu" data-clique="false">Menu</button>
            </div>
        </div>
    </nav>
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <form action = "?" method = "POST">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" class="form-control border-input" name="nome" value="<?php echo $resuperf['USU_NOME']; ?>" READONLY style="background:#D1D1D1;">
                                    </div>
                                </div>
                                <div class="col-md-2 ">
                                    <center>
                                        <img class="img-circle img-no-padding img-responsive " width = "70%" src="<?php echo $resuperf['USU_FOTO']."?".$aux; ?>" alt="..."/>
                                    </center>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control border-input" name = "email" value="<?php echo $resuperf['USU_EMAIL']; ?>" READONLY style="background:#D1D1D1;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nome de Usuário</label>
                                        <input type="text" class="form-control border-input" name = "usuario" value="<?php echo $resuperf['USU_USUARIO']; ?>" READONLY style="background:#D1D1D1;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CPF</label>
                                        <input type="text" class="form-control border-input" name = "cpf" value="<?php echo $resuperf['USU_CPF']; ?>" READONLY style="background:#D1D1D1;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control border-input" name = "telefone" value="<?php echo $resuperf['USU_TELEFONE']; ?>" READONLY style="background:#D1D1D1;">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a class="btn btn-info btn-fill btn-wd" href="perfil-editar.php?codigo=<?php echo $resuperf['USU_CODIGO']; ?>"><i class="ti-pencil"></i> Editar </a> 
                                <a style="background-color:#954A4A;border-color: #954A4A; float: left" class="btn btn-info btn-fill btn-wd" href="?excluir=<?php echo $resuperf['USU_CODIGO']; ?>"><i class="ti-trash"></i>  Desabilitar </a>                      
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Próximas locações</h3>
                                    <div class="card">
                                        <table class="table table-striped">
                                            <thead><th>MOTO</th><th>INÍCIO</th><th>FIM</th><th>PREÇO</th></thead>
                                            <tbody>
                                                <?php while($resultado=$consulta->fetch_assoc()){ ?>
                                                <tr>
                                                    <td><?php echo $resultado['MOT_MODELO']; ?></td>
                                                    <td><?php echo $resultado['INICIO']; ?></td>
                                                    <td><?php echo $resultado['FIM']; ?></td>
                                                    <td>R$ <?php echo $resultado['ALG_VALOR']; ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Locações Ativas</h3>
                                    <div class="card">
                                        <table class="table table-striped">
                                            <thead><th>MOTO</th><th>INÍCIO</th><th>FIM</th><th>PREÇO</th></thead>
                                            <tbody>
                                                <?php while($resultado3=$consulta3->fetch_assoc()){ ?>
                                                <tr>
                                                    <td><?php echo $resultado3['MOT_MODELO']; ?></td>
                                                    <td><?php echo $resultado3['INICIO']; ?></td>
                                                    <td><?php echo $resultado3['FIM']; ?></td>
                                                    <td>R$ <?php echo $resultado3['ALG_VALOR']; ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Histórico de locações</h3>
                                    <div class="card">
                                        <table class="table table-striped">
                                            <thead><th>MOTO</th><th>INÍCIO</th><th>FIM</th><th>PREÇO</th></thead>
                                            <tbody>
                                                <?php while($resultado2=$consulta2->fetch_assoc()){ ?>
                                                <tr>
                                                    <td><?php echo $resultado2['MOT_MODELO']; ?></td>
                                                    <td><?php echo $resultado2['INICIO']; ?></td>
                                                    <td><?php echo $resultado2['FIM']; ?></td>
                                                    <td>R$ <?php echo $resultado2['ALG_VALOR']; ?></td>
                                                </tr>
                                                <?php } ?>
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
<?php include("bot.php"); ?>
