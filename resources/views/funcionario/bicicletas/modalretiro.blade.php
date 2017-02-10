<div class="modal fade" id="miModalRetiro" tabindex="-1" role="dialog" aria-labelledby="miModalRetiro" aria-hidden="true">
	<div class="modal-dialog modal-sm">
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
									<p><strong>¿Seguro quiere retirar la bicicleta?</strong></p>
									<br>
									<p>Al retirar se enviara un mail al dueño</p>
									</center>
									</div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <input type="hidden" name="id_bicicleta" id="id_bicicleta" value="{{ $bike->id }}">
	                <div class="modal-footer">
	                    <button class="btn btn-warning pull-left" title="Volver" data-dismiss="modal" aria-hidden="true"><i class="fa fa-reply fa-2x" aria-hidden="true"></i>&nbsp; Volver</button>
	                    <a href="{{ route('funcionario.bicicletas.cambiar', $bike->id) }}" class="btn btn-danger" title="Retirar"><i class="fa fa-bicycle fa-2x"  aria-hidden="true" style="color:black;" title="Retirar"></i>&nbsp; Retirar</a>
	                </div>


			</div>
		</div>
	</div>
 </div>