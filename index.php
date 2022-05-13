<?php
require_once('cabecera.php')  
?>
			<h3>Add your favorite albums!</h3>
			<div class="row">
				<div class="col-md-3">
					<form method="post" id="album-form" enctype="multipart/form-data">
						<div class="form-group">
							<label for="name">Name:</label>
							<input type="text" class="form-control" id="name" name="name" required  <?php echo (!isset($_SESSION['user']) ? "disabled" : '') ?> >
						</div>
						<div class="form-group">
							<label>Artist:</label>
							<div class="selDiv">
								<select name="artist" id="artist_select" class="form-control" required <?php echo (!isset($_SESSION['user']) ? "disabled" : '') ?>>
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
							<input type="number" class="form-control" id="year" name="year" required <?php echo (!isset($_SESSION['user']) ? "disabled" : '') ?>>
						</div>
						<div class="form-group">
							<p>Score:</p>
								  <input type="radio" name="score" value="<i class='fa-solid fa-star text-warning'></i>" required 
								<?php echo (!isset($_SESSION['user']) ? "disabled" : '') ?>>
								  <label><i class='fa-solid fa-star text-warning'></i></label><br>

								  <input type="radio" name="score" value="<i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i>" 
								<?php echo (!isset($_SESSION['user']) ? "disabled" : '') ?>>
								  <label><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i></label><br>

								  <input type="radio" name="score" value="<i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i>" 
								<?php echo (!isset($_SESSION['user']) ? "disabled" : '') ?>>
								  <label><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i></label><br>

								  <input type="radio" name="score" value="<i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i>" 
								<?php echo (!isset($_SESSION['user']) ? "disabled" : '') ?>>
								  <label><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i></label><br>
								
								  <input type="radio" name="score" value="<i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i>" 
								<?php echo (!isset($_SESSION['user']) ? "disabled" : '') ?>>
								  <label><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i></label><br>
							</div>
						<div class="form-group row">
							<div>
							<label for="image">Image: </label>
								<input type="file" name="image" id="image" data-initial-preview="" />
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4"></div>
							<div class="form-group col-sm-8">
							<?php if(isset($_SESSION['user'])): ?>
								<button type="submit" title="Add a new album" name="Save" id="save" class="btn btn-success" value="Save">
									Add Album
								</button>
							<?php else: ?>
								<a id="open-login" class="btn btn-success" title="You have to log in first">
									Add Album
								</a>
								<?php if(isset($_SESSION['error'])): ?> 
									<div class="text-danger  p-3">
										<?= $_SESSION['error']; ?>
									</div>
								<?php endif; ?>
							<?php endif; ?>
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
							<?php if(isset($_SESSION['user'])): ?>
								<col span="1" style="width: 5%;">
							<?php endif;?>
    						</colgroup>
								<thead>
									<tr>
										<th class="no-sort"></th>
										<th>Name</th>
										<th>Artist</th>
										<th>Year</th>
										<th>Score</th>
										<?php if(isset($_SESSION['user'])): ?>
										<th class="no-sort"></th>
										<?php endif;?>
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
										<?php if(isset($_SESSION['user'])): ?>
										<td>
										<a href="edit.php?id=<?=$album['id']?>" class="edit-album"><i class="fas fa-edit"></i></a>
											<!-- <a href="edit.php" class="edit-album" id="<?=$album['id']?>">
												<i class="fas fa-edit"></i>
											</a> -->
											<a href="delete.php" class="delete-album" id="<?=$album['id']?>">
												<i class="text-danger fas fa-trash"></i>
											</a>
										</td>
									</tr>
								<?php
										endif;
										endwhile;
									endif;
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!--END TABLE ALBUMS-->
				<?php require_once 'modal-login.php'?>
			</div>
		</div>
    </body>
</html>
<script src="index.js"></script>
