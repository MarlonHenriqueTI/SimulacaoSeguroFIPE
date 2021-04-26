<?php 
include('web-veiculos.php');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://veiculos.fipe.org.br/api/veiculos/ConsultarTabelaDeReferencia",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\r\n  \"codigoTabelaReferencia\": 239,\r\n  \"codigoTipoVeiculo\": 1,\r\n  \"codigoMarca\": 26,\r\n  \"ano\": \"2011-1\",\r\n  \"codigoTipoCombustivel\": 1,\r\n  \"anoModelo\": 2011,\r\n  \"codigoModelo\": 4403,\r\n  \"tipoConsulta\": \"tradicional\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Host: veiculos.fipe.org.br",
    "Postman-Token: 1fbc7887-b14c-439c-9e8f-e653e27d34f4",
    "Referer: http://veiculos.fipe.org.br",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    $resposta = json_decode($response);
    $res = $resposta[0];
}

$op = 0;
$nome = "";
$email = "";
$telefone = "";
$cep ="";
$tipo = "";
$marca = "";
$modelo = "";
$anoModelo = "";
$valor = "";
$cidade = "";
$aplicativo = "";
$referencia = $res->Codigo;



if(isset($_POST["op"])){
    $op = $_POST["op"];
    if(isset($_POST["nome"])){
        $nome = $_POST["nome"];
    }
    
    if(isset($_POST["email"])){
        $email = $_POST["email"];
    }

    if(isset($_POST["telefone"])){
        $telefone = $_POST["telefone"];
    }

    if(isset($_POST["cep"])){
        $cep = $_POST["cep"];
    }

    if(isset($_POST["tipo"])){
        $tipo = $_POST["tipo"];
    }

    if(isset($_POST["marca"])){
        $marca = $_POST["marca"];
    }

    if(isset($_POST["modelo"])){
        $modelo = $_POST["modelo"];
    }

    if(isset($_POST["anoModelo"])){
        $anoModelo = $_POST["anoModelo"];
    }

    if(isset($_POST["valor"])){
        $valor = $_POST["valor"];
    }

    if(isset($_POST["cidade"])){
        $cidade = $_POST["cidade"];
    }
    if(isset($_POST["estado"])){
        $estado = $_POST["estado"];
    }
    if(isset($_POST["aplicativo"])){
        $aplicativo = $_POST["aplicativo"];
    }
    if(isset($_POST["placa"])){
        $placa = $_POST["placa"];
    }
    if(isset($_POST["promocional"])){
        $promocional = $_POST["promocional"];
    }

}

/*
if($op == 7){


    $destinatario = "atendimento@granprime.org.br"; //Seu e-mail vai aqui

     // monta o e-mail na variavel $body

    $body = "===================================" . "\n";
    $body = $body . "Seguro, preenchimento de formulário" . "\n";
    $body = $body . "===================================" . "\n\n";
    $body = $body . "Seguem os dados do usuário que preencheu o formulário:\n"; 
    $body = $body . "nome: " . $nome . "\n"; 
    $body = $body . "email: " . $email . "\n"; 
    $body = $body . "telefone: " . $telefone . "\n"; 
    $body = $body . "motorista de aplicativo?: " . $aplicativo . "\n";
    $body = $body . "===================================" . "\n";
    $body = $body . "Formulário preenchido no dia:".date("d/m/Y às H:i:s")." \n";
     $body = $body . "===================================" . "\n\n";
    $body = $body . "Veiculo: ".$marca." ".$modelo."\n"; 
    $body = $body . "Código Fipe: " . $cod . "\n"; 
    $body = $body . "Mês de Referência: " . $mes_referencia . "\n"; 
    $body = $body . "Valor do veículo: " . $valor . "\n";
    $body = $body . "Valor de adesão: " . $valor_adesao . "\n";
    $body = $body . "Valor mensal: " . $valor_mensal . "\n";   //Aqui vai a mensagem do e-mail
   

    // envia o email
    mail($destinatario, 'Cotação' , $body, "From: $destinatario\r\n");

}

$regiao = 0;
if( (($cep>=27510000)&&($cep<=27511620))||(($cep>=27210000)&&($cep<=27211130))||(($cep>=27110000)&&($cep<=27114400))||(($cep>=27580000)&&($cep<=27580991))||(($cep>=27310000)&&($cep<=27399999))||(($cep>=27100000)&&($cep<=27113400))||(($cep>=23900010)&&($cep<=23902710))||(($cep>=23970000)&&($cep<=23975990))||(($cep>=27197000)&&($cep<=27197970))||(($cep>=27570000)&&($cep<=27570971))||(($cep>=27410000)&&($cep<=27430080))||(($cep>=28890001)&&($cep<=28890169))||(($cep>=27600000)&&($cep<=27655971))||(($cep>=25870000)&&($cep<=25875990))||(($cep==25845000)||($cep==25845970))||(($cep>=26650000)&&($cep<=26650991))||(($cep>=26700000)&&($cep<=26700970))||(($cep>=26900000)&&($cep<=26900990))||(($cep>=25850000)&&($cep<=25850990))||(($cep>=26950000)&&($cep<=26950992))||(($cep>=25610000)&&($cep<=25615075))||(($cep>=27460000)&&($cep<=27465990))||(($cep>=27660000)&&($cep<=27660990)) ||(($cep>=25780000)&&($cep<=25780970)) ||(($cep>=25880000)&&($cep<=25882991)) ||(($cep>=25802000)&&($cep<=25815025)) ||(($cep>=27700000)&&($cep<=27705990))||(($cep>=25000000)&&($cep<=29000000)) ){
    $regiao = 0;
} else {
    $regiao = 1;
}

*/

if(($nome_cidade == "Areal")||($nome_cidade == "Barra do Piraí")||($nome_cidade == "Barra Mansa")||($nome_cidade == "Comendador Levy Gasparian")||($nome_cidade == "Engenheiro Paulo de Frontin")||($nome_cidade == "Itatiaia")||($nome_cidade == "Mendes")||($nome_cidade == "Miguel Pereira")||($nome_cidade == "Paraíba do Sul")||($nome_cidade == "Parati")||($nome_cidade == "Paty do Alferes")||($nome_cidade == "Petrópolis")||($nome_cidade == "Pinheiral")||($nome_cidade == "Piraí")||($nome_cidade == "Porto Real")||($nome_cidade == "Quatis")||($nome_cidade == "Resende")||($nome_cidade == "Rio Claro")||($nome_cidade == "Rio das Flores")||($nome_cidade == "São José do Vale do Rio Preto")||($nome_cidade == "Sapucaia")||($nome_cidade == "Três Rios")||($nome_cidade == "Valença")||($nome_cidade == "Vassouras")||($nome_cidade == "Volta Redonda")){
    $regiao = 0;
}else{
    $regiao = 1;
}

 ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <script>
  fbq('track', 'Lead', {
    value: 400,
    currency: 'BRL',
  });
</script>
    <meta charset="UTF-8">
    <title>Simule </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="icon" href="https://www.granprime.org.br/wp-content/uploads/2018/12/cropped-iCon-1-32x32.png" sizes="32x32" />
<link rel="icon" href="https://www.granprime.org.br/wp-content/uploads/2018/12/cropped-iCon-1-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon-precomposed" href="https://www.granprime.org.br/wp-content/uploads/2018/12/cropped-iCon-1-180x180.png" />
<meta name="msapplication-TileImage" content="https://www.granprime.org.br/wp-content/uploads/2018/12/cropped-iCon-1-270x270.png" />

</head>

<body translate="no">
    <script src="assets/js/main.js"></script>
    <div class="wrapper">
		<div class="box">teste</div>
		<div class="box">
        <?php if($op == 0){ ?>
        <form action="index.php" method="POST" id="msform">
            <fieldset>
                <img src="assets/img/logan.png" alt="logo" class="logo">
            <h3>Simule Agora</h3>
            <div class="form-group">
                <input type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="Seu nome" name="nome" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" aria-describedby="email" placeholder="Seu email" name="email" required>
				</div>
            <div class="form-group">
                <input type="text" class="form-control" id="Telefone" aria-describedby="Telefone" placeholder="Seu Telefone" name="telefone" required>
            </div>
            <input type="text" value="1" name="op" style="display: none;">
            <button type="submit" class="action-button">Continuar</button>
            </fieldset>
			</form></div>
    <?php } else if($op == 1) { ?>
        <form action="index.php" method="POST" id="msform">

            <div class="form-group">
                <input type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="Seu nome" name="nome" required style="display: none;" <?php echo "value='".$nome."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" aria-describedby="email" placeholder="Seu email" name="email" required style="display: none;" <?php echo "value='".$email."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="Telefone" aria-describedby="Telefone" placeholder="Seu Telefone" name="telefone" required style="display: none;" <?php echo "value='".$telefone."'"; ?> >
            </div>


            <fieldset>
                <img src="assets/img/logan.png" alt="logo" class="logo">
            <h3>De onde você é?</h3>
            <div class="form-group">
                <input type="number" class="form-control" id="cep" aria-describedby="cep" placeholder="Digite seu cep" name="cep" required onkeypress='return SomenteNumero(event)' size="8" required>
            </div>
            <input type="text" value="2" name="op" style="display: none;">
            <a href="javascript:history.back()" class="action-button-previous"> Voltar </a>
            <button type="submit" class="action-button">Continuar</button>
            </fieldset>
        </form>

    <?php } else if($op == 2){ ?>
        <form action="index.php" method="POST" id="msform">


            <div class="form-group">
                <input type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="Seu nome" name="nome" required style="display: none;" <?php echo "value='".$nome."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" aria-describedby="email" placeholder="Seu email" name="email" required style="display: none;" <?php echo "value='".$email."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="Telefone" aria-describedby="Telefone" placeholder="Seu Telefone" name="telefone" required style="display: none;" <?php echo "value='".$telefone."'"; ?> >
                <input type="text" class="form-control" id="cep" aria-describedby="cep" placeholder="Digite seu cep" name="cep" required onkeypress='return SomenteNumero(event)' size="8" style="display: none;" <?php echo "value='".$cep."'"; ?> > 


            <fieldset>
                <img src="assets/img/logan.png" alt="logo" class="logo">
                <?php 
                    $res = buscaCep($cep);
                    $resposta = json_decode($res);
                    $nome_cidade = $resposta->cidade;
                    $estado = $resposta->uf;
                 ?>
            <h3>Você é de <?php echo $resposta->cidade." - ".$resposta->uf; ?> </h3>
            <h3 style="color: #fff; margin-top: 20px;">Agora vamos pegar algumas informações sobre seu veiculo</h3>
            <div class="form-group">
                <select name="aplicativo" id="aplicativo" class="form-control">
                    <option value="">Você é motorista de aplicativo?</option>
                    <option value="Não">Não</option>
                    <option value="Sim">Sim</option>
                </select>
            </div>
            <div class="form-group">
                <select name="tipo" id="tipo" class="form-control">
                    <option value="">Selecione o tipo de veiculo</option>
                    <option value="1">Carro</option>
                    <option value="2">Moto</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="placa" placeholder="Digite a placa do veiculo">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="promocional" placeholder="Digite seu código promocional caso o tenha">
            </div>
            <input type="text" value="3" name="op" style="display: none;">
            <a href="javascript:history.back()" class="action-button-previous"> Voltar </a>
            <button type="submit" class="action-button">Continuar</button>
            </fieldset>
        </form>
    <?php } else if($op == 3){ ?>
        <form action="index.php" method="POST" id="msform">


            <div class="form-group">
                <input type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="Seu nome" name="nome" required style="display: none;" <?php echo "value='".$nome."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" aria-describedby="email" placeholder="Seu email" name="email" required style="display: none;" <?php echo "value='".$email."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="Telefone" aria-describedby="Telefone" placeholder="Seu Telefone" name="telefone" required style="display: none;" <?php echo "value='".$telefone."'"; ?> >
                <input type="text" class="form-control" id="cep" aria-describedby="cep" placeholder="Digite seu cep" name="cep" required onkeypress='return SomenteNumero(event)' size="8" style="display: none;" <?php echo "value='".$cep."'"; ?> > 


            <fieldset>
                <img src="assets/img/logan.png" alt="logo" class="logo">
                <?php 
                    $res = buscaCep($cep);
                    $resposta = json_decode($res);
                 ?>
            <h3>Você é de <?php echo $resposta->cidade." - ".$resposta->uf; ?> </h3>
            <h3 style="color: #7300AB; margin-top: 20px;">Agora vamos pegar algumas informações sobre seu veiculo</h3>
            <div class="form-group">
                <select name="tipo" id="tipo" class="form-control">
                    <?php if($tipo == 1){ ?>
                    <option value="1">Carro</option>
                    <?php } else if($tipo == 2){ ?>
                    <option value="2">Moto</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <select name="aplicativo" id="aplicativo" class="form-control" style="display: none;">
                    <?php if($aplicativo == "Não"){ ?>
                    <option value="Não">Não</option>
                    <?php } else if($aplicativo == "Sim"){ ?>
                    <option value="Sim">Sim</option>
                    <?php } ?>
                </select>
            </div>
            <input type="text" class="form-control" name="placa" placeholder="Digite a placa do veiculo" style="display: none;" <?php echo 'value="'.$placa.'"'; ?>>
                            <input type="text" class="form-control" name="promocional" placeholder="Digite seu código promocional caso o tenha" style="display: none;" <?php echo 'value="'.$promocional.'"'; ?>>
            <div class="form-group">
                <select name="marca" id="marca" class="form-control" onchange="submeter('msform')">
                    <option value="">Selecione a marca do seu veiculo</option>
                    <?php 

                        $res = consultarMarcas($referencia,$tipo);
                        $resposta = json_decode($res);
                        foreach ($resposta as $key => $value) {
                            echo "<option value=".$value->Value.">".$value->Label."</option>";
                        }

                     ?>
                </select>
            </div>
            <input type="text" value="4" name="op" style="display: none;">
            <a href="javascript:history.back()" class="action-button-previous"> Voltar </a>
            <button type="submit" class="action-button">Continuar</button>
            </fieldset>
        </form>
    <?php } else if($op == 4){?>
        <form action="index.php" method="POST" id="msform">


            <div class="form-group">
                <input type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="Seu nome" name="nome" required style="display: none;" <?php echo "value='".$nome."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" aria-describedby="email" placeholder="Seu email" name="email" required style="display: none;" <?php echo "value='".$email."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="Telefone" aria-describedby="Telefone" placeholder="Seu Telefone" name="telefone" required style="display: none;" <?php echo "value='".$telefone."'"; ?> >
                <input type="text" class="form-control" id="cep" aria-describedby="cep" placeholder="Digite seu cep" name="cep" required onkeypress='return SomenteNumero(event)' size="8" style="display: none;" <?php echo "value='".$cep."'"; ?> > 


            <fieldset>
                <img src="assets/img/logan.png" alt="logo" class="logo">
                <?php 
                    $res = buscaCep($cep);
                    $resposta = json_decode($res);
                 ?>
            <h3>Você é de <?php echo $resposta->cidade." - ".$resposta->uf; ?> </h3>
            <h3 style="color: #7300AB; margin-top: 20px;">Agora vamos pegar algumas informações sobre seu veiculo</h3>
            <div class="form-group">
                <select name="tipo" id="tipo" class="form-control">
                    <?php if($tipo == 1){ ?>
                    <option value="1">Carro</option>
                    <?php } else if($tipo == 2){ ?>
                    <option value="2">Moto</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <select name="aplicativo" id="aplicativo" class="form-control" style="display: none;">
                    <?php if($aplicativo == "Não"){ ?>
                    <option value="Não">Não</option>
                    <?php } else if($aplicativo == "Sim"){ ?>
                    <option value="Sim">Sim</option>
                    <?php } ?>
                </select>
            </div>
            <input type="text" class="form-control" name="placa" placeholder="Digite a placa do veiculo" style="display: none;" <?php echo 'value="'.$placa.'"'; ?>>
            <input type="text" class="form-control" name="promocional" placeholder="Digite seu código promocional caso o tenha" style="display: none;" <?php echo 'value="'.$promocional.'"'; ?>>
            <div class="form-group">
                <select name="marca" id="marca" class="form-control">
                    <?php 

                        $res = consultarMarcas($referencia,$tipo);
                        $resposta = json_decode($res);
                        foreach ($resposta as $key => $value) {
                            if($marca == $value->Value){
                            echo "<option value=".$value->Value.">".$value->Label."</option>";
                            }
                        }

                     ?>
                </select>
            </div>
            <div class="form-group">
                <select name="modelo" id="modelo" class="form-control" onchange="submeter('msform')" >
                    <option value="">Selecione o modelo do seu veiculo</option>
                    <?php 

                        $res = consultarModelos($referencia,$tipo, $marca);
                        $resposta = json_decode($res);
                        foreach ($resposta as $key => $value) {
                           foreach($value as $key){

                            $tagsArray = explode(' ', $key->Label);
                            $gas = 'Gasolina';
                            $alc = 'Álcool';
                            $dis = 'Diesel';
                                if (in_array($gas, $tagsArray)) {
                                  echo 'Tag encontrada';
                                } else  if (in_array($alc, $tagsArray)) {
                                  echo 'Tag não encontrada';
                                } else  if (in_array($dis, $tagsArray)) {
                                  echo 'Tag não encontrada';
                                } else {
                                     echo "<option value=".$key->Value.">".$key->Label."</option>"; 
                                }  
                            }
                        }

                     ?>
                </select>
            </div>
            <input type="text" value="5" name="op" style="display: none;">
            <a href="javascript:history.back()" class="action-button-previous"> Voltar </a>
            <button type="submit" class="action-button">Continuar</button>
            </fieldset>
        </form>
    <?php } else if($op == 5){ ?>
        <form action="index.php" method="POST" id="msform">


            <div class="form-group">
                <input type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="Seu nome" name="nome" required style="display: none;" <?php echo "value='".$nome."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" aria-describedby="email" placeholder="Seu email" name="email" required style="display: none;" <?php echo "value='".$email."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="Telefone" aria-describedby="Telefone" placeholder="Seu Telefone" name="telefone" required style="display: none;" <?php echo "value='".$telefone."'"; ?> >
                <input type="text" class="form-control" id="cep" aria-describedby="cep" placeholder="Digite seu cep" name="cep" required onkeypress='return SomenteNumero(event)' size="8" style="display: none;" <?php echo "value='".$cep."'"; ?> > 


            <fieldset>
                <img src="assets/img/logan.png" alt="logo" class="logo">
                <?php 
                    $res = buscaCep($cep);
                    $resposta = json_decode($res);
                 ?>
            <h3>Você é de <?php echo $resposta->cidade." - ".$resposta->uf; ?> </h3>
            <h3 style="color: #7300AB; margin-top: 20px;">Agora vamos pegar algumas informações sobre seu veiculo</h3>
            <div class="form-group">
                <select name="tipo" id="tipo" class="form-control">
                    <?php if($tipo == 1){ ?>
                    <option value="1">Carro</option>
                    <?php } else if($tipo == 2){ ?>
                    <option value="2">Moto</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <select name="aplicativo" id="aplicativo" class="form-control" style="display: none;">
                    <?php if($aplicativo == "Não"){ ?>
                    <option value="Não">Não</option>
                    <?php } else if($aplicativo == "Sim"){ ?>
                    <option value="Sim">Sim</option>
                    <?php } ?>
                </select>
            </div>
            <input type="text" class="form-control" name="placa" placeholder="Digite a placa do veiculo" style="display: none;" <?php echo 'value="'.$placa.'"'; ?>>
            <input type="text" class="form-control" name="promocional" placeholder="Digite seu código promocional caso o tenha" style="display: none;" <?php echo 'value="'.$promocional.'"'; ?>>
            <div class="form-group">
                <select name="marca" id="marca" class="form-control">
                    <?php 

                        $res = consultarMarcas($referencia,$tipo);
                        $resposta = json_decode($res);
                        foreach ($resposta as $key => $value) {
                            if($marca == $value->Value){
                            echo "<option value=".$value->Value.">".$value->Label."</option>";
                            }
                        }

                     ?>
                </select>
            </div>
            <div class="form-group">
                <select name="modelo" id="modelo" class="form-control">
                    <?php 

                        $res = consultarModelos($referencia,$tipo, $marca);
                        $resposta = json_decode($res);
                        foreach ($resposta as $key => $value) {
                           foreach($value as $key){
                            if($modelo == $key->Value) {                               echo "<option value=".$key->Value.">".$key->Label."</option>";
                            }
                           }
                        }
                        

                     ?>
                </select>
            </div>
            <div class="form-group">
                <select name="anoModelo" id="anoModelo" class="form-control" onchange="submeter('msform')">
                    <option value="">Qual o ano do seu modelo?</option>
                    <?php 

                        $res = consultarAnoModelo($referencia,$tipo, $marca, $modelo);
                        $resposta = json_decode($res);
                         foreach ($resposta as $key => $value) {
                            echo "<option value=".$value->Value.">".$value->Label."</option>";
                        }
                    ?>
                </select>
            </div>
            <input type="text" value="6" name="op" style="display: none;">
            <a href="javascript:history.back()" class="action-button-previous"> Voltar </a>
            <button type="submit" class="action-button">Continuar</button>
            </fieldset>
        </form>
    <?php } else if($op == 6){ ?>
        <form action="index.php" method="POST" id="msform">


            <div class="form-group">
                <input type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="Seu nome" name="nome" required style="display: none;" <?php echo "value='".$nome."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" aria-describedby="email" placeholder="Seu email" name="email" required style="display: none;" <?php echo "value='".$email."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="Telefone" aria-describedby="Telefone" placeholder="Seu Telefone" name="telefone" required style="display: none;" <?php echo "value='".$telefone."'"; ?> >
                <input type="text" class="form-control" id="cep" aria-describedby="cep" placeholder="Digite seu cep" name="cep" required onkeypress='return SomenteNumero(event)' size="8" style="display: none;" <?php echo "value='".$cep."'"; ?> > 


            <fieldset>
                <img src="assets/img/logan.png" alt="logo" class="logo">
                <?php 
                    $res = buscaCep($cep);
                    $resposta = json_decode($res);
                    $cidade = $resposta->cidade;
                    $nome_cidade = $resposta->cidade;
                 ?>
            <h3>Você é de <?php echo $resposta->cidade." - ".$resposta->uf; ?> </h3>
            
            <div class="form-group">
                <select name="tipo" id="tipo" class="form-control" style="display: none;">
                    <?php if($tipo == 1){ ?>
                    <option value="1">Carro</option>
                    <?php } else if($tipo == 2){ ?>
                    <option value="2">Moto</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <select name="aplicativo" id="aplicativo" class="form-control" style="display: none;">
                    <?php if($aplicativo == "Não"){ ?>
                    <option value="Não">Não</option>
                    <?php } else if($aplicativo == "Sim"){ ?>
                    <option value="Sim">Sim</option>
                    <?php } ?>
                </select>
            </div>
            <input type="text" class="form-control" name="placa" placeholder="Digite a placa do veiculo" style="display: none;" <?php echo 'value="'.$placa.'"'; ?>>
            <input type="text" class="form-control" name="promocional" placeholder="Digite seu código promocional caso o tenha" style="display: none;" <?php echo 'value="'.$promocional.'"'; ?>>
            <div class="form-group">
                <select name="marca" id="marca" class="form-control" style="display: none;">
                    <?php 

                        $res = consultarMarcas($referencia,$tipo);
                        $resposta = json_decode($res);
                        foreach ($resposta as $key => $value) {
                            if($marca == $value->Value){
                            echo "<option value=".$value->Value.">".$value->Label."</option>";
                            }
                        }

                     ?>
                </select>
            </div>
            <div class="form-group">
                <select name="modelo" id="modelo" class="form-control" style="display: none;">
                    <?php 

                        $res = consultarModelos($referencia,$tipo, $marca);
                        $resposta = json_decode($res);
                        foreach ($resposta as $key => $value) {
                           foreach($value as $key){
                            if($modelo == $key->Value) {                               echo "<option value=".$key->Value.">".$key->Label."</option>";
                            }
                           }
                        }
                        

                     ?>
                </select>
            </div>
            <div class="form-group">
                <select name="anoModelo" id="anoModelo" class="form-control" style="display: none;">
                    <?php 

                        $res = consultarAnoModelo($referencia,$tipo, $marca, $modelo);
                        $resposta = json_decode($res);
                         foreach ($resposta as $key => $value) {
                            if($anoModelo == $value->Value){
                                echo "<option value=".$value->Value.">".$value->Label."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <input type="text" value="7" name="op" style="display: none;">

            <h3 style="margin-top: 20px;">Confirme as informações sobre seu veículo:</h3>
            <?php  
                $ano = explode("-",$anoModelo);
                $res = consultarVeiculo($referencia,$tipo,$marca,$anoModelo,$ano[1],$ano[0],$modelo);
                $resposta = json_decode($res);
                echo "<h3 style='color: #F30072;'><span style='color:#7300AB;'>Marca: </span>".$resposta->Marca."</h3>";
                echo "<h3 style='color: #F30072;'><span style='color:#7300AB;'>Modelo: </span>".$resposta->Modelo."</h3>";
                echo "<h3 style='color: #F30072;'><span style='color:#7300AB;'>Codigo Fipe: </span>".$resposta->CodigoFipe."</h3>";
                echo "<h3 style='color: #F30072;'><span style='color:#7300AB;'>Mês de referência: </span>".$resposta->MesReferencia."</h3>";
                 echo "<h3 style='color: #F30072;'><span style='color:#7300AB;'>Valor do Veiculo: </span>".$resposta->Valor."</h3>";

                 $marca = $resposta->Marca;
                 $modelo = $resposta->Modelo;
                 $cod = $resposta->CodigoFipe;
                 $mes_referencia = $resposta->MesReferencia;
                 $valor = $resposta->Valor;

             ?>
             <input type="text" name="valor" <?php echo "value='".$resposta->Valor."'"; ?> style="display: none;"> 
             <input type="text" name="cidade" <?php echo "value='".$cidade."'"; ?> style="display: none;"> 
             <a href="javascript:history.back()" class="action-button-previous"> Voltar </a>
            <button type="submit" class="action-button">Confirmar</button>
            </fieldset>
        </form>
    <?php } else if($op == 7){?>
        <form action="index.php" method="POST" id="msform">
            <fieldset>
                <img src="assets/img/logan.png" alt="logo" class="logo">
                <h3>Muito bem, em breve entraremos em contato com você! Obrigado.</h3>

                <?php 
                
                    $val = str_replace('.', '',substr($valor,2));

                    if($regiao == 1){//regiões do rio

                    if($tipo == 1 && $aplicativo == "Sim"){// carro motorista de aplicativo

                        if($val<=10000){ //até 10000
                           
                            $valor_adesao = "R$400,00";
                            $valor_mensal = "R$162,90";
                        } else if($val<=15000){ //até 15000
                            
                            $valor_adesao = "R$400,00";
                            $valor_mensal = "R$187,90";
                        }else if($val<=20000){ //até 20000
                           
                            $valor_adesao = "R$400,00";
                            $valor_mensal = "R$194,90";
                        }else if($val<=30000){ //até 30000
                            
                            $valor_adesao = "R$400,00";
                            $valor_mensal = "R$219,90";
                        }else if($val<=40000){ //até 40000
                           
                            $valor_adesao = "R$400,00";
                            $valor_mensal = "R$254,90";
                        }else if($val<=50000){ //até 50000
                            
                            $valor_adesao = "R$500,00";
                            $valor_mensal = "R$299,90";
                        }else if($val<=60000){ //até 60000
                            
                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$339,90";
                        }else if($val<=70000){ //até 70000
                           
                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$379,90";
                        }else if($val<=80000){ //até 80000
                           

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$429,90";
                        }else if($val<=90000){ //até 90000
                           
                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$479,90";
                        }else if($val<=100000){ //até 100000
                           
                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$499,90";
                        } else {
                             $valor_adesao = "Fora da tabela";
                            $valor_mensal = "Fora da tabela";
                        }

                    } else if($tipo == 1){ //carro

                        if($val<=10000){ //até 10000
                            
                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$112,90";
                        } else if($val<=15000){ //até 15000
                            
                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$137,90";
                        }else if($val<=20000){ //até 20000
                            
                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$144,90";
                        }else if($val<=30000){ //até 30000

                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$169,90";
                        }else if($val<=40000){ //até 40000
                           
                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$204,90";
                        }else if($val<=50000){ //até 50000
                            
                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$249,90";
                        }else if($val<=60000){ //até 60000
                            

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$289,90";
                        }else if($val<=70000){ //até 70000
                            

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$329,90";
                        }else if($val<=80000){ //até 80000
                           

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$379,90";
                        }else if($val<=90000){ //até 90000
                         

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$429,90";
                        }else if($val<=100000){ //até 100000
                            

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$449,90";
                        } else {
                             $valor_adesao = "Fora da tabela";
                            $valor_mensal = "Fora da tabela";
                        }

                    } else {  //moto
                        if($val<=5000){ //até 5000
                            

                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$74,90";
                        } else if($val<=10000){ //até 10000
                            
                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$124,90";
                        }else if($val<=15000){ //até 15000
                            
                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$147,90";
                        }else if($val<=20000){ //até 20000
                           

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$189,90";
                        } else {
                             $valor_adesao = "Fora da tabela";
                            $valor_mensal = "Fora da tabela";
                        }


                    }
                } else { // outros ceps

                    if($tipo == 1 && $aplicativo == "Sim"){// carro motorista de aplicativo

                        if($val<=10000){ //até 10000
                           
                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$139,90";
                        } else if($val<=15000){ //até 15000
                            

                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$157,90";
                        }else if($val<=20000){ //até 20000
                            

                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$162,90";
                        }else if($val<=30000){ //até 30000
                            

                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$169,90";
                        }else if($val<=40000){ //até 40000
                           

                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$207,90";
                        }else if($val<=50000){ //até 50000
                            

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$237,90";
                        }else if($val<=60000){ //até 60000
                            
                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$298,90";
                        }else if($val<=70000){ //até 70000
                           

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$319,90";
                        }else if($val<=80000){ //até 80000
                            

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$349,90";
                        }else if($val<=90000){ //até 90000
                            

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$379,90";
                        }else if($val<=100000){ //até 100000
                            

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$409,90";
                        } else {
                             $valor_adesao = "Fora da tabela";
                            $valor_mensal = "Fora da tabela";
                        }

                    } else if($tipo == 1){ //carro

                        if($val<=10000){ //até 10000
                            

                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$89,90";
                        } else if($val<=15000){ //até 15000
                           

                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$107,90";
                        }else if($val<=20000){ //até 20000
                           

                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$112,90";
                        }else if($val<=30000){ //até 30000
                           
                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$119,90";
                        }else if($val<=40000){ //até 40000
                            

                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$157,90";
                        }else if($val<=50000){ //até 50000
                           
                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$187,90";
                        }else if($val<=60000){ //até 60000
                            

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$248,90";
                        }else if($val<=70000){ //até 70000
                            
                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$269,90";
                        }else if($val<=80000){ //até 80000
                            

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$299,90";
                        }else if($val<=90000){ //até 90000
                            

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$329,90";
                        }else if($val<=100000){ //até 100000
                            

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$359,90";
                        } else {
                             $valor_adesao = "Fora da tabela";
                            $valor_mensal = "Fora da tabela";
                        }

                    } else {  //moto
                        if($val<=5000){ //até 5000
                           

                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$74,90";
                        } else if($val<=10000){ //até 10000
                            

                           $valor_adesao = "R$400,00";
                            $valor_mensal = "R$124,90";
                        }else if($val<=15000){ //até 15000
                           

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$147,90";
                        }else if($val<=20000){ //até 20000
                            

                           $valor_adesao = "R$500,00";
                            $valor_mensal = "R$189,90";
                        } else {
                           $valor_adesao = "Fora da tabela";
                            $valor_mensal = "Fora da tabela";
                        }


                    }

                }

                    $res = buscaCep($cep);
                    $resposta = json_decode($res);
                    $cidade = $resposta->cidade;
                    $estado = $resposta->uf;
                    $res = consultarAnoModelo($referencia,$tipo, $marca, $modelo);
                        $resposta = json_decode($res);
                         foreach ($resposta as $key => $value) {
                            if($anoModelo == $value->Value){
                                $anoCombustivel = $value->Label;
                            }
                        }
                        $ano = explode("-",$anoModelo);
                $res = consultarVeiculo($referencia,$tipo,$marca,$anoModelo,$ano[1],$ano[0],$modelo);
                $resposta = json_decode($res);
                echo "<h3 style='color: #F30072;'><span style='color:#7300AB;'>Marca: </span>".$resposta->Marca."</h3>";
                echo "<h3 style='color: #F30072;'><span style='color:#7300AB;'>Modelo: </span>".$resposta->Modelo."</h3>";
                echo "<h3 style='color: #F30072;'><span style='color:#7300AB;'>Codigo Fipe: </span>".$resposta->CodigoFipe."</h3>";
                echo "<h3 style='color: #F30072;'><span style='color:#7300AB;'>Mês de referência: </span>".$resposta->MesReferencia."</h3>";
                 echo "<h3 style='color: #F30072;'><span style='color:#7300AB;'>Valor do Veiculo: </span>".$resposta->Valor."</h3>";

                 $marca = $resposta->Marca;
                 $modelo = $resposta->Modelo;
                 $cod = $resposta->CodigoFipe;
                 $mes_referencia = $resposta->MesReferencia;
                 $valor = $resposta->Valor;

                  $destinatario = "atendimento@granprime.org.br"; //Seu e-mail vai aqui

                     // monta o e-mail na variavel $body

                    $body = "===================================" . "\n";
                    $body = $body . "Seguro, preenchimento de formulário" . "\n";
                    $body = $body . "===================================" . "\n\n";
                    $body = $body . "Seguem os dados do usuário que preencheu o formulário:\n"; 
                    $body = $body . "nome: " . $nome . "\n"; 
                    $body = $body . "email: " . $email . "\n"; 
                    $body = $body . "telefone: " . $telefone . "\n"; 
                    $body = $body . "cidade: " . $cidade . "\n"; 
                    $body = $body . "estado: " . $estado . "\n"; 
                    $body = $body . "motorista de aplicativo?: " . $aplicativo . "\n";
                    $body = $body . "===================================" . "\n";
                    $body = $body . "Formulário preenchido no dia:".date("d/m/Y")." \n";
                     $body = $body . "===================================" . "\n\n";
                      $body = $body . "Código Promocional: ".$promocional."\n"; 
                    $body = $body . "Marca: ".$marca."\n"; 
                     $body = $body ."Modelo: " . $modelo . "\n"; 
                     $body = $body ."Ano | Combustivel: " . $anoCombustivel . "\n"; 
                     $body = $body ."Placa: " . $placa . "\n"; 
                    $body = $body . "Código Fipe: " . $cod . "\n"; 
                    $body = $body . "Mês de Referência: " . $mes_referencia . "\n"; 
                    $body = $body . "Valor do veículo: " . $valor . "\n";
                    $body = $body . "Valor de adesão: " . $valor_adesao . "\n";
                    $body = $body . "Valor mensal: " . $valor_mensal . "\n";   //Aqui vai a mensagem do e-mail
                   

                    // envia o email
                    mail($destinatario, 'Atendimento Site' , $body, "From: $destinatario\r\n");
                    
                   mail("atendimento@granprime.org.br", 'Atendimento Site' , $body, "From: $destinatario\r\n");
                    mail("carlosfreitas@granprime.org.br", 'Atendimento Site' , $body, "From: $destinatario\r\n");
                    mail("renatopereira@granprime.org.br", 'Atendimento Site' , $body, "From: $destinatario\r\n");
                    mail("carinalaureano@granprime.org.br", 'Atendimento Site' , $body, "From: $destinatario\r\n");
                    mail("atendimento@m2track.com.br", 'Atendimento Site' , $body, "From: $destinatario\r\n");
                    
                ?> 
                <div style="margin: 40px!important;">  
                    <a href="javascript:history.back()" class="action-button-previous"> Voltar </a>
                    <a href="https://www.granprime.org.br/" class="action-button" style="margin-top: 20px; display: inline-block;" >Voltar Para o Site</a> 
                </div>
            </fieldset>

        </form>
    <?php } ?>
    </div>
    <!-- /.MultiStep Form -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>