<div class="modal fade" id="miModalEliminar" tabindex="-1" role="dialog" aria-labelledby="miModalEliminar" aria-hidden="true">
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
									<p><strong>¿Seguro quiere eliminar la bicicleta?</strong></p>
									<p></p>
									<br>
									<p>Toda la información de la bicicleta se borrará</p>
									<p style="color: #ED1723;"><strong> No se podrá recuperar nada</strong></p>
									</center>
									</div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                    <button class="btn btn-warning pull-left" title="Volver" data-dismiss="modal" aria-hidden="true"><i class="fa fa-reply fa-2x" aria-hidden="true"></i>&nbsp; Volver</button>
	                    <a href="{{ route('admin.bicicletas.destroy', $bike->id) }}" class="btn btn-danger" title="Eliminar"><i class="fa fa-trash fa-2x"  aria-hidden="true" style="color:black;" title="Eliminar"></i>&nbsp; Eliminar</a>
	                </div>
			</div>
		</div>
	</div>
 </div>