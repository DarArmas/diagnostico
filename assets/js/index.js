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

	$(document).on('click', '#open-login', function(e){
		e.preventDefault();
		$('#modal-login').modal('show');
	});

	//submit
	$('#album-form').on('submit', function(e){
		e.preventDefault();
		const data = $(this).serialize();
		$.ajax({
				url:"create.php",
				method:"POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
		  		processData:false,
				error: function() {
					toastr.error('There was a problem with the server', 'Error', {timeOut: 3000});
					return false;
				},
				success:function(response)
				{
					//console.log(response);
					toastr.success('New album added to your list', 'Success', {timeOut: 3000});
					$('#album-form')[0].reset();
					table.destroy();
					$('#data-table tbody').html(response);
					table = $('#data-table').DataTable();
				},
			});
		}
	);

//delete album
	$(document).on('click', '.delete-album', function(e){
		e.preventDefault();
		const id = $(this).attr('id');
		const action = $(this).attr('href');
		swal.fire({
            title: '?? Seguro desea eliminar este registro ?',
            text: 'Confirmar acci??n',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar',
        }).then(function (result) {
            if (result.value) {
				
				$.ajax({
				   url: action,
				   method:"POST",
				   data: {id:id},
				   error: function() {
					   toastr.error('There was a problem with the server', 'Error', {timeOut: 3000});
					   return false;
				   },
				   success:function(response)
				   {
					   toastr.success('Album deleted', 'Success', {timeOut: 3000});
					   table.destroy();
					   $('#data-table tbody').html(response);
					   table = $('#data-table').DataTable();
				   },
			   });
            }
        });
	});
});