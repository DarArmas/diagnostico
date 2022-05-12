$(document).ready(function(){
	$(document).tooltip();

	$('#artist_select').editableSelect();
	$('#data-table').DataTable({
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
	$('#sample_form').on('submit', function(e){
		

	});


//delete album
	$(document).on('click', '.delete', function(){
		
	});

});