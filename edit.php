<?php
	require_once('helper.php');
require_once('cabecera.php');
     
?>

<?php 
                $album = getAlbum($connect, $_GET['id']);
                if(!isset($album['id']) || !isset($_SESSION['user'])){
                    header("Location: index.php");   
                }
?> 
			<h3>Edit album <?=$album['name']?></h3>
			<div class="row">
				<div class="col-md-3">
					<form  id="album-form-edit" action="create.php?edit=<?=$album['id']?>" method="post">
						<div class="form-group">
							<label for="name">Name:</label>
							<input type="text" class="form-control" id="name" name="name" value="<?=$album['name']?>" required>
						</div>
						<div class="form-group">
							<label>Artist:</label>
							<div class="selDiv">
                     <select name="artist" id="artist_select_edit" class="form-control" required>
                           <?php
                              $artists = fetchArtists($connect);
                                 if(!empty($artists)):
                                    while($artist = mysqli_fetch_assoc($artists)):
                           ?>
									<option value="<?=$artist['id']?>"
                                 <?=($artist['id'] == $album['artist_id']) ? 'selected="selected"' : '' ?> >
                              <?=$artist['name']?>
                              </option> 
                           <?php
                              endwhile;
                           endif;
                           ?>
								</select>
							</div>
						</div>
						<!-- <div class="form-group">
							<input type="hidden" class="form-control" id="artist_string" name="artist_string" required>
						</div> -->
						<div class="form-group">
							<label for="year">Year:</label>
							<input type="number" class="form-control" id="year" name="year" value="<?=$album['year']?>" required>
						</div>
						<div class="form-group">
							<p>Score:</p>
								  <input type="radio" name="score" value="<i class='fa-solid fa-star text-warning'></i>" 
                                 <?php echo ($album['score'] == "<i class='fa-solid fa-star text-warning'></i>" ? "checked" : '') ?> required>
								  <label><i class='fa-solid fa-star text-warning'></i></label><br>

								  <input type="radio" name="score" value="<i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i>"
                              <?php echo ($album['score'] == "<i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i>" ? "checked" : '') ?> >
								  <label><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i></label><br>

								  <input type="radio" name="score" value="<i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i>"
                              <?php echo ($album['score'] == "<i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i>" ? "checked" : '') ?> >
								  <label><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i></label><br>

								  <input type="radio" name="score" value="<i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i>"
                              <?php echo ($album['score'] == "<i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i>" ? "checked" : '') ?>   >
								  <label><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i></label><br>
								
								  <input type="radio" name="score" value="<i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i>"
                        <?php echo ($album['score'] == "<i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i>" ? "checked" : '') ?> >
								  <label><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i><i class='fa-solid fa-star text-warning'></i></label><br>
							</div>
						<!-- <div class="form-group row">
							<div>
							<label for="image">Image: </label>
								<input type="file" name="image" id="image" data-initial-preview="" accept="image/*"/>
							</div>
						</div> -->
						<div class="row float-left">
							<div class="form-group col-sm-12 mr-3">
								<button type="submit" title="Add a new album" name="Save" id="save" class="btn btn-success" value="Save">
									Edit Album
								</button>
							</div>
						</div>
                  <div class="row float-left">
							<div class="form-group col-sm-8">
								<a href="index.php" class="btn btn-secondary">
									Cancel
								</a>
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
										endwhile;
									endif;
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!--END TABLE ALBUMS-->
				<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-body">
								
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
    </body>
</html>
<script src="index.js"></script>
