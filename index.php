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
			<h3>Add your items</h3>
			<div class="row">
				<div class="col-md-4">
					<form method="post" id="sample_form">
						<div class="form-group">
						<label>Date:</label>
							<input type="text" class="form-control" id="fecha" name="fecha" value="<?=date("d-m-Y",time());?>" disabled >
						</div>
						<div class="form-group">
							<label for="name">Name:</label>
							<input type="text" class="form-control" id="name" name="name">
						</div>
						<div class="form-group">
							<label for="description">Description:</label>
							<textarea class="form-control" id="description" name="description"></textarea>
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
							<col span="1" style="width: 10%;">
							<col span="1" style="width: 80%;">
							<col span="1" style="width: 10%;">
    						</colgroup>
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
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
						<button type="button" id="btnFlush" class="btn btn-primary ml-3">Flush selection</button>
						<button type="button" id="btnPrestamo" class="btn btn-success">Add items</button>
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

		</div>

    </body>
</html>
<script src="index.js"></script>