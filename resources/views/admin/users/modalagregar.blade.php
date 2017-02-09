<div class="modal fade" id="miModalAgregar" tabindex="-1" role="dialog" aria-labelledby="miModalAgregar" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" title="Cerrar" class="close" data-dismiss="modal" aria-hidden="true"><strong>x</strong></button>
				<center>
				<h4 class="modal-title center-block"><strong >Nueva Bicicleta</strong></h4>
				</center>
	                <div class="row">
	                <hr>
	                    <div class="modal-body">
	                        <div class="form-group">
	                            <div class="col-md-12">
	                                <div class="form-group">
	                                <center>
									<p><strong>¿Seguro quiere agregar una bicicleta a este usuario?</strong></p>
									<p style="color: #080266;"><strong>{{ $user->name }}</strong></p>
									<br>
									<p style="color: #ED1723;"><strong>La Bicicleta quedará como activa en la Universidad</strong></p>
									</center>
									</div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                    <button class="btn btn-warning pull-left" title="Volver" data-dismiss="modal" aria-hidden="true"><i class="fa fa-reply fa-2x" aria-hidden="true"></i>&nbsp; Volver</button>
	                    <a href="{{ route('admin.bicicletas.create', $user->id) }}" class="btn btn-danger" title="Agregar"><i class="fa fa-bicycle fa-2x"  aria-hidden="true" style="color:black;" title="Agregar"></i>&nbsp; Agregar</a>
	                </div>


			</div>
		</div>
	</div>
 </div>