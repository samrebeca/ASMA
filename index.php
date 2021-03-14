<?php 
include("config2.php");
include("verifica.php");
include("top.php");
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
<div class="main-panel">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div style="display: flex;justify-content: space-between;align-items: center;">
                <a class="navbar-brand" href="index.php">Página Inicial</a>
                <button class="btn btn-dark btn-fill btn-wd" id="show-menu" data-clique="false">Menu</button>
            </div>
        </div>
    </nav>
    <div class="content" >
        <div class="container-fluid">
            <div class="row">
                <select id="filtro" style="margin-bottom: 2%; margin-right: 2%; float: right; display: flex;justify-content: center;align-items: center; font-size: 18px">   
                    <option>Escolha a cidade</option>
                    <option value="index.php">Todas</option>   
                    <?php while($resultadoCid=$consultaCid->fetch_assoc()){ ?>
                    <option value="index.php?filtro=<?php echo $resultadoCid['CID_CODIGO']; ?>"><?php echo $resultadoCid['CID_NOME']; ?></option>
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
                                <h5 class="product-name" style="color: gray"><?php echo $resultado['CID_NOME']; ?></h5>
                                <a href="cardmoto.php?codigo=<?php echo $resultado['MOT_CODIGO']; ?>" class="btn btn-primary" style="margin: 10px; margin-bottom: 15px;">Ver moto</a>
                                <a href="alugarmoto.php?codigo=<?php echo $resultado['MOT_CODIGO']; ?>" class="btn btn-danger" style="margin: 10px; margin-bottom: 15px;">Alugar</a>
                            </center>
                        </div>
                    </div>
                </div>
                <?php }; ?>
            </div>
        </div>
    </div>
</div>
<?php include('bot.php');?>