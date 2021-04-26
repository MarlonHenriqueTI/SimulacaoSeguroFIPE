function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}

function submeter(id){
	var form = document.getElementById(id);
	form.submit();
}

function placaSemHifen(e){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else{
	    if(tecla>64 && tecla<90) return true;
	    else{
	        if(tecla>97 && tecla<123) return true;
	        else return false;
	    }
	}
    }
}

function appNaoPode(){
    var selecionado = document.getElementById("aplicativo");
    if(selecionado.options[selecionado.selectedIndex].value=="Sim"){
        document.getElementById("botaocontinuar").disabled = true;
        document.getElementById("divtal").style.display = 'block';
        alert('Desde o dia 01/01/2020 a Gran Prime associados não realiza mais a adesão de motoristas de aplicativo. Caso você seja motorista de APP e informar que não é, seu ressarcimento pode ser negado em casos de eventualidades como roubo, furto e etc.');
      
    } else {
        document.getElementById("botaocontinuar").disabled = false;
        document.getElementById("divtal").style.display = 'none';
        
    }
}
