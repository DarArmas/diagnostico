$(document).ready(function(){
	$(document).tooltip();

	$('#artist_select').editableSelect();
	var table = $('#data-table').DataTable({
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

	//submit
	$('#album-form').on('submit', function(e){
		e.preventDefault();
		const data = $(this).serialize();
		$.ajax({
				url:"create.php",
				method:"POST",
				data: data,
				error: function() {
					toastr.error('There was a problem with the server', 'Error', {timeOut: 3000});
					return false;
				},
				success:function(response)
				{
					toastr.success(response, 'Success', {timeOut: 3000});
					console.log(response);
					$('#album-form')[0].reset();
					table.DataTable().ajax.reload(); //cuando ingrese datos, que se actualice la tabla
				},
			});
		}
	);




//delete album
	$(document).on('click', '.delete-al', function(){
		
	});

    


});