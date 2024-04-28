<div class="modal fade" id="update" tabindex="-1" aria-labelledby="update" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="update">Update</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<!-- <form id="update" action="{{ route('form/update') }}" method = "post">form add -->
				<form id="update" action="#" method = "post"><!-- form add -->
					{{ csrf_field() }}
					<div class="modal-body">
						<input type="hidden" class="form-control" id="e_id" name="id" value=""/>
						<div class="modal-body">
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Full Name</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="e_name" name="name" required="" value=""/>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Email</label>
								<div class="col-sm-9">
									<input type="email" class="form-control" id="e_email" name="email" required="" value=""/>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Phone</label>
								<div class="col-sm-9">
									<input type="tel" class="form-control" id="e_phone" name="phone" required="" value=""/>
								</div>
							</div>
						</div>
						<!-- form add end -->
					</div>
					<div class="modal-footer">
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icofont icofont-eye-alt"></i>Close</button>
							<button type="submit" id=""name="" class="btn btn-success  waves-light"><i class="icofont icofont-check-circled"></i>Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>