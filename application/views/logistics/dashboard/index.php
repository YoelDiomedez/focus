<?php 
    $date = $year."-".$month;

    $months = array(
            '1'  => 'Jun',
            '2'  => 'Feb',
            '3'  => 'Mar',
            '4'  => 'Apr',
            '5'  => 'May',
            '6'  => 'Jun',
            '7'  => 'Jul',
            '8'  => 'Aug',
            '9'  => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec'
    );

    $years = array();

    for ($i=1995; $i<=2095; $i++) {
        $years[$i] = $i;
    } 
 ?>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">Estadísticas <small class="uppercase">Almacén General</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/dashboard');">Inicio</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Estadísticas</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-fit-height grey-salt" data-toggle="modal" href="#small"> 
                Opciones <i class="fa fa-gear"></i>
            </button>
        </div>
    </div>
</div>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <?php if ($this->session->userdata('0')->inputs == 1): ?>
        <a class="dashboard-stat dashboard-stat-v2 green-meadow" 
            href="javascript:;" 
            onclick="route('logistics/input');">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span>S/ </span><span class="counter"><?= $input[0]->totalinputs; ?></span>
                </div>
                <div class="desc">Compras realizadas</div>
            </div>
        </a>
    <?php else: ?>
        <a class="dashboard-stat dashboard-stat-v2 green-meadow" href="javascript:;">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span>S/ </span><span class="counter"><?= $input[0]->totalinputs; ?></span>
                </div>
                <div class="desc">Compras realizadas</div>
            </div>
        </a>
    <?php endif; ?>    
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <?php if ($this->session->userdata('0')->outputs == 1): ?>
        <a class="dashboard-stat dashboard-stat-v2 blue" 
            href="javascript:;"
            onclick="route('logistics/output');">
            <div class="visual">
                <i class="fa fa-truck"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span>S/ </span><span class="counter"><?= $output[0]->totaloutputs; ?></span>
                </div>
                <div class="desc"> Distribuciones hechas</div>
            </div>
        </a>
    <?php else: ?>
        <a class="dashboard-stat dashboard-stat-v2 blue" href="javascript:;">
            <div class="visual">
                <i class="fa fa-truck"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span>S/ </span><span class="counter"><?= $output[0]->totaloutputs; ?></span>
                </div>
                <div class="desc"> Distribuciones hechas</div>
            </div>
        </a>
    <?php endif; ?> 
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <?php if ($this->session->userdata('0')->orders == 1): ?>
        <a class="dashboard-stat dashboard-stat-v2 yellow-crusta" 
            href="javascript:;"
            onclick="route('logistics/order');">
            <div class="visual">
                <i class="fa fa-inbox"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span>+ </span>
                    <span class="counter"><?= $order[0]->totalorders; ?></span>
                </div>
                <div class="desc"> Pedidos pendientes</div>
            </div>
        </a>
    <?php else: ?>
        <a class="dashboard-stat dashboard-stat-v2 yellow-crusta" href="javascript:;">
            <div class="visual">
                <i class="fa fa-inbox"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span>+ </span>
                    <span class="counter"><?= $order[0]->totalorders; ?></span>
                </div>
                <div class="desc"> Pedidos pendientes</div>
            </div>
        </a>
    <?php endif; ?> 
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <?php if ($this->session->userdata('0')->products == 1): ?>
        <a class="dashboard-stat dashboard-stat-v2 purple" 
            href="javascript:;"
            onclick="route('logistics/product');">
            <div class="visual">
                <i class="fa fa-archive"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span>+ </span>
                    <span class="counter"><?= $product[0]->totalproducts; ?></span>
                </div>
                <div class="desc"> Artículos registrados</div>
            </div>
        </a>
    <?php else: ?>
        <a class="dashboard-stat dashboard-stat-v2 purple" href="javascript:;">
            <div class="visual">
                <i class="fa fa-archive"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span>+ </span>
                    <span class="counter"><?= $product[0]->totalproducts; ?></span>
                </div>
                <div class="desc"> Artículos registrados</div>
            </div>
        </a>
    <?php endif; ?> 
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase">Compras</span>
                    <span class="caption-helper">
                        <?= date('M, Y', strtotime($date)); ?>
                    </span>
                </div>
            </div>
            <div class="portlet-body">
            <div id="myfirstchart" style="height: 250px;"></div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-share font-red-sunglo hide"></i>
                    <span class="caption-subject font-dark bold uppercase">Distribuciones</span>
                    <span class="caption-helper">
                        <?= date('M, Y', strtotime($date)); ?>

                    </span>
                </div>
            </div>
            <div class="portlet-body">
                <div id="area-example" style="height: 250px;"></div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-share font-red-sunglo hide"></i>
                    <span class="caption-subject font-dark bold uppercase">Artículos</span>
                    <span class="caption-helper">
                        Más Pedidos
                    </span>
                </div>
            </div>
            <div class="portlet-body">
               <div id="donut-example"></div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-share font-red-sunglo hide"></i>
                    <span class="caption-subject font-dark bold uppercase">Artículos</span>
                    <span class="caption-helper">
                        Por Oficina
                    </span>
                </div>
            </div>
            <div class="portlet-body">
               <div id="bar-example"></div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
</div>
    
<div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title text-center">Filtrar</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" role="form" id="lookfor">
                    <div class="form-group">
                        <label>Mes</label>
                        <?= form_dropdown('month', $months, $month,'class="form-control"');?>
                    </div>
                    <div class="form-group">
                        <label>Año</label>
                        <?= form_dropdown('year', $years, $year,'class="form-control"');?>
                    </div>
                    <button type="submit" class="btn dark btn-outline">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
$(document).ready(function(){

    $("#lookfor").submit(function(e){
        format('#lookfor');
        e.preventDefault();
        var formData = new FormData($("#lookfor")[0]);
        $.ajax({
            url: "<?php echo site_url("logistics/dashboard/show"); ?>",  
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                $('#small').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#main').html(data);
            }
        });
    });

    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
});

var jsonData = <?php echo $id; ?>;
var jsonData2 = <?php echo $od; ?>;

var jsonData3 = <?php echo $orderdet; ?>;
var jsonData4 = <?php echo $location; ?>;

new Morris.Line({
  element: 'myfirstchart',
  data: jsonData,
  xkey: 'date',
  ykeys: ['quantity'],
  labels: ['Productos'],
  lineColors: ['green']
});

Morris.Area({
  element: 'area-example',
  data: jsonData2,
  xkey: 'date',
  ykeys: ['quantity'],
  labels: ['Productos']
});

Morris.Donut({
  element: 'donut-example',
  data: jsonData3,
  colors: [
  '#ffca00',
  '#ffd126',
  '#ffd84f',
  '#ffde68',
  '#ffe589'
  ]
});

Morris.Bar({
  element: 'bar-example',
  data: jsonData4,
  xkey: 's',
  ykeys: ['tp'],
  labels: ['Productos'],
  barColors: ['#8E44AD']
});

</script>