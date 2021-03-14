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
if(isset($_POST['modelo'])){
    $cor = $_POST['cor'];
    $placa = $_POST['placa'];
    $cidade = intval($_POST['cidade']);
    $motor = intval($_POST['motor']);
    $alturaBanco = $_POST['alturaBanco'];
    $potencia = $_POST['potencia'];
    $peso = $_POST['peso'];
    $diaria = floatval($_POST['diaria']);
    $fimSemana = floatval($_POST['fimSemana']);
    $ipva = floatval($_POST['ipva']);
    $dpvat = floatval($_POST['dpvat']);
    $codigo = intval($_POST['codigo']);
    if(isset($_FILES['imagem'])){
        $imagem = $_FILES['imagem'];
        $nomeImagem = $_POST['imagemNome'];
        //Subistitui o antigo arquivo da imagem por um novo
        move_uploaded_file($imagem['tmp_name'], $nomeImagem);
    }
    $editar = $MySQLi->query("UPDATE TB_MOTOS SET MOT_PLACA='$placa', MOT_COR='$cor', MOT_IPVA='$ipva', MOT_DPVAT='$dpvat', MOT_DIARIA='$diaria', MOT_CID_CODIGO='$cidade', MOT_MOTOR='$motor',  MOT_POTENCIA='$potencia', MOT_ALTURABANCO='$alturaBanco', MOT_PESO='$peso', MOT_FIMDESEMANA='$fimSemana' WHERE MOT_CODIGO = '$codigo'");
    echo
        "<script>
        location.href = 'vermotom.php?codigo=$codigo';
        </script>";
};
$consultaCid = $MySQLi->query("SELECT * FROM TB_CIDADES ORDER BY CID_NOME");
//Verifica se uma moto foi selecionada
if(isset($_GET['codigo'])){
    $codigo = $_GET['codigo'];
    $consulta2 = $MySQLi->query("SELECT * FROM TB_MOTOS WHERE MOT_CODIGO = $codigo");
    $resultado2 = $consulta2->fetch_assoc();
}else{
    echo
    "<script>
    location.href = 'vermotosm.php';
    </script>";
}
?>


<div class="main-panel">
<nav class="navbar navbar-default">
        <div class="container-fluid">
            <div style="display: flex;justify-content: space-between;align-items: center;">
            <a class="navbar-brand" href="#">Editar Moto</a>
                <button class="btn btn-dark btn-fill btn-wd" id="show-menu" data-clique="false">Menu</button>
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
                                <div class="content">
                                    <form action = "?" method = "POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Modelo</label>
                                                <input name = "modelo" value="<?php echo $resultado2['MOT_MODELO']; ?>" class="form-control border-input" placeholder="<?php echo $resultado2['MOT_MODELO']; ?>" required READONLY style="background:#D1D1D1;">
                                            </div>
                                            <div class="col-md-3">
                                                <label>Cor</label>
                                                <input name = "cor" value="<?php echo $resultado2['MOT_COR']; ?>" class="form-control border-input" placeholder="<?php echo $resultado2['MOT_COR']; ?>" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Cidade</label>
                                                <select name="cidade" class="form-control border-input">   
                                                    <?php while($resultadoCid=$consultaCid->fetch_assoc()){ ?>
                                                    <option <?php if($resultadoCid['CID_CODIGO'] == $resultado2['MOT_CID_CODIGO']){ ?> selected <?php } ?>value="<?php echo $resultadoCid['CID_CODIGO']; ?>"><?php echo $resultadoCid['CID_NOME']; ?></option>
                                                    <?php } ?>  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Placa</label>
                                                <input name = "placa" value="<?php echo $resultado2['MOT_PLACA']; ?>" class="form-control border-input" placeholder="<?php echo $resultado2['MOT_PLACA']; ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Ano</label>
                                                <input type="text" name = "ano" value="<?php echo $resultado2['MOT_ANO']; ?>" class="form-control border-input" placeholder=" <?php echo $resultado2['MOT_ANO']; ?>" required READONLY style="background:#D1D1D1;">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Imagem</label>
                                                <input type="file" name = "imagem" class="form-control border-input">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Motor (cc)</label>
                                                <input name = "motor" value="<?php echo $resultado2['MOT_MOTOR']; ?>" class="form-control border-input" placeholder="<?php echo $resultado2['MOT_MOTOR']; ?>" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Potência</label>
                                                <input name = "potencia" value="<?php echo $resultado2['MOT_POTENCIA']; ?>" class="form-control border-input" placeholder="<?php echo $resultado2['MOT_POTENCIA']; ?>" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Altura do banco</label>
                                                <input name = "alturaBanco" value="<?php echo $resultado2['MOT_ALTURABANCO']; ?>" class="form-control border-input" placeholder="<?php echo $resultado2['MOT_ALTURABANCO']; ?>" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Peso</label>
                                                <input name = "peso" value="<?php echo $resultado2['MOT_PESO']; ?>" class="form-control border-input" placeholder="<?php echo $resultado2['MOT_PESO']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Diária</label>
                                                <input type="text" name = "diaria" value="<?php echo $resultado2['MOT_DIARIA']; ?>" class="form-control border-input" placeholder="<?php echo $resultado2['MOT_DIARIA']; ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Fim de semana</label>
                                                <input type="text" name = "fimSemana" value="<?php echo $resultado2['MOT_FIMDESEMANA']; ?>" class="form-control border-input" placeholder="<?php echo $resultado2['MOT_FIMDESEMANA']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>IPVA</label>
                                                <input type="text" name = "ipva" value="<?php echo $resultado2['MOT_IPVA']; ?>" class="form-control border-input" placeholder="<?php echo $resultado2['MOT_IPVA']; ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>DPVAT</label>
                                                <input type="text" name = "dpvat" value="<?php echo $resultado2['MOT_DPVAT']; ?>" class="form-control border-input" placeholder="<?php echo $resultado2['MOT_DPVAT']; ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" name = "codigo" value="<?php echo $resultado2['MOT_CODIGO']; ?>" class="form-control border-input" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" name = "imagemNome" value="<?php echo $resultado2['MOT_IMAGEM']; ?>" class="form-control border-input" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Enviar</button>
                                                    <a href="vermotom.php?codigo=<?php echo $codigo ?>" class="btn btn-danger btn-fill btn-wd" style="color: #F2EFE4; float: left">Voltar</a>
                                                    <br>
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