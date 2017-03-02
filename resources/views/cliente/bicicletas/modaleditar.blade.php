<div class="modal fade" id="miModalEditar" tabindex="-1" role="dialog" aria-labelledby="miModalEditar" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" title="Cerrar" class="close" data-dismiss="modal" aria-hidden="true"><strong>x</strong></button>
				<center>
				<h4 class="modal-title center-block" style="color: #ED1723;"><strong > ¡ ATENCIÓN !</strong></h4>
				</center>
	                <div class="row">
	                <hr>
	                    <div class="modal-body">
	                        <div class="form-group">
	                            <div class="col-md-12">
	                                <div class="form-group">
	                                <center>
									<p><strong>¿Seguro quiere editar la información de la bicicleta?</strong></p>
									<p></p>
									<br>
									<p>Esto puede afectar al registro de Bicicletas en la Universidad</p>
									<p style="color: #ED1723;"><strong>El cambio de estado de la bicicleta quedará registrado</strong></p>
									</center>
									</div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                    <button class="btn btn-warning pull-left" title="Volver" data-dismiss="modal" aria-hidden="true"><i class="fa fa-reply fa-2x" aria-hidden="true"></i>&nbsp; Volver</button>
	                    <a href="{{ route('cliente.bicicletas.edit', $bike->id) }}" class="btn btn-danger" title="Editar"><i class="fa fa-pencil fa-2x"  aria-hidden="true" style="color:black;" title="Editar"></i>&nbsp; Editar</a>
	                </div>
			</div>
		</div>
	</div>
 </div>