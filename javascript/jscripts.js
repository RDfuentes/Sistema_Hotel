// JavaScript Document

// Fun??o para Habilitar e Desabilitar a Visualiza??o de uma Div !
function mostraesconde( divFecha, divAbre ){
	document.getElementById( "" + divFecha + "" ).style.display = "none";
	document.getElementById( "" + divAbre + "" ).style.display = "inline";
}

// Fun??o para Habilitar e Desabilitar a Visualiza??o de duas Divs !
function mostraesconde2( divFecha1, divFecha2, divAbre1, divAbre2 ){
	document.getElementById( "" + divFecha1 + "" ).style.display = "none";
	document.getElementById( "" + divFecha2 + "" ).style.display = "none";
	document.getElementById( "" + divAbre1 + "" ).style.display = "inline";
	document.getElementById( "" + divAbre2 + "" ).style.display = "inline";
}

// Fun??o para mostrar e esconder div's!
function showPanel(id, imgID, pathImgUp, pathImgDw){

	var Panel = document.getElementById(id);
	var img;

	if(Panel.style.display == 'none'){
		Panel.style.display = 'inline';
		img = pathImgUp;
	}else{
		Panel.style.display = 'none';
		img = pathImgDw;
	}

	// altera??o da imagem
	if(imgID != false){
		alterImg(img, imgID);
	}
}

// Fun??o para alterar imagens
function alterImg(img, id){
	var image = document.getElementById(id);
	image.src = img;
}

function textoValidar(string_analise) {

	string_final = ""
	string_teste = ""
	tamanho = string_analise.length;

	for (var i=0;i<tamanho;i++) {
		aux = string_analise.substring(i,i+1)
		if (aux == ' ') {
			string_final = string_final + ' ';
	 	}	
		string_teste = 	string_teste + ' ';
   	}
	if (string_teste == string_final)  return false;
	else return true;

}

function emailValidar(campo) {
	erro = true;
	p1 = campo.indexOf("@")
	p2 = campo.lastIndexOf(".")
	t = campo.length - 1;
	if((p1==t) || (p2==t) || (p2==-1) || (p1>p2) || ((p2-p1)==1))
	 erro = false;
	return erro;
}


function filtrar(campo){

	permitidos = new Array('0','1','2','3','4','5','6','7','8','9','10');
	antes  = new String(campo.value);
	depois = new String("");
	for(i = 0; i < antes.length; i++){
		caracter = antes.substring(i,i+1)
		passou   = false;

		for(i2 = 0; i2 < permitidos.length; i2++){

			if(permitidos[i2] == caracter){
				passou = true;
			}

		}

		if(passou){

			depois = depois + caracter;

		}
		
	}

	campo.value = depois;

}

function dataValidar(dataStr) {

	// verificando campos vazios
	if (dataStr == "") {
		return false;
	}

	// verificando formato
	var datePat = /^(\d{1,2})(\/|-)(\d{1,2})\2(\d{4})$/; 
	var matchArray = dataStr.match(datePat); // formato da data ok? 
	if (matchArray == null) {
		return false;
	} 
	dia = matchArray[1]; 
	mes = matchArray[3]; 
	ano = matchArray[4]; 

	// verificando dia
	if (dia < 1 || dia > 31) {
		return false;
	}

	// verificando m?s
	if (mes < 1 || mes > 12) {
		return false;
	}

	// verificando m?s: meses com 31 dias
	if ((mes==4 || mes==6 || mes==9 || mes==11) && dia==31) {
		return false;
	}

	// verificando m?s: fevereiro
	if (mes == 2) {

        // checando fevereiro para dia 29  
		var isleap = (ano % 4 == 0 && (ano % 100 != 0 || ano % 400 == 0)); 
		if (dia>29 || (dia==29 && !isleap)) {
			 return false;
		} 

	} 

	return true; // Data v?lida

}

function completar(campo, caracter, total, local){

	txt = campo.value;
	len = txt.length;

	for(i = len; i < total; i++){

		if(local == "esquerda"){
			txt = caracter + txt;
		}else{
			txt = txt + caracter;
		}

	}

	campo.value = txt;

}
//Converte String maiuscula para minuscula.
function upperCaseTOLowerCase(obj) {
   obj.value = obj.value.toLowerCase();
}