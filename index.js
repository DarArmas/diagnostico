$(document).ready(function(){
	$(document).tooltip();

	$('#artist_select').editableSelect();
	table = $('#data-table').DataTable({
		columnDefs: [
            {
                orderable: false,
                targets: 'no-sort',
            }
        ],
	});
		
	$('#image').fileinput({
        allowedFileExtensions: ['jpg', 'jpeg', 'png'],
        maxFileSize: 1000,
        showUpload: false,
        showClose: false,
        dropZoneEnabled: false,
        showCaption: false,
        showCancel: false,
        initialPreviewAsData: true,
        theme: "fas",
    });

	function listArtists(){
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

	$('#artist_select').on('change', function () {
        $('#artist_string').val($('#artist_select').val());
    });

	$('#artist_select').on('focusout', function () {
        $('#artist_string').val($('#artist_select').val());
    });

	//submit - agregar herramienta a la lista
	$('#album-form').on('submit', function(e){
		e.preventDefault();
		const data = $(this).serialize();
		
		// const data = {
        //     artist_selected: $('#artist_select').val()
        // };
		$.ajax({
				url:"create.php",
				method:"POST",
				data: data,
				//enviar el codigo o serie de 
				error: function() {
					toastr.error('Hubo un error en la parte del servidor', 'Error', {timeOut: 3000});
					return false;
				},
				success:function(response)
				{
					console.log(response);
					table.destroy();
					table = $('#data-table').DataTable();
				},
			});
		}
	);




//delete album
	$(document).on('click', '.delete-al', function(){
		
	});

    


});