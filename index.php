<?php
	date_default_timezone_set('America/Monterrey');
?>

<html>
    <head>
		

        <title>Select</title>
		<link type="text/css" rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="jquery-editable-select.css" />
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	   <script src="jquery-editable-select.js"></script>
	   <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
	  
	</head>
    <body>
        <div class="container mt-4">
			<h3>Select your items</h3>
			<div class="row">
				<div class="col-md-4">
					<form method="post" id="sample_form">
						
						<div class="form-group">
						<label>Fecha:</label>
							<input type="text" class="form-control" id="fecha" name="fecha" value="<?=date("d-m-Y",time());?>" disabled >
						</div>
						<div class="form-group">
							<label>Herramientas Disponibles:</label>
							<div class="selDiv">
								<select name="herramienta" id="herramienta_select" class="form-control" >
									<option></option> <!--editable select debe al menos una opcion al momento de hacer focus-->
								</select>
							</div>
						</div>
						
						<div class="d-flex align-items-end">
							<div class="form-group">
								<input type="hidden" name="action" id="action" value="add" />
								<input type="hidden" name="hidden_id" id="hidden_id" value="" />
								<button type="submit" title="Agregar a la lista" name="Save" id="save" class="btn btn-success" value="Save">
									<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
									<circle cx="12" cy="12" r="9"></circle>
									<line x1="9" y1="12" x2="15" y2="12"></line>
									<line x1="12" y1="9" x2="12" y2="15"></line>
									</svg>
								</button>
							</div>
						</div>
					</form>
					<br />
				</div> <!--.col-md-4-->

				<div class="d-flex flex-column col-md-6">
					<div class="table-wrapper-scroll-y my-custom-scrollbar p-3">
						<div class="table-responsive" >
							<table class="table table-bordered" id="tabla-seleccionados" >
							<colgroup>
							<col span="1" style="width: 5%;">
							<col span="1" style="width: 80%;">
							<col span="1" style="width: 10%;">
							<col span="1" style="width: 5%;">
    						</colgroup>
								<thead>
									<tr>
										<th>Codigo</th>
										<th>Herramienta</th>
										<th>#</th>
										<th><a type="button" class="btn btn-danger btn-xs" style="pointer-events: none;">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="10" height="20" viewBox="5 1 14 24" stroke-width="2.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
											<line x1="4" y1="7" x2="20" y2="7" />
											<line x1="10" y1="11" x2="10" y2="17" />
											<line x1="14" y1="11" x2="14" y2="17" />
											<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
											<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
											</svg>
											</a>
										</th>
									</tr>
								</thead>
								<tbody id="body_seleccionadas">

								</tbody>
							</table>
						</div>
					</div>
					<div class="">
						<button type="button" id="btnFlush" class="btn btn-primary ml-3">Vaciar</button>
						<button type="button" id="btnPrestamo" class="btn btn-success">Hacer prestamo</button>
						<button type="button" id="btnTicket" class="btn btn-success">Abrir ticket</button>
						<!-- <iframe id="inlineFrameExample"
			title="Inline Frame Example"
			width="1500"
			height="800"
			src="http://172.16.100.32:8000/inventario?ticket=68">
		</iframe> -->
					</div>
				</div>
			</div>


			<br />
			<br />
			<br />


			<!-- Modal eliminar -->
			<div class="modal fade" id="confirmHer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Vaciar lista</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						¿Desea vaciar la lista de herramientas seleccionadas?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" id="btnConfirmHer" name="btnConfirmHer" class="btn btn-primary">Eliminar</button>
					</div>
					</div>
				</div>
			</div><!--modal eliminar-->

	<!--Modal resumen-->
			<div class="modal fade" id="confirmPrestamo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-md" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Resumen de préstamo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="table-wrapper-scroll-y my-custom-scrollbar">
							<ul id="resumen-list">
								<li>Heramienta1</li>
							</ul>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" id="btnConfirmPrestamo" name="btnConfirmPrestamo" class="btn btn-primary">Confirmar</button>
					</div>
					</div>
				</div>
			</div><!--modal resumen-->


			<!-- modal iframe
			<div class="modal fade" id="modalIframe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
					<div class="modal-content" style="width:1300px; height: 720px; margin: 0 auto;">
					<div class="modal-body">
						<div class="">
							<iframe id="iframe-p"
								title="Inline Frame Example"
								width=1200
								height=680
								src="http://192.168.100.16:8000/inventario?ticket=63">
							</iframe>
						</div>
					</div>
					</div>
				</div>
			</div> -->
			<!--modal iframe -->
			<div class="mb-4">
							<iframe id="iframe-p"
								title="Inline Frame Example"
								width=1200
								height=540
								src="http://172.16.100.20:8000/ticket?ticket=2">
							</iframe>
						</div>



		</div>

    </body>
</html>
<script>
$(document).ready(function(){
	var selected = []; //codigos,descripciones cantidades de las herramientas seleccionadas
	$('#herramienta_select').editableSelect();
	$('#herramienta_select').prop("placeholder", "Busca por descripcion o codigo/serie"); //select se convierte en input text al cargar editableSelect() 
	$(document).tooltip();

	// $("#iframe-p").on('DOMSubtreeModified', function() {
	// 	console.log("cambio en el iframe");

	// });

	// // $('#iframe-p').on( 'load', function() {
	// // 	const myIframe = document.getElementById("iframe-p");
	// // 	const iframeWindow = myIframe.contentWindow.document;
	// // 	console.log(iframeWindow);
		
	// // } );


	// $("#iframe-p").bind("load",function(){
    //     var inputres = $(this).contents().find("input");
	// 	console.log(inputres);
	// 	var inputres = $("#resinput");
	// 	console.log(inputres);
    // });


	// $(window).bind("beforeunload",function(event) {
	// 	if(false) return "asdfasdf";
	// });


	function listarHerramientas(selected){
			$.ajax({
            url: 'fetchTools.php',
            type: 'GET',
            success: function(data) {
                let herramientas = JSON.parse(data);
				let options = '';
				let codigo = ''; // <- toma el valor de codigo o numserie dependiendo de la herramienta
				herramientas.forEach(herramienta => {
					codigo = herramienta.codigo == null ? herramienta.numserie : herramienta.codigo;

					options += `
                     <li class="es-visible">${herramienta.descripcion} | #${codigo} | ${herramienta.qtyf} disponibles</li>`
					;
					});
				$('.es-list').html(options);


					//deshabilitando los <li> de las herramientas que ya fueron seleccionadas:
				if(selected.length > 0){
					//$(".es-list li:contains(2125)").prop("style", "opacity: 0.6; pointer-events: none; display: none;"); <--imposible usar variable dentro de li:contains(), por eso el for
					lista = $(".es-list li");
					for (let i=0; i<lista.length; i++){
						for(let x=0; x<selected.length; x++){
							if(lista[i].innerHTML.includes(selected[x].codigo)){
								lista[i].classList.add("disabled");
							}
						}
							// if (new RegExp(selected.join("|")).test(lista[i].innerHTML)) {
							// 	lista[i].classList.add("disabled");
							// }

					}
				}

			},
			error: function(data) {
				toastr.error('Hubo un error en la parte del servidor', 'Error', {timeOut: 3000});
				return false;
			}
        	});
	}

	//imprimir la cantidad disponible en el placeholder
	function placeholderMax(herramienta_codigo){
		$.ajax({
				url:"action.php",
				method:"POST",
				data:{codigo_serie: herramienta_codigo},
				error: function(data) {
					toastr.error('Hubo un error en la parte del servidor', 'Error', {timeOut: 3000});
					return false;
				},
				success:function(data)
				{
					const herramienta = JSON.parse(data);
					const cantidad_maxima = "Max: " + herramienta.qtyf;
					$('#cantidad_input').prop("placeholder", cantidad_maxima);
				},
		});
	}

	function añadirHerramienta(herramienta){
			var id_seleccionados = herramienta["id_seleccionados"];
			var codigo = herramienta["codigo"];
			var cantidad = herramienta["cantidad"];
			var descripcion = herramienta["descripcion"];
			var max = herramienta["max"];

			if(id_seleccionados != null && codigo != '' && cantidad != '' && descripcion != '' && max != ''){
				if(id_seleccionados.includes(codigo)){
				toastr.warning('Ya seleccionaste esta herramienta', 'Herramienta duplicada', {timeOut: 3000, positionClass: "toast-top-full-width"});
				return false;
				}else if(parseInt(cantidad) > parseInt(max)){
					toastr.error('Hay ' + max +' elementos de esta herramienta', 'Selecciona una cantidad menor', {timeOut: 3000});
					return false;
				}else{

					var row = `<tr>
								<td class="herramientaIDCell style-td">${codigo}</td>
								<td>${descripcion}</td>
								<td>${cantidad}</td>
								<td><button type="button" name="delete" class="btn btn-danger btn-xs delete">
										<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="10" height="20" viewBox="5 1 14 24" stroke-width="2.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
										<line x1="4" y1="7" x2="20" y2="7" />
										<line x1="10" y1="11" x2="10" y2="17" />
										<line x1="14" y1="11" x2="14" y2="17" />
										<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
										<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
										</svg>
									</button>
								</td>
							</tr>`;

					$('#tabla-seleccionados').append(row);

					//$('#sample_form')[0].reset(); <-- no quiero resetar los input de fecha y comentario
					$('#herramienta_select').val($('#herramienta_select').prop("defaultValue"));
					$('#cantidad_input').val($('#cantidad_input').prop("defaultValue"));


					toastr.success('Agregaste una herramienta', 'Nueva herramienta', {timeOut: 3000});
					$('#cantidad_input').prop("placeholder", "");

					selected.push({
						codigo: codigo,
						descripcion: descripcion,
						cantidad: cantidad
					})

				}
			}else{
				toastr.error('No se pudo agregar la herramienta',  'Error', {timeOut: 3000});
				return false;
			}
			

	}

	//listar herramientas disponibles cuando se da click en el select
	$(document).on('click', '#herramienta_select', function(e){
		e.preventDefault();
		$(this)[0].value = '';
		$('#cantidad_input').val($('#cantidad_input').prop("defaultValue"));
		listarHerramientas(selected);
	});
	
	//cambiar placeholder de campo cantidad dinamicamente
	$('#herramienta_select').focusout(function(e){
		e.preventDefault();
		var herramienta_input = $('#herramienta_select').val();
		if(herramienta_input !== ''){
			var herramienta_codigo = herramienta_input.split(' | ')[1].substring(1);
			placeholderMax(herramienta_codigo);
		}else{
			//si no se selecciona nada, quita el ultimo placeholder
			$('#cantidad_input').prop("placeholder", "");
		}
		
	})

	//submit - agregar herramienta a la lista
	$('#sample_form').on('submit', function(e){
		e.preventDefault();
		/*guardar ids de herramientas selccionadas para despues comprobar antes de añadir
			un nuevo row a la tabla con una herramienta repetida (esta es una comprobacion que ya no es necesaria gracias a que una vez que
			se agrega la herramienta, se deshabilita su opcion en el select)
			se deja en caso de que falle la hoja de estilos
		*/	

		var id_seleccionados = [];
		var opciones = [];

		$('#tabla-seleccionados .herramientaIDCell').each(function() {
    		id_seleccionados.push($(this).html());
	 	});


		if($('#herramienta_select').val() == '' )
		{
			$("#herramienta_select").effect("shake");
			toastr.warning('Selecciona una herramienta', 'Falta herramienta', {timeOut: 3000});
			return false;
		}
		else if($('#cantidad_input').val() == '')
		{
			$("#cantidad_input").effect("shake");
			toastr.warning('Indica la cantidad', 'Falta cantidad', {timeOut: 3000});
			return false;
		}else{

			//que el usuario no pueda modificar la herramienta seleccionada (gracias a editableSelect):
			$('.es-list li').each(function(){
				opciones.push($(this)[0].innerHTML)
			});

			if(opciones.length > 0 && opciones.includes($("#herramienta_select").val()) == false){
					alert("No modificar la opcion seleccionada por favor");
					return false;
			}


			var herramienta_input = $('#herramienta_select').val();
			var herramienta_descripcion =  herramienta_input.split(' | ')[0]; //importante los espacios
			var herramienta_codigo = herramienta_input.split(' | ')[1].substring(1);
			var cantidad = $('#cantidad_input').val();
			var cantidad_maxima = "";
			var lista = [];

    		//Obtener la cantidad por herramienta
			if(herramienta_codigo != null){
				$.ajax({
				url:"action.php",
				method:"POST",
				//enviar el codigo o serie de la herramienta
				data:{codigo_serie: herramienta_codigo},
				error: function(data) {
					toastr.error('Hubo un error en la parte del servidor', 'Error', {timeOut: 3000});
					return false;
				},
				success:function(data)
				{
					const herramienta = JSON.parse(data);
					const cantidad_maxima = herramienta.qtyf;
					const herramientajson = {
						"id_seleccionados": id_seleccionados,
						"codigo": herramienta_codigo,
						"descripcion": herramienta_descripcion,
						"cantidad": cantidad,
						"max" : cantidad_maxima,
					}
					añadirHerramienta(herramientajson);
				},
				});
			}

		}

	});

//botn hacer el prestamo
	$('#btnPrestamo').click(function(){
		let resumen = '';
		
		if(selected.length > 0){
			selected.forEach(herramienta => {
			resumen += `
                     <li><strong>${herramienta["descripcion"]}</strong> - #${herramienta["codigo"]} (${herramienta["cantidad"]})</li>
					 `;
			});

			$("#resumen-list").html(resumen);

			$('#btnConfirmPrestamo').text('Confirmar');
			$('#confirmPrestamo').modal("show");

		}else{
			toastr.error('Agrega al menos una herramienta', 'La tabla está vacia', {timeOut: 3000});
			return false;
		}
	});


	$('#btnConfirmPrestamo').click(function(){
		var comentario = $('#comentarioTxt').val();

		if(selected.length > 0){
			$('#btnConfirmPrestamo').text('Confirmando....');
			setTimeout(function(){
			$('#confirmPrestamo').modal('hide');
			},50);

			$.ajax({
				url:"hacerPedido.php",
				method:"POST",
				//enviar el codigo o serie de la herramienta
				data:{selected_list: selected, comentario: comentario},
				error: function(data) {
					toastr.error('Hubo un error en la parte del servidor', 'Error', {timeOut: 3000});
					return false;
				},
				success:function(data)
				{
					console.log(data);
					// $('#tabla-seleccionados tbody').html('');
					// selected = [];
					// $('#sample_form')[0].reset();
					// toastr.success('Prestamo reaizado correctamente', 'Exito', {timeOut: 3000});
				},
			});
		}else{
			toastr.error('Hay un error en la lista de herramientas', 'Error en la lista', {timeOut: 3000});
			return false;
		}
	});


//eliminar herramienta de la lista
	$(document).on('click', '.delete', function(){
		var delete_tr = $(this).closest('tr');
		if(delete_tr != "" && typeof delete_tr == "object"){
			var delete_td = (delete_tr.find("td").eq(0));
			var delete_id = delete_td[0].innerHTML;
			delete_tr.remove();

			//quitar el codigo de las herramientas seleccionadas (y deshabilitadas)
			let index = selected.map(function(e) { return e.codigo;}).indexOf(delete_id);
			if(index > -1){
				selected.splice(index,1);
			}
		}
	});

//vaciar lista
	$('#btnFlush').click(function(){
		$('#btnConfirmHer').text('Eliminar');
		$('#confirmHer').modal('show');
	});

//confirmar vaciar herramienta
	$('#btnConfirmHer').click(function(){
		$('#btnConfirmHer').text('Eliminando....');
		setTimeout(function(){
		$('#confirmHer').modal('hide');
		},50);

		$('#tabla-seleccionados tbody').html('');
		$('#herramienta_select').val($('#herramienta_select').prop("defaultValue"));
		$('#cantidad_input').val($('#cantidad_input').prop("defaultValue"));
		$('#cantidad_input').prop("placeholder", "");
		selected = [];
		
	});


	$('#btnTicket').click(function(){
		let url = "http://172.16.100.32:8000/inventario?ticket=68";
		let params = "width=1500,height=800,scrollbars=NO";

		$('#modalIframe').modal('show');
	});


	$('#iframe-id').on( 'load', function() {
    // code will run after iframe has finished loading
} );


});
</script>