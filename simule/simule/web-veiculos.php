<?php 

function consultarVeiculo($codreferencia,$tipoveiculo,$codmarca,$ano,$tipocombustivel,$anomodelo,$codmodelo){
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://veiculos.fipe.org.br/api/veiculos/ConsultarValorComTodosParametros",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{\n\t\"codigoTabelaReferencia\": ".$codreferencia.",\n\t\"codigoTipoVeiculo\": ".$tipoveiculo.",\n\t\"codigoMarca\": ".$codmarca.",\n\t\"ano\": \"".$ano."\",\n\t\"codigoTipoCombustivel\": ".$tipocombustivel.",\n\t\"anoModelo\": ".$anomodelo.",\n\t\"codigoModelo\": ".$codmodelo.",\n\t\"tipoConsulta\": \"tradicional\"\n}",
	  CURLOPT_HTTPHEADER => array(
	    "Content-Type: application/json",
	    "Host: veiculos.fipe.org.br",
	    "Postman-Token: c66eee87-5921-451c-9ba1-42a9a2059e32",
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
	  return $response;
	}

}


function consultarMes(){
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://veiculos.fipe.org.br/api/veiculos/ConsultarTabelaDeReferencia",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_HTTPHEADER => array(
	    "Content-Type: application/json",
	    "Host: veiculos.fipe.org.br",
	    "Postman-Token: 467d9f84-e8e8-4d2c-8c6c-5f1b20dbf664",
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
	  return $response;
	}
}


function consultarMarcas($codreferencia, $tipoveiculo){

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://veiculos.fipe.org.br/api/veiculos/ConsultarMarcas",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{\n\t\"codigoTabelaReferencia\":".$codreferencia." ,\n\t\"codigoTipoVeiculo\": ".$tipoveiculo."\n}",
	  CURLOPT_HTTPHEADER => array(
	    "Content-Type: application/json",
	    "Host: veiculos.fipe.org.br",
	    "Postman-Token: 7d42a411-cd3d-4104-8d89-1ea307987770",
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
	  return $response;
	}
}

function consultarModelos($codreferencia, $tipoveiculo, $codmarca){
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://veiculos.fipe.org.br/api/veiculos/ConsultarModelos",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{\n\t\"codigoTabelaReferencia\": ".$codreferencia.",\n\t\"codigoTipoVeiculo\": ".$tipoveiculo.",\n\t\"codigoMarca\": ".$codmarca."\n}",
	  CURLOPT_HTTPHEADER => array(
	    "Content-Type: application/json",
	    "Host: veiculos.fipe.org.br",
	    "Postman-Token: c25ff519-3856-427f-875c-ec9645b5814c",
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
	  return $response;
	}
}

function consultarAnoModelo($codreferencia, $tipoveiculo, $codmarca, $codmodelo){
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://veiculos.fipe.org.br/api/veiculos/ConsultarAnoModelo",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{\n\t\"codigoTabelaReferencia\": ".$codreferencia.",\n\t\"codigoTipoVeiculo\": ".$tipoveiculo.",\n\t\"codigoMarca\": ".$codmarca.",\n\t\"codigoModelo\": ".$codmodelo."\n}",
	  CURLOPT_HTTPHEADER => array(
	    "Content-Type: application/json",
	    "Host: veiculos.fipe.org.br",
	    "Postman-Token: e93b2a2f-2f69-4dca-95f9-0c0cc9cb3a31",
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
	  return $response;
	}
}

function consultarModeloAtravesAno($codreferencia, $tipoveiculo, $codmarca, $ano, $tipocombustivel, $anomodelo){
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://veiculos.fipe.org.br/api/veiculos/ConsultarModelosAtravesDoAno",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{\n\t\"codigoTabelaReferencia\": ".$codreferencia.",\n\t\"codigoTipoVeiculo\": ".$tipoveiculo.",\n\t\"codigoMarca\": ".$codmarca.",\n\t\"ano\": \"".$ano."\",\n\t\"codigoTipoCombustivel\": ".$tipocombustivel.",\n\t\"anoModelo\": ".$anomodelo."\n}",
	  CURLOPT_HTTPHEADER => array(
	    "Content-Type: application/json",
	    "Host: veiculos.fipe.org.br",
	    "Postman-Token: 093ccb98-3f76-4060-86fc-6985b8b6b977",
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
	  return $response;
	}
}

function buscaCep($cep){
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://cep.republicavirtual.com.br/web_cep.php?cep=".$cep."&formato=json",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_POSTFIELDS => "",
	  CURLOPT_HTTPHEADER => array(
	    "Postman-Token: af9a293a-d74e-4897-99b5-dba62af8ce2d",
	    "cache-control: no-cache"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  return $response;
	}
}
