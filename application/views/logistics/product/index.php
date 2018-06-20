<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Artículos <small><?= $this->session->userdata('0')->name; ?></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/product');">Artículos</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Lista </span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
				<div class="table-toolbar">
                     <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <button 
                                	id="new-product" 
                                	class="btn green btn-outline"
                                	onclick="route('logistics/product/create');"
                                > 
                                     <i class="fa fa-plus"></i> Nuevo 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
				<table class="table table-bordered table-hover" id="productDataTable">
					<thead>
						<tr>
							<th>#</th>
							<th>Categoría</th>
							<th>Descripción</th>
							<th>Marca</th>
							<th>U. Pedido</th>
							<th>U. Dist.</th>
							<th>Estado</th>
							<th>Stock</th>
							<th>Detalle</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
					<?php if (!empty($product)): ?>
					<?php foreach ($product as $p):?>
						<tr>
							<td><?= $p->productID; ?></td>
							<td><?= $p->area; ?></td>
							<td><?= $p->detail; ?></td>
							<td><?= $p->brand; ?></td>
						<?php 
							$t = explode(',', $p->type);
							$m = explode(',', $p->unit);

							if (count($t) == 1) {
								echo "<td>".$m[0]."</td>";
								echo "<td>".$m[0]."</td>";
							}else{
								echo "<td>".$m[0]."</td>";
								echo "<td>".$m[1]."</td>";
							}
						?>
							<td>
							<?php if($p->status == 'BUENO'): ?>
								<span class="badge badge-primary uppercase">
									<?= $p->status; ?>
								</span>
							<?php elseif($p->status == 'REGULAR'): ?>
								<span class="badge badge-warning uppercase">
									<?= $p->status; ?>
								</span>
							<?php else: ?>
								<span class="badge badge-danger uppercase">
									<?= $p->status; ?>
								</span>
							<?php endif; ?>
							</td>
							<td><?= $p->stock; ?></td>
							<td>
								<button 
									onclick="show('<?= $p->productID; ?>');" 
									class="btn dark btn-outline">
									<i class="fa fa-eye"></i>
								</button>
							</td>
							<td>
								<button 
									onclick="edit('<?= $p->productID; ?>');"
									class="btn yellow btn-outline">
									<i class="fa fa-edit"></i>
								</button>
							</td>
							<td>
								<button
									onclick="destroy('<?= $p->productID; ?>');" 
									class="btn red btn-outline">
									<i class="fa fa-trash"></i>
								</button>
							</td>
						</tr>
					<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
				</table>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('resources/js/logistics/product.js'); ?>"></script>
<script>
function show(id) {

    $.post("<?= site_url(); ?>"+'logistics/product/show/'+id, function(data){

        if (data == '') {
            swal({
                title: '¡Error!',
                type: 'error',
                html: 'What the hell r u trying to do?'
            }).catch(swal.noop)

            redirect('logistics/product');
        } else {
            loading('open');
            $('#main').html(data);
            loading('close');
        }
    });
}

function edit(id) {

    $.post("<?= site_url(); ?>"+'logistics/product/edit/'+id, function(data){

        if (data == '') {
            swal({
                title: '¡Error!',
                type: 'error',
                html: 'What the hell r u trying to do?'
            }).catch(swal.noop)

            redirect('logistics/product');
        } else {
            loading('open');
            $('#main').html(data);
            loading('close');
        }
    });
}

function destroy(id){
	swal({
	  	title: '¿Eliminar el Artículo #'+id+'?',
	  	text: "Recuerde que no podrá revertir los cambios",
	  	type: 'question',
	  	showCancelButton: true,
	  	showLoaderOnConfirm: true,
	  	allowOutsideClick: false,
	  	confirmButtonText: 'Eliminar',
	  	cancelButtonText: 'Cancelar'

	}).then(function () {

		$.post("<?= site_url(); ?>"+'logistics/product/destroy/'+id, function(data){

			redirect('logistics/product');

			if (data == 1) {
                swal({
                      title: '¡Atención!',
                      type: 'warning',
                      html: 'Se ha eliminado '+data+ ' registro',
                      timer: 5000
                }).catch(swal.noop)
            }
            else{
                swal({
                    title: '¡Error!',
                    type: 'error',
                    html: 'Se ha eliminado '+data+ ' registros'
                }).catch(swal.noop)
            }             
        });
	}, function (dismiss) {
		if (dismiss === 'cancel') {
	    	swal({
	     		title: 'Cancelado',
	      		text: 'No se realizó ningún cambio',
	        	type:'info',
	        	timer: 3000
        	}).catch(swal.noop)
	  	}
	})
}
</script>