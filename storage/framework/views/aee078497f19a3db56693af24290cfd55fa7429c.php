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
                            <th>Immagine</th>
                            <th>Titolo</th>
                            <th>Categoria</th>
                            <th>Marchio</th>
                            <th>Provenienza</th>
                            <th>Disponibilita</th>
                            <th>Prezzo</th>
                            <th>Negozio</th>
                            <th>Attivo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($products) > 0): ?>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($product['id']); ?></td>
                                    <td>
                                        <?php if(isset($product['imgProfilo'])): ?>
                                            <img src="data:image/png;base64,<?php echo e(base64_encode($product['imgProfilo'])); ?>" style="width: 50px; height: auto;">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($product['titolo']); ?></td>
                                    <td><?php echo e($product['categoria']); ?></td>
                                    <td><?php echo e($product['marchio']); ?></td>
                                    <td><?php echo e($product['provenienza']); ?></td>
                                    <td><?php echo e($product['disponibilita']); ?></td>
                                    <td>€ <?php echo e($product['prezzo']); ?></td>
                                    <td><?php echo e($product['nomeNegozio']); ?></td>
                                    <td><?php echo e(($product['presente'] === 1)?'Si':'No'); ?></td>
                                    <td><a class="btn btn-small btn-info" href="<?php echo e(action('ProductController@edit', $product['id'])); ?>">Modifica</a></td>
                                    <td>
                                        <?php echo e(Form::open(['action' => ['ProductController@delete', $product['id']]])); ?>

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