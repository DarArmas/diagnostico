$(document).ready(function(){
	$(document).tooltip();

	$('#artist_select').editableSelect();

	function listArtists(){
		console.log("hola mundo");
			$.ajax({
            url: 'fetchArtists.php',
            type: 'GET',
            success: function(data) {
                let artists = JSON.parse(data);
				let options = '';
			
				artists.forEach(artist => {
					options += `
                     <li class="es-visible">${artist.name}</li>`
					;
					});
				$('.es-list').html(options);
			},
			error: function(data) {
				toastr.error('Hubo un error en la parte del servidor', 'Error', {timeOut: 3000});
				return false;
			}
        	});
	}


	//list artists 
	$(document).on('click', '#artist_select', function(e){
		e.preventDefault();
		listArtists();
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

//delete album
	$(document).on('click', '.delete', function(){
		
	});

});