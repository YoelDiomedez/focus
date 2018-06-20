<!-- BEGIN LOGIN -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light about-text">
                <h3>
                    <i class="fa fa-info"></i> Bienvenido
                </h3>
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="list-unstyled margin-top-10 margin-bottom-10 text-center">
                            <li>
                                <i class="fa fa-user"></i> <?= $this->session->userdata('userName'); ?> 
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> <?= $this->session->userdata('userEmail'); ?> 
                            </li>
                        </ul>
                    </div>
                </div>
                <h3>
                    <i class="fa fa-sitemap"></i> Oficinas a cargo
                </h3>
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Oficina</th>
                                    <th>Acceder</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php if ($this->session->userdata('userLocation')): ?>
                            <?php foreach ($this->session->userdata('userLocation') as $ul): ?>
                                <tr>
                                    <td><?= $ul->name; ?></td>
                                    <td>
                                        <button 
                                            type="button" 
                                            class="btn dark btn-outline"
                                            onclick="access('<?= $ul->locationID; ?>');">
                                            <i class="fa fa-check-circle-o"></i>
                                        </button>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" class="text-center">Solicite asignación</td>
                            </tr>
                        <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <a 
                type="button" 
                class="btn btn-primary uppercase btn-block" 
                href="<?= site_url('signin/logout'); ?>">
                <i class="icon-logout"></i> Salir
            </a>
        </div>
    </div>
</div>
<!-- END LOGIN -->