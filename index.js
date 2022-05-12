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


	//submit - agregar herramienta a la lista
	$('#album-form').on('submit', function(e){
		e.preventDefault();
		const data = $(this).serialize();
		const artist_selected = $('#artist_select').val();
		
		// const data = {
        //     artist_selected: $('#artist_select').val()
        // };
		$.ajax({
				url:"create.php",
				method:"POST",
				data: {data, artist_selected: artist_selected},
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