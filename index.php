<?php
	date_default_timezone_set('America/Monterrey');
	require_once('database_connection.php');
	require_once('helper.php');    
?>

<html>
    <head>
		

        <title>Select</title>
		<link type="text/css" rel="stylesheet" href="style.css" />
		<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="jquery-editable-select.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.8/css/fileinput.min.css" integrity="sha512-KG618Bwf0QKHMihhxtrgFrFBZ1GyUMxEVI8tMZTjk+K4kZLJuNY6yVH5WUsxIPNBk6NKLGlGs/agT2MnSkAcTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	   <script src="jquery-editable-select.js"></script>
	   <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	 <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>  
	   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.8/js/fileinput.min.js" integrity="sha512-cp6gW0UKPFR63zDk2rrGFtTyFo+VXo3VYWPOVh53Zb9gXYH8weGogFhKgkb5zski616au/uX6uMryLcaHis9MA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	  
	</head>
    <body>
        <div class="container mt-4">
			<h3>Add your favorite albums!</h3>
			<div class="row">
				<div class="col-md-3">
					<form method="post" id="album-form">
						<div class="form-group">
							<label for="name">Name:</label>
							<input type="text" class="form-control" id="name" name="name" required>
						</div>
						<div class="form-group">
							<label>Artist:</label>
							<div class="selDiv">
								<select name="artist" id="artist_select" class="form-control" required>
									<option></option> <!--editable select debe al menos una opcion al momento de hacer focus-->
								</select>
								<small>You can type if it doesn't exist.</small>
							</div>
						</div>
						<!-- <div class="form-group">
							<input type="hidden" class="form-control" id="artist_string" name="artist_string" required>
						</div> -->
						<div class="form-group">
							<label for="year">Year:</label>
							<input type="number" class="form-control" id="year" name="year" required>
						</div>
						<div class="form-group">
							<p>Score:</p>
								  <input type="radio" name="score" value="<i class='fa-solid fa-star'></i>" required>
								  <label><i class='fa-solid fa-star'></i></label><br>

								  <input type="radio" name="score" value="<i class='fa-solid fa-star'></i><i class='fa-solid fa-star'></i>">
								  <label><i class='fa-solid fa-star'></i><i class='fa-solid fa-star'></i></label><br>

								  <input type="radio" name="score" value="<i class='fa-solid fa-star'></i><i class='fa-solid fa-star'></i><i class='fa-solid fa-star'></i>">
								  <label><i class='fa-solid fa-star'></i><i class='fa-solid fa-star'></i><i class='fa-solid fa-star'></i></label><br>

								  <input type="radio" name="score" value="<i class='fa-solid fa-star'></i><i class='fa-solid fa-star'></i><i class='fa-solid fa-star'></i><i class='fa-solid fa-star'></i>">
								  <label><i class='fa-solid fa-star'></i><i class='fa-solid fa-star'></i><i class='fa-solid fa-star'></i><i class='fa-solid fa-star'></i></label><br>
								
								  <input type="radio" name="score" value="<i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i>">
								  <label><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i></label><br>
							</div>
						<div class="form-group row">
							<div>
							<label for="image">Image: </label>
								<input type="file" name="image" id="image" data-initial-preview="" accept="image/*"/>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4"></div>
							<div class="form-group col-sm-8">
								<button type="submit" title="Add a new album" name="Save" id="save" class="btn btn-success" value="Save">
									Add Album
								</button>
							</div>
						</div>
					</form>
					<br />
				</div> <!--.col-md-4-->

				<!--TABLE ALBUMS-->
				<div class="d-flex flex-column col-md-9">
					<div class="table-wrapper-scroll-y my-custom-scrollbar p-3">
						<div class="table-responsive" >
							<table class="table table-striped table-bordered" id="data-table" >
							<colgroup>
							<col span="1" style="width: 15%;">
							<col span="1" style="width: 15%;">
							<col span="1" style="width: 5%;">
							<col span="1" style="width: 2%;">
							<col span="1" style="width: 10%;">
							<col span="1" style="width: 5%;">
    						</colgroup>
								<thead>
									<tr>
										<th class="no-sort"></th>
										<th>Name</th>
										<th>Artist</th>
										<th>Year</th>
										<th>Score</th>
										<th class="no-sort"></th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$albums = fetchAlbums($connect);
										if(!empty($albums)):
											while($album = mysqli_fetch_assoc($albums)):
									?>
									<tr>
										<td></td>
										<td><?= $album['name']?></td>
										<td><?= $album['artist']?></td>
										<td><?= $album['year']?></td>
										<td><?= $album['score']?></td>
										<td>
											<a href="edit.php" class="edit-album">
												<i class="fas fa-edit"></i>
											</a>
											<a href="delete.php" class="delete-album" id="<?=$album['id']?>">
												<i class="text-danger fas fa-trash"></i>
											</a>
										</td>
									</tr>
								<?php
										endwhile;
									endif;
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!--END TABLE ALBUMS-->

			</div>
		</div>
    </body>
</html>
<script src="index.js"></script>
