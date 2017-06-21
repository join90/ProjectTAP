<?php $__env->startSection('heading'); ?>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Gestione dei negozi
            </h1>
        </div>
    </div>
    <!-- /.row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Nome</th>
                            <th>Descrizione</th>
                            <th>P.Iva</th>
                            <th>Giorni apertura</th>
                            <th>Orari apertura</th>
                            <th>Attivo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($shops) > 0): ?>
                            <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($shop['id']); ?></td>
                                    <td>
                                        <?php if(isset($shop['imgProfilo'])): ?>
                                            <img src="data:image/png;base64,<?php echo e(base64_encode($shop['imgProfilo'])); ?>" style="width: 50px; height: auto;">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($shop['nomeNegozio']); ?></td>
                                    <td><?php echo e($shop['descrizione']); ?></td>
                                    <td><?php echo e($shop['piva']); ?></td>
                                    <td><?php echo e($shop['GiorniApertura']); ?></td>
                                    <td><?php echo e($shop['OrariApertura']); ?></td>
                                    <td><?php echo e(($shop['presente'] === 1)?'Si':'No'); ?></td>
                                    <td><a class="btn btn-small btn-info" href="<?php echo e(action('SellerController@edit', $shop['id'])); ?>">Modifica</a></td>
                                    <td>
                                        <?php echo e(Form::open(['action' => ['SellerController@delete', $shop['id']]])); ?>

                                            <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                            <?php echo e(Form::submit('Cancella', array('class' => 'btn btn-small btn-danger'))); ?>

                                        <?php echo e(Form::close()); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr><td>Nessun record presente.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.backend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>