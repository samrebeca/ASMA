<?php 
include("config2.php");
include("verifica.php");
include("top.php");
if(isset($_POST['datai'])){
    $codigoPessoa = intval($_SESSION['codigousuario']);
    $codigo = intval($_POST['codigo']);
    $datai = date_create($_POST['datai']);
    $dataf = date_create($_POST['dataf']);
    $fds = doubleval($_POST['fds']);
    $diaria = doubleval($_POST['diaria']);
    $dataini = date_format($datai,"Y-m-d");
    $datafim = date_format($dataf,"Y-m-d");
    $checagem = $MySQLi->query("SELECT * FROM TB_ALUGACOES WHERE ALG_MOT_CODIGO = $codigo");
    //Checa se as data selecionadas estão disponíveis na tabela
    while($check=$checagem->fetch_assoc()){
        if(($dataini >= $check['ALG_DATAINICIO'] AND $datafim <= $check['ALG_DATAFIM']) OR
        ($dataini <= $check['ALG_DATAINICIO'] AND $datafim >= $check['ALG_DATAINICIO']) OR
        ($dataini <= $check['ALG_DATAFIM'] AND $datafim >= $check['ALG_DATAFIM']) OR
        ($dataini <= $check['ALG_DATAINICIO'] AND $datafim >= $check['ALG_DATAFIM'])){
            echo
            "<script>
                confirm('O produto já está alugado nesse período, verifique a tabela de locações para mais informações');
                location.href = 'cardmoto.php?codigo=$codigo';
            </script>";
            $aux = 1;
        }
    }
    //Checa se a data de início selecionada é maior que a data de fim
    if(intval(date_diff($datai,$dataf)->format('%R%a')) < 0){
        echo
        "<script>
            confirm('Data de início maior que data de fim, tente novamente');
            location.href = 'alugarmoto.php?codigo=$codigo';
        </script>";
        $aux = 1;
    }
    //Checa se a data de início já passou
    if(date_format($datai,"Y-m-d") < date("Y-m-d")){
        echo
        "<script>
            confirm('Data de início já passou');
            location.href = 'alugarmoto.php?codigo=$codigo';
        </script>";
        $aux = 1;
    }
    //Caso nenhuma opção anterior aconteça e a locação possa ser concluída
    if($aux != 1){
        //Calcula o valor total da locação
        $valor=0;
        for($i = 0;$i<=(intval(date_diff($datai,$dataf)->format('%R%a')));$i++){
            $dataAux = date_create($_POST['datai']);
            $dataAux = date_add($dataAux, date_interval_create_from_date_string("$i day"));
            $dataAux1 = date_format($dataAux, 'Y-m-d');
            $dia = date_format($dataAux, 'N');
            //Caso as datas selecionadas sejam um fim de semana
            if($dia == 5 || $dia == 6 || $dia == 7){
                $valor += $fds;
            //Caso as datas selecionadas não sejam um fim de semana
            }else{
                $valor += $diaria;
            }
        }
        $consulta = $MySQLi->query("INSERT INTO TB_ALUGACOES (ALG_DATAINICIO, ALG_DATAFIM, ALG_USU_CODIGO, ALG_MOT_CODIGO, ALG_VALOR, ALG_VERIFICA) VALUES ('$dataini', '$datafim', $codigoPessoa, $codigo, $valor, 0)");
        echo
            "<script>
            confirm('Valor total: R$ '+$valor+'. Compareça no estabelecimento para realizar o pagamento e resgatar o veículo.');
            location.href = 'cardmoto.php?codigo=$codigo';
            </script>";
        
    }
}
//Verifica se existe alguma moto selecionada e puxa seus dados
if(isset($_GET['codigo'])){
    $codigo = intval($_GET['codigo']);
    $consulta = $MySQLi->query("SELECT * FROM TB_MOTOS
        LEFT JOIN TB_CIDADES ON MOT_CID_CODIGO = CID_CODIGO
        LEFT JOIN TB_ESTABELECIMENTOS ON CID_CODIGO = EST_CID_CODIGO
    WHERE MOT_CODIGO = $codigo");
    $resultado = $consulta->fetch_assoc();
}else{
    echo
        "<script>
        location.href = 'index.php';
        </script>";
}
$aux = 0;
?>
<div class="main-panel">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div style="display: flex;justify-content: space-between;align-items: center;">
                <a class="navbar-brand" href="#">Alugar moto</a>
                <button class="btn btn-dark btn-fill btn-wd" id="show-menu" data-clique="false">Menu</button>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container-fluid">
            <div class="col-md-6">
                <div class="card">
                    <div class="class-body">
                        <div class="content">
                            <form action = "?" method = "POST">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h3 class='card-title'>Aluguel</h3>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label >Data de início</label>
                                        <input type="date" name = "datai" class="form-control border-input" required>
                                    </div> 
                                    <div class="col-md-6">
                                        <label >Data de fim</label>
                                        <input type="date" name = "dataf" class="form-control border-input" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <h5>Estabelecimento</h5>
                                        <label><?php echo $resultado['EST_BAIRRO']." ".$resultado['EST_RUA'].", ".$resultado['EST_LOGRADOURO']; ?></label>
                                    </div> 
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <center>
                                            <h3>
                                                <span class="material-icons">
                                                    report_problem
                                                </span>
                                                Atenção!
                                            </h3>
                                        </center>
                                        <label>Ao clicar em "Confirmar" você estará concordando que leu todos os <b>termos contratuais</b>, declara que cumpre todas as <b>condições predefinidas</b> e tem a posse de todos os <b>documentos</b> citados em nosso <b><a href="condicoes.php">contrato</a></b>.</label>
                                    </div>
                                    <input name = "diaria" type="hidden" class="form-control border-input" value="<?php echo $resultado['MOT_DIARIA']; ?>" required>
                                    <input name = "fds" type="hidden" class="form-control border-input" value="<?php echo $resultado['MOT_FIMDESEMANA']; ?>" required>
                                    <input name = "codigo" type="hidden" class="form-control border-input" value="<?php echo $resultado['MOT_CODIGO'] ?>" required>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-danger btn-fill btn-wd">Confirmar</button>
                                            <a href="index.php" class="btn btn-info btn-fill btn-wd" style="color: #F2EFE4; float: left">Voltar</a><br>
                                        </div>
                                    </div>
                                </div> 
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="class-body">
                        <div class="content">
                            <form action = "?" method = "POST">
                            	<center>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <img class="img-no-padding img-responsive" style="height: 500px" src="<?php echo $resultado['MOT_IMAGEM']; ?>"alt="..."/>
                                            <h2 class="product-name" style="color: black"><?php echo $resultado['MOT_MODELO']; ?></h2> 
                                            <h5>Diária: R$<?php echo $resultado['MOT_DIARIA']; ?></h5>
                                            <h5>Fim de semana: R$<?php echo $resultado['MOT_FIMDESEMANA']; ?></h5>
                                        </div>    
                                    </div>
                                </center>
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