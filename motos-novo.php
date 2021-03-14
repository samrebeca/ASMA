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
    $modelo = $_POST['modelo'];
    $cor = $_POST['cor'];
    $placa = $_POST['placa'];
    $cidade = intval($_POST['cidade']);
    $ano = intval($_POST['ano']);
    $motor = intval($_POST['motor']);
    $alturaBanco = $_POST['alturaBanco'];
    $potencia = $_POST['potencia'];
    $peso = $_POST['peso'];
    $diaria = floatval($_POST['diaria']);
    $fimSemana = floatval($_POST['fimSemana']);
    $ipva = floatval($_POST['ipva']);
    $dpvat = floatval($_POST['dpvat']);
    $imagem = $_FILES['imagem'];
    //Verifica a extensão do arquivo da imagem
    preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $extensao);
    //Cria um nome para essa imagem a partir do tempo atual, de uma forma que esse nome não se repita e criptografado
    $nomeImagem = md5(uniqid(time())).'.'.$extensao[1];
    //Indica a localização que o arquivo deve estar
    $nomeImagem = "assets/img/motos/".$nomeImagem;
    //Salva a imagem
    move_uploaded_file($imagem['tmp_name'], $nomeImagem);
    $consulta = $MySQLi->query("INSERT INTO TB_MOTOS (MOT_PLACA, MOT_MODELO, MOT_COR, MOT_ANO, MOT_IPVA, MOT_DPVAT, MOT_DIARIA, MOT_IMAGEM, MOT_ESTADO, MOT_CID_CODIGO, MOT_MOTOR, MOT_POTENCIA, MOT_ALTURABANCO, MOT_PESO, MOT_FIMDESEMANA) 
    VALUES ('$placa', '$modelo', '$cor', $ano, $ipva, $dpvat, $diaria, '$nomeImagem', 1, $cidade, $motor, '$potencia', '$alturaBanco', '$peso', $fimSemana);");
    echo
        "<script>
        location.href = 'vermotosm.php';
        </script>";
};
$consultaCid = $MySQLi->query("SELECT * FROM TB_CIDADES ORDER BY CID_NOME");
?>


<div class="main-panel">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div style="display: flex;justify-content: space-between;align-items: center;">
            <a class="navbar-brand" href="#">Adicionar Moto</a>
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
                                                <input name = "modelo" class="form-control border-input" placeholder=" Honda CB300R" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Cor</label>
                                                <input name = "cor" class="form-control border-input" placeholder=" Amarelo" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Cidade</label>
                                                <select name="cidade" class="form-control border-input">   
                                                    <?php while($resultadoCid=$consultaCid->fetch_assoc()){ ?>
                                                    <option value="<?php echo $resultadoCid['CID_CODIGO']; ?>"><?php echo $resultadoCid['CID_NOME']; ?></option>
                                                    <?php } ?>  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Placa</label>
                                                <input name = "placa" class="form-control border-input" placeholder=" 123PP" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Ano</label>
                                                <input name = "ano" class="form-control border-input" placeholder=" 2009" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Imagem</label>
                                                <input  type="file" name = "imagem" class="form-control border-input" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Motor (cc)</label>
                                                <input name = "motor" class="form-control border-input" placeholder="900" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Potência</label>
                                                <input name = "potencia" class="form-control border-input" placeholder=" 50 cv" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Altura do banco</label>
                                                <input name = "alturaBanco" class="form-control border-input" placeholder=" 750 mm" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Peso</label>
                                                <input name = "peso" class="form-control border-input" placeholder=" 190 kg" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Diária</label>
                                                <input type="text" name = "diaria" class="form-control border-input" placeholder=" 120.00" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Fim de semana</label>
                                                <input type="text" name = "fimSemana" class="form-control border-input" placeholder=" 300.00" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>IPVA</label>
                                                <input type="text" name = "ipva" class="form-control border-input" placeholder=" 1095.00" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>DPVAT</label>
                                                <input type="text" name = "dpvat" class="form-control border-input" placeholder=" 1095.00" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Enviar</button>
                                                    <a href="vermotosm.php" class="btn btn-danger btn-fill btn-wd" style="color: #F2EFE4; float: left">Voltar</a>
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