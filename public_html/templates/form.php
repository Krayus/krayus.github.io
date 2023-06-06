<header>
	<class>
	<img src="img/CAE-UDD.jpg" width="120" height="120" align="right" style="vertical-align: top">
	<i class="fa fa-align-left" aria-hidden="true"></i>
	<img src="img/logo-universidad-del-desarrollo.png" width="150" height="150" style="vertical-align: top">
	<center><h4>Formulario de Contacto</h4></center>
	<br>
	</class>
</header>
<form action="api.php" id="form" method="post" clas>
	<label class="main-label" for="email">Email <strong class="required">*</strong></label>
	<input class="form-control form-control-lg" type="email" name="email" placeholder="Correo Alumno" required>

	<br>

	<label  class="main-label" for="rut">RUT Alumno <strong class="required" >*</strong></label>
	<input class="form-control form-control-lg" id="rut" type="text" name="rut" aria-label="Ingrese el Rut" required oninput="requiredRut()"  placeholder="Rut Alumno (1.234.567-8)" >
	<div id="error"></div>

	<br>

	<label  class="main-label" for="name">Nombre Completo <strong class="required">*</strong></label>
	<input class="form-control form-control-lg" type="text" name="name" aria-label="Ingrese el nombre completo" required  placeholder="Nombre Completo"  >
	
	<br>

	<label class="main-label" for="phone">Teléfono</label>
	<input class="form-control form-control-lg" type="text" name="phone" aria-label="Ingresa los 9 dígitos de tu número móvil"  placeholder="Telefono"  >
	
	<br>

	<label class="main-label" for="department">Sede <strong class="required">*</strong></label>
	<br>
	<div class="form-check">
        <input class="form-check-input" type="radio" name="campus" id="Santiago" value="Santiago" aria-label="Santiago" onchange="dissapear_option()">
        <label class="form-check-label" for="Santiago">
            Santiago
        </label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="campus" id="Concepcion" value="Concepcion" aria-label="Concepcion" onchange="dissapear_option()">
        <label class="form-check-label" for="Concepcion">
            Concepción
        </label>
    </div>
	
	<br>
	<label class="main-label" for="area">Área <strong class="required">*</strong></label>
	<div class="form-check">
        <input class="form-check-input" type="radio" name="area" id="Pregrado" value="Pregrado" aria-label="Pregrado"  checked>
        <label class="form-check-label" for="Pregrado">
            Pregrado
        </label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="area" id="Postgrado" value="Postgrado" aria-label="Postgrado" >
        <label class="form-check-label" for="Postgrado">
            Postgrado
        </label>
    </div>
	<br>
    <label for="Topic" class="main-label" >Tipo de Trámite <strong class="required">*</strong></label>
	<select id="selectTopic" class="form-select form-select-lg mb-3" aria-label="Default select example" name="topic" onchange="setTitle(this)">
	  <option value="Matricula" selected="selected">Matrículas y Rematriculas</option>
	  <option value="Repactaciones">Repactaciones o facilidades de pagos</option>
	  <option value="BecasCAEseguro">CAE, Becas MINEDUC y Seguro Escolaridad</option>
	  <option value="Certificados">Certificados Económicos</option>
	  <option value="Becasudd">Becas UDD</option>
	  <option value="PagoConvenio">Pago de cuotas y Convenios PAT/PAC</option>
	  <option value="Certificadosora">Certificados Académicos</option>
	  <option value="Equipoora">Otras Solicitudes Académicas</option>
	  <option value="Equipoora">Solicitud Suspensión, Anulación y Renuncias</option>
	  <option value="Admisionespecial">Solicitud Admisión Directa</option>
	  <option value="Pagoacademico">Pagos de Suspensiones, Anulaciones y Renuncias</option>
	  <option value="EconoPostyDEC">Temas Económicos Postgrado y Educación Continua</option>
	  <option value="MatriculaPostyDEC">Matrículas Postgrado y Educación Continua</option>
	  <option value="ConsultaAca">Consultas Académicas</option>
	</select>
	
	<label for="title" style="display: none !important;">Titulo del ticket</label>
	<input class="form-control form-control-lg" id="titleID" type="hidden" name="title" aria-label="Ingrese el titulo para el ticket" value="Becas UDD">
	
	<label  class="main-label" for="message">Mensaje<strong class="required">*</strong></label>
	<textarea name="message" class="form-control form-control-lg" rows="3" placeholder="Ingrese un mensaje para el ticket" id="message" required ></textarea>

<!-- Boton Agregar archivos -->
	<div class="col" align="left" style="margin: 1em;">
 		<input  type="file" id="archivos" name="archivos" multiple/>
	</div>
	<script src="script.js"></script>
	
<!-- Boton Enviar -->
	<div class="col" align="center" style="margin: 1em;">
		<input id="send" class="btn" style="font-size: 1rem; color: #fff; background-color: #0062a1;" type="submit" value="Enviar">
	</div>

	<label class="required">* Datos Requeridos</label>
</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>	
    var Fn = {
	// Valida el rut con su cadena completa "XXXXXXXX-X"
	validaRut : function (rutCompleto) {
		if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
			return false;
		var tmp 	= rutCompleto.split('-');
		var digv	= tmp[1]; 
		var rut 	= tmp[0];
		if ( digv == 'K' ) digv = 'k' ;
		return (Fn.dv(rut) == digv );
	},
	dv : function(T){
		var M=0,S=1;
		for(;T;T=Math.floor(T/10))
			S=(S+T%10*(9-M++%6))%11;
		return S?S-1:'k';
	}
}

//Required RUT
function requiredRut(){
        var error = document.getElementById("error");
        const button = document.getElementById('send');
        if( !(Fn.validaRut(rut.value)) ){
	    error.style.color = 'red';
            error.textContent = "Rut Invalido, el formato debe ser el siguiente: 11111111-1";
            button.disabled = true;
             //alert("Rut Invalido. Favor completarlo en el ejemplo: 11111111-1");
        }else{
            error.textContent = "Rut Valido.";
	    error.style.color = 'green';
            button.disabled = false;
        }
}

const rut = document.querySelector("input#rut");
rut.addEventListener('change',requiredRut);

//Setting title JS
var options = $('select option');
var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
options.each(function(i, o) {
  o.value = arr[i].v;
  $(o).text(arr[i].t);
});

function setTitle(selection){
    var title = selection.options[selection.selectedIndex].text;
    document.getElementById("titleID").value = title;
}


window.onbeforeunload = function () {
    var inputs = document.getElementsByTagName("INPUT");
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type == "button" || inputs[i].type == "submit") {
            inputs[i].disabled = true;
        }
    }
};


function dissapear_option(){
	let campus = document.querySelector('input[name="campus"]:checked').value;
	let value_to_ignore = ["ConsultaAca"];
	let value_to_ignore2 = [""];
	let selection = document.getElementById("selectTopic").options;
	let item_selected = document.getElementById("selectTopic");
	item_selected.value = "Matricula";
	if (campus == "Santiago"){
		for (let i = 0; i < selection.length; i++){
			if (value_to_ignore.includes(selection[i].value)){
				selection[i].style.display = "none";
			}else{
				selection[i].style.display = "block";
			}
		}
	}else {
		for (let i = 0; i < selection.length; i++){
			if (value_to_ignore2.includes(selection[i].value)){
				selection[i].style.display = "none";
			}
		}
	}
}
</script>
