<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">You have to login first!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
							<div class="modal-body">
                            
                            <form method="post" action="login.php">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                        <small>hint: admin@admin.com</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        <small>hint: admin</small>
                                    </div>
                                  
                              
                                        <div class="form-group modal-footer">
                                            <button type="submit" class="btn btn-success">
                                                Login
                                            </button>
                                        </div>
                              
                                </form>
							</div>
    
						</div>
					</div>
				</div>
