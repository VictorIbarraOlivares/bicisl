<!-- INICIO MODAL NOTA -->
<div class="modal fade" id="miModalDetalle" tabindex="-1" role="dialog" aria-labelledby="miModalDetalle" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" title="Cerrar" class="close" data-dismiss="modal" aria-hidden="true"><strong>x</strong></button>
				</div>
				
	                    <div class="modal-body">
	                    <h4 style="color: #080266;">Detalle del Dueño</h4>
	                    	<div class="table-responsive">
	                    		<table class="table table-bordered table-hover">
	                    			<tbody>
	                    				<tr>
	                    					<td style="width: 30%">Nombre : </td>
	                    					<td style="width: 70%">{{ $dueño->name }}</td>
	                    				</tr>
	                    				<tr>
	                    					<td>Rut :</td>
	                    					<td>{{ formato_rut($dueño->rut) }}</td>
	                    				</tr>
	                    				@if($dueño->type_id != 1)
	                    				<tr>
	                    					<td>Correo :</td>
	                    					<td>{{ $dueño->email }}</td>
	                    				</tr>
	                    				<tr>
	                    					<td>Carrera :</td>
	                    					<td>{{ $carrera->name }}</td>
	                    				</tr>
	                    				<tr>
	                    					<td>Código Carrera :</td>
	                    					<td>{{ $carrera->codigo_carrera }}</td>
	                    				</tr>
	                    				@endif
	                    			</tbody>
	                    		</table>
	                    	</div>
	                    	<h4 style="text-align: left;color: #080266">Detalle de Bicicleta</h4>
	                    	<div class="table-responsive">
	                    		<table class="table table-bordered table-hover">
	                    			<tbody>
	                    				<tr>
	                    					<td style="width: 30%">Descripcion : </td>
	                    					<td style="width: 70%">{{ $bike->descripcion }}</td>
	                    				</tr>
	                    				<tr>
	                    					<td>Fecha Llegada :</td>
	                    					<td>{{ formato_y_m_d($bike->fecha_a) }}</td>
	                    				</tr>
	                    				<tr>
	                    					<td>Hora Llegada :</td>
	                    					<td>{{ $bike->hora_a }}</td>
	                    				</tr>
	                    				<tr>
	                    					<td>Encargado Llegada :</td>
	                    					<td>{{ $encargadoLLegada->name }}</td>
	                    				</tr>
	                    				<tr>
	                    					<td>Fecha Salida :</td>
	                    					<td>
		                    				@if($bike->fecha_s != $hoy)
												xx-xx-xxxx
											@else
												{{ formato_y_m_d($bike->fecha_s) }}
											@endif
											</td>
	                    				</tr>
	                    				<tr>
	                    					<td>Hora Salida :</td>
	                    					<td>
		                    				@if($bike->fecha_s != $hoy)
												--:--:--
											@else
												{{ $bike->hora_s }}
											@endif
											</td>
	                    				</tr>
	                    				<tr>
	                    					<td>Encargado Salida :</td>
	                    					<td>
	                    					@if($bike->fecha_s != $hoy)
												No registra retiro hoy
											@else
												@if($encargadoSalida != "")
											  	{{ $encargadoSalida->name }}
												@else
													No registra salida
												@endif
											@endif
											</td>
	                    				</tr>
	                    			</tbody>
	                    		</table>
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