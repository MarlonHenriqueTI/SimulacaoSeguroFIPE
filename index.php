<?php 
include('web-veiculos.php');
include('conecta-db.php');
function cadastrarCliente($conexao, $nome, $email, $telefone, $cidade, $estado, $aplicativo, $codigo, $marca, $modelo, $anoCombustivel, $placa, $cod_fipe, $mes_referencia, $valor){
    $query = "INSERT INTO `cliente`(`nome`, `email`, `telefone`, `cidade`, `estado`, `aplicativo`, `codigo`, `marca`, `modelo`, `anoCombustivel`, `placa`, `cod_fipe`, `mes_referencia`, `valor`) VALUES ('$nome', '$email', '$telefone', '$cidade', '$estado', '$aplicativo', '$codigo', '$marca', '$modelo', '$anoCombustivel', '$placa', '$cod_fipe', '$mes_referencia', '$valor')";
    $resultado = mysqli_query($conexao, $query);
    if(!$resultado){
        echo '<script>alert("O seu e-mail já estava cadastrado em nossa base de dados e por isso não conseguimos fazer seu cadastro.");</script>';
    }
}

function selecionarClienteEmail($conexao, $email){
    $query = "SELECT * FROM `cliente` WHERE `placa` = '$email'";
    $resultado = mysqli_query($conexao, $query);
    if(!$resultado){
        echo '<script>alert("cliente não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res[0];
    }
}

function selecionarTodosCodTime($conexao){
    $query = "SELECT * FROM `codtime`";
    $resultado = mysqli_query($conexao, $query);
    if(!$resultado){
        echo '<script>alert("Código não encontrado");</script>';
    } else {
        foreach ($resultado as $key) {
            $res[] = $key;
        }
        return $res;
    }
}

function selecionarCodTime($conexao, $cod){
    $query = "SELECT * FROM `codtime` where `cod` = '$cod'";
    $resultado = mysqli_query($conexao, $query);
    if(mysqli_num_rows($resultado) > 0){
        echo '<script>alert("Código aplicado");</script>';
        return 1;
    } else {
         echo '<script>alert("O código promocional digitado não se encontra em nossa base de dados, por favor digite um novo código");</script>';
        return 0;
    }
}

function selecionarClienteEmailTeste($conexao, $email){
    $query = "SELECT * FROM `cliente` WHERE `placa` = '$email'";
    $resultado = mysqli_query($conexao, $query);
    if(mysqli_num_rows($resultado) > 0){
        echo '<script>alert("Este veículo já se encontra cadastrado, por favor selecione um novo veículo...");</script>';
        return 2;
    } else {
         
        return 3;
    }
}

function cadastrarCodigo($conexao, $id_codigo, $id_cliente){
    $query = "INSERT INTO `codigo`(`id_codigo`, `id_cliente`) VALUES ('$id_codigo', '$id_cliente')";
    $resultado = mysqli_query($conexao, $query);
    if(!$resultado){
        echo '<script>alert("Falha ao cadastrar codigo");</script>';
    }
}

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
        if (!empty($placa) && $op == 3) {
           $op = selecionarClienteEmailTeste($conexao, $placa);
        }
    }
    if(isset($_POST["promocional"])){
        $promocional = $_POST["promocional"];
        if (!empty($promocional) && $op == 1) {
           $op = selecionarCodTime($conexao, $promocional);
        }
        

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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Landing Page granprime">
    <meta name="author" content="Gran prime">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
	<meta property="og:site_name" content="" /> <!-- website name -->
	<meta property="og:site" content="" /> <!-- website link -->
	<meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
	<meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
	<meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
	<meta property="og:url" content="" /> <!-- where do you want your post to link to -->
	<meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>Simule Agora</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="css/swiper.css" rel="stylesheet">
	<link href="css/magnific-popup.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!-- Favicon  -->
    <link rel="icon" href="images/favicon.png">
            <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-150473697-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-150473697-1');
          gtag('config', 'AW-780384052');
        </script>
        
        <!-- Facebook Pixel Code -->
        <script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};
          if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
          n.queue=[];t=b.createElement(e);t.async=!0;
          t.src=v;s=b.getElementsByTagName(e)[0];
          s.parentNode.insertBefore(t,s)}(window, document,'script',
          'https://connect.facebook.net/en_US/fbevents.js');
          fbq('init', '676843626158915');
          fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
          src="https://www.facebook.com/tr?id=676843626158915&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->
        
        <!-- Event snippet for Iniciou o formulário de simulação (C4) conversion page -->
        <script>
          gtag('event', 'conversion', {'send_to': 'AW-780384052/z7pCCJSV2bIBELTujvQC'});
        </script>

    

    <link rel="icon" href="https://www.granprime.org.br/wp-content/uploads/2018/12/cropped-iCon-1-32x32.png" sizes="32x32" />
<link rel="icon" href="https://www.granprime.org.br/wp-content/uploads/2018/12/cropped-iCon-1-192x192.png" sizes="192x192" />

</head>
<body data-spy="scroll" data-target=".fixed-top">
    
 <!--
	<div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div> --> 
    

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom" style="position: absolute;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1030;">
        <div class="container">

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Tivo</a> -->

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="index.html"><img src="images/logo.png" alt="alternative" width="776" height="300" id="logo"></a> 
            
            <!-- Mobile Menu Toggle Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <!-- end of mobile menu toggle button -->

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#header"> <span class="sr-only">urrent)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#features">&nbsp;</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#details">&nbsp;</a>
                    </li>

                    <!-- Dropdown Menu -->          
                    <li class="nav-item dropdown">
<div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="article-details.html"><span class="item-text"></span></a>
              <div class="dropdown-items-divide-hr"></div>
                            <a class="dropdown-item" href="terms-conditions.html"><span class="item-text"></span></a>
                            <div class="dropdown-items-divide-hr"></div>
                            <a class="dropdown-item" href="privacy-policy.html"><span class="item-text"></span></a>
                        </div>
                    </li>
                    <!-- end of dropdown menu -->

                    <li class="nav-item">
						</li>
                </ul>
                <span class="nav-item">
                </span>
            </div>
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <header id="header" class="header" >
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-xl-5">
                        <div class="text-container">
							<img src="images/mulhe.png" alt="" width="100%" height="505" id="mul"/>
                                          </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                    <div class="col-lg-6 col-xl-7">
                        <div class="image-container">
                            <div class="img-wrapper">
                                <img src="images/letras1.png" alt="alternative" class="img-fluid" id="euacredito">
								<br>
								
								<!-- form aqui -->
								
 <?php if($op == 0){ ?>
        <form style="z-index:1000;position:relative;" action="index.php" method="POST" id="msform">
            <fieldset>
                <hr>

            <div class="form-group">
                <input type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="Seu nome" name="nome" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" aria-describedby="email" placeholder="Seu email" name="email" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="Telefone" aria-describedby="Telefone" placeholder="Seu Telefone" name="telefone" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="promocional" placeholder="Digite seu código promocional caso o tenha">
            </div>
            <input type="text" value="1" name="op" style="display: none;">
            <button type="submit" class="action-button">Continuar</button>
            </fieldset>
        </form>
    <?php } else if($op == 1) { ?>
        <form style="z-index:1000;position:relative;" action="index.php" method="POST" id="msform">

            <div class="form-group">
                <input type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="Seu nome" name="nome" required style="display: none;" <?php echo "value='".$nome."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" aria-describedby="email" placeholder="Seu email" name="email" required style="display: none;" <?php echo "value='".$email."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="Telefone" aria-describedby="Telefone" placeholder="Seu Telefone" name="telefone" required style="display: none;" <?php echo "value='".$telefone."'"; ?> >
            </div>

            <input type="text" class="form-control" name="promocional" placeholder="Digite seu código promocional caso o tenha" style="display: none;" <?php echo 'value="'.$promocional.'"'; ?>>
            <fieldset>
                <hr>
            <h3 style="color: #fff;">De onde você é?</h3>

            <div class="form-group">
                <input type="number" class="form-control" id="cep" aria-describedby="cep" placeholder="Digite seu cep" name="cep" required onkeypress='return SomenteNumero(event)' size="8" required>
            </div>
            <input type="text" value="2" name="op" style="display: none;">
            <button type="submit" class="action-button btn">Continuar</button>
            <div class="form-group" style="padding-top: 10px;">
                <a href="javascript:history.back()" class="btn btn-danger" style="width: 100%; text-decoration: none;"> Voltar </a>
            </div>
            </fieldset>
        </form>

    <?php } else if($op == 2){ ?>
        <form style="z-index:1000;position:relative;" action="index.php" method="POST" id="msform">


            <div class="form-group">
                <input type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="Seu nome" name="nome" required style="display: none;" <?php echo "value='".$nome."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" aria-describedby="email" placeholder="Seu email" name="email" required style="display: none;" <?php echo "value='".$email."'"; ?> >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="Telefone" aria-describedby="Telefone" placeholder="Seu Telefone" name="telefone" required style="display: none;" <?php echo "value='".$telefone."'"; ?> >
                <input type="text" class="form-control" id="cep" aria-describedby="cep" placeholder="Digite seu cep" name="cep" required onkeypress='return SomenteNumero(event)' size="8" style="display: none;" <?php echo "value='".$cep."'"; ?> > 

                <input type="text" class="form-control" name="promocional" placeholder="Digite seu código promocional caso o tenha" style="display: none;" <?php echo 'value="'.$promocional.'"'; ?>>
            <fieldset>
                <?php 
                    $res = buscaCep($cep);
                    $resposta = json_decode($res);
                    $nome_cidade = $resposta->cidade;
                    $estado = $resposta->uf;
                 ?>
                 <hr>
            <h3 style="color: #fff; text-transform: uppercase; text-align: center;">Você é de <?php echo $resposta->cidade." - ".$resposta->uf; ?> </h3>
         
            <h3 style="color: #fff; margin-top: 10px;text-align: center;">Agora vamos pegar algumas informações sobre seu veiculo</h3>
            <div class="form-group">
                <select name="aplicativo" id="aplicativo" class="form-control" required onchange="appNaoPode()">
                    <option value="" disabled selected>Você é motorista de aplicativo?</option>
                    <option value="Não">Não</option>
                    <option value="Sim">Sim</option>
                </select>
            </div>
            
            <div id="divtal" style="display: none; border: 1px solid red; margin-bottom: 15px;">Desde o dia 01/01/2020 a Gran Prime associados não realiza mais a adesão de motoristas de aplicativo. Caso você seja motorista de APP e informar que não é, seu ressarcimento pode ser negado em casos de eventualidades como roubo, furto e etc.</div>
            
            
            
            <div class="form-group">
                <select name="tipo" id="tipo" class="form-control">
                    <option value="">Selecione o tipo de veiculo</option>
                    <option value="1">Carro</option>
                    <option value="2">Moto</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="placa" placeholder="Digite a placa do veiculo" required onkeypress='return placaSemHifen(event)' style="text-transform: uppercase;">
            </div>
            <input type="text" value="3" name="op" style="display: none;">
            <button type="submit" class="action-button btn" id="botaocontinuar">Continuar</button>
            <div class="form-group" style="padding-top: 10px;">
                <a href="javascript:history.back()" class="btn btn-danger" style="width: 100%; text-decoration: none;"> Voltar </a>
            </div>
            </fieldset>
        </form>
    <?php } else if($op == 3){ ?>
        <form style="z-index:1000;position:relative;" action="index.php" method="POST" id="msform">


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
                
                <?php 
                    $res = buscaCep($cep);
                    $resposta = json_decode($res);
                 ?>
                 <hr>
            <h3 style="color: #fff; text-transform: uppercase; text-align: center;">Você é de <?php echo $resposta->cidade." - ".$resposta->uf; ?> </h3>
         
            <h3 style="color: #fff; margin-top: 10px;text-align: center;">Agora vamos pegar algumas informações sobre seu veiculo</h3>
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
            <button type="submit" class="action-button btn">Continuar</button>
            <div class="form-group" style="padding-top: 10px;">
                <a href="javascript:history.back()" class="btn btn-danger" style="width: 100%; text-decoration: none;"> Voltar </a>
            </div>
            </fieldset>
        </form>
    <?php } else if($op == 4){?>
        <form style="z-index:1000;position:relative;" action="index.php" method="POST" id="msform">


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
                
                <?php 
                    $res = buscaCep($cep);
                    $resposta = json_decode($res);
                 ?>
            <hr>
            <h3 style="color: #fff; text-transform: uppercase; text-align: center;">Você é de <?php echo $resposta->cidade." - ".$resposta->uf; ?> </h3>
         
            <h3 style="color: #fff; margin-top: 10px;text-align: center;">Agora vamos pegar algumas informações sobre seu veiculo</h3>
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
            <button type="submit" class="action-button btn">Continuar</button>
            <div class="form-group" style="padding-top: 10px;">
                <a href="javascript:history.back()" class="btn btn-danger" style="width: 100%; text-decoration: none;"> Voltar </a>
            </div>
            </fieldset>
        </form>
    <?php } else if($op == 5){ ?>
        <form style="z-index:1000;position:relative;" action="index.php" method="POST" id="msform">


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
                
                <?php 
                    $res = buscaCep($cep);
                    $resposta = json_decode($res);
                 ?>
             <hr>
            <h3 style="color: #fff; text-transform: uppercase; text-align: center;">Você é de <?php echo $resposta->cidade." - ".$resposta->uf; ?> </h3>
         
            <h3 style="color: #fff; margin-top: 10px;text-align: center;">Agora vamos pegar algumas informações sobre seu veiculo</h3>
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
            <button type="submit" class="action-button btn">Continuar</button>
            <div class="form-group" style="padding-top: 10px;">
                <a href="javascript:history.back()" class="btn btn-danger" style="width: 100%; text-decoration: none;"> Voltar </a>
            </div>
            </fieldset>
        </form>
    <?php } else if($op == 6){ ?>
        <form style="z-index:1000;position:relative;" action="index.php" method="POST" id="msform">


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
                
                <?php 
                    $res = buscaCep($cep);
                    $resposta = json_decode($res);
                    $cidade = $resposta->cidade;
                    $nome_cidade = $resposta->cidade;
                 ?>
             <hr>
            <h3 style="color: #fff; text-transform: uppercase; text-align: center;">Você é de <?php echo $resposta->cidade." - ".$resposta->uf; ?> </h3>
            
            
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
            <h3 style="color: #fff; margin-top: 10px;text-align: center;">Confirme as informações sobre seu veículo:</h3>
            <?php  
                $ano = explode("-",$anoModelo);
                $res = consultarVeiculo($referencia,$tipo,$marca,$anoModelo,$ano[1],$ano[0],$modelo);
                $resposta = json_decode($res);
                echo "<h3 style='color: #fff;'><span style='color:#fb0505;'>Marca: </span>".$resposta->Marca."</h3>";
                echo "<h3 style='color: #fff;'><span style='color:#fb0505;'>Modelo: </span>".$resposta->Modelo."</h3>";
                echo "<h3 style='color: #fff;'><span style='color:#fb0505;'>Codigo Fipe: </span>".$resposta->CodigoFipe."</h3>";
                echo "<h3 style='color: #fff;'><span style='color:#fb0505;'>Mês de referência: </span>".$resposta->MesReferencia."</h3>";
                 echo "<h3 style='color: #fff;'><span style='color:#fb0505;'>Valor do Veiculo: </span>".$resposta->Valor."</h3>";

                 $marca = $resposta->Marca;
                 $modelo = $resposta->Modelo;
                 $cod = $resposta->CodigoFipe;
                 $mes_referencia = $resposta->MesReferencia;
                 $valor = $resposta->Valor;

             ?>
             <input type="text" name="valor" <?php echo "value='".$resposta->Valor."'"; ?> style="display: none;"> 
             <input type="text" name="cidade" <?php echo "value='".$cidade."'"; ?> style="display: none;"> 
             <button type="submit" class="action-button btn">Continuar</button>
            <div class="form-group" style="padding-top: 10px;">
                <a href="javascript:history.back()" class="btn btn-danger" style="width: 100%; text-decoration: none;"> Voltar </a>
            </div>
            </fieldset>
        </form>
    <?php } else if($op == 7){?>
        <form style="z-index:1000;position:relative;" action="index.php" method="POST" id="msform">
            <fieldset>
                
                <h3 style="color: #fff; margin-top: 10px;text-align: center;">Esses foram os dados preenchidos, confirme o envio!</h3>

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
                echo "<h3 style='color: #fff;'><span style='color:#fb0505;'>Marca: </span>".$resposta->Marca."</h3>";
                echo "<h3 style='color: #fff;'><span style='color:#fb0505;'>Modelo: </span>".$resposta->Modelo."</h3>";
                echo "<h3 style='color: #fff;'><span style='color:#fb0505;'>Codigo Fipe: </span>".$resposta->CodigoFipe."</h3>";
                echo "<h3 style='color: #fff;'><span style='color:#fb0505;'>Mês de referência: </span>".$resposta->MesReferencia."</h3>";
                 echo "<h3 style='color: #fff;'><span style='color:#fb0505;'>Valor do Veiculo: </span>".$resposta->Valor."</h3>";

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
                      
                    $body = $body . "Marca: ".$marca."\n"; 
                     $body = $body ."Modelo: " . $modelo . "\n"; 
                     $body = $body ."Ano | Combustivel: " . $anoCombustivel . "\n"; 
                     $body = $body ."Placa: " . $placa . "\n"; 
                    $body = $body . "Código Fipe: " . $cod . "\n"; 
                    $body = $body . "Mês de Referência: " . $mes_referencia . "\n"; 
                    $body = $body . "Valor do veículo: " . $valor . "\n";
                    $body = $body . "Valor de adesão: " . $valor_adesao . "\n";
                    $body = $body . "Valor mensal: " . $valor_mensal . "\n"; 
                    $body = $body . "Código Promocional: ".$promocional."\n"; //Aqui vai a mensagem do e-mail
                   
                    $headers = 'From: Titulo da aplicacao <no-reply@dominio.com>'."\r\n" .
        'Reply-To: no-reply@dominio.com '. "\r\n" .
        'X-Mailer: MyFunction/' . phpversion().
        'MIME-Version: 1.0' . "\n".
        'Content-type: text/html; charset=UTF-8' . "\r\n";
                    // envia o email
                    mail($destinatario, 'Atendimento Site' , $body, "From: $destinatario\r\n");
                    
                    mail("carlosfreitas@granprime.org.br", 'Atendimento Site' , $body, "From: $destinatario\r\n");
                    mail("renatopereira@granprime.org.br", 'Atendimento Site' , $body, "From: $destinatario\r\n");
                    mail("carinalaureano@granprime.org.br", 'Atendimento Site' , $body, "From: $destinatario\r\n");
                    mail("marketing@granprime.org.br", 'Atendimento Site' , $body, "From: $destinatario\r\n");
                    mail("atendimento@m2track.com.br", 'Atendimento Site' , $body, "From: $destinatario\r\n");
                    



if(empty($promocional)){
    $promocional = "nenhum código cadastrado";
}
                    cadastrarCliente($conexao, $nome, $email, $telefone, $cidade, $estado, $aplicativo, $promocional, $marca, $modelo, $anoCombustivel, $placa, $cod, $mes_referencia, $valor);
                    $res = selecionarTodosCodTime($conexao);
                    $certo = "nao";
                    foreach ($res as $key) {
                        if ($key["cod"] == $promocional) {
                            $cliente = selecionarClienteEmail($conexao, $placa);
                            cadastrarCodigo($conexao, $key["id"], $cliente["id"]);
                            $certo = "sim";
                        }
                    }
                    if($certo == "nao"){
                        $cliente = selecionarClienteEmail($conexao, $placa);
                        cadastrarCodigo($conexao, 0, $cliente["id"]);
                    }
                    
                ?> 
            <a href="https://www.granprime.org.br/obrigado" class="action-button btn btn-warning" style="width: 100%; text-decoration: none;">Continuar</a>
            <div class="form-group" style="padding-top: 10px;">
                <a href="javascript:history.back()" class="btn btn-danger" style="width: 100%; text-decoration: none;"> Voltar </a>
            </div>
                
            </fieldset>

        </form>
    <?php } ?>

		<!------------- form ------------->
								
                            </div> <!-- end of img-wrapper -->
                        </div> <!-- end of image-container -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of header-content -->
    </header> <!-- end of header -->
    
    <!-- end of header -->
    <!-- Description -->
    <div class="cards-1">
        <div class="container">
            <div class="row">
                
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="images/icon1.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Sem Tempo Mínimo de CNH</h4>
                            
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="images/icon2.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Sem Consulta ao SPC/Serasa</h4>
                            
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="images/icon3.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Menos Burocracia</h4>
                            
                        </div>
                    </div>
                    <!-- end of card -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of cards-1 -->
    <!-- end of description -->
<div class="cards-1">
        <div class="container">
            <div class="row">
                
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="images/icon4.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Única com Assistência Médica</h4>
                            
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="images/icon6.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Proteção contra: Roubo Furto, Colisão Incêndio, Queda de objetos, Danos da natureza e Danos a terceiros*</h4>
                            
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="images/icon5.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Melhor Preço Do Rio de Janeiro</h4>
                            
                        </div>
                    </div>
                    <!-- end of card -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
	<h6 id="informe-se">*Informe-se com um Consultor Gran Prime</h6>
    </div> <!-- end of cards-1 -->
    <!-- end of description -->
	

    


    
                    

    

    

                    


    
            <div class="row">
                <div class="col-lg-12">

                    <!-- Card-->
                    
                    




    

    
    
    	
    <!-- Scripts -->
           <!-- /.MultiStep Form -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
    <script src="js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    
    <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <script src="js/custom.js"></script>
    <script src="js/main.js"></script>
</body>
</html>