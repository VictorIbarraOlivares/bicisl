<div class="modal fade" id="miModalImagen" tabindex="-1" role="dialog" aria-labelledby="miModalImagen" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" title="Cerrar" class="close" data-dismiss="modal" aria-hidden="true"><strong>x</strong></button>
				<center>
				<h4 class="modal-title center-block" style="color: #ED1723;"><strong >Imagen Bicicleta</strong></h4>
				</center>
	                <div class="row">
	                <hr>
	                    <div class="modal-body">
	                        <div class="form-group">
	                            <div class="col-md-12">
	                                <div class="form-group">
	                                <center>
									<a href="{{ asset($image->name)}}" id="pop">
    								<img src="{{ asset($image->name)}}" style="width: 400px; height: 264px;">
									</a>
									</center>
									</div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                    <button class="btn btn-warning pull-left" title="Volver" data-dismiss="modal" aria-hidden="true"><i class="fa fa-reply fa-2x" aria-hidden="true"></i>&nbsp; Volver</button>
	                </div>
			</div>
		</div>
	</div>
 </div>