<!-- INICIO MODAL NOTA -->
<div class="modal fade" id="miModalNota" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" title="Cerrar" class="close" data-dismiss="modal" aria-hidden="true"><strong>x</strong></button>
				<h4 class="modal-title" style="color: #080266;">Nota de Bicicleta</h4>
	                <div class="row">
	                <hr>
	                    <div class="modal-body">
	                        <div class="form-group">
	                            <div class="col-md-12">
	                                <div class="form-group">
									{!! Form::text('nota', $bike->nota ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
									</div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                    <button class="btn btn-warning" title="Volver" data-dismiss="modal" aria-hidden="true"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp; Volver</button>
	                </div>

			</div>
		</div>
	</div>
 </div>
 <!-- FIN MODAL NOTA -->