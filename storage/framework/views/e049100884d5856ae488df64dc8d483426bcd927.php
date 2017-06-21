<?php $__env->startSection('heading'); ?>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Modifica <i></i>
            </h1>
        </div>
    </div>
    <!-- /.row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(count($errors) > 0): ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger" role="alert">
                    <?php echo Html::ul($errors->all()); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <?php echo Form::model($product, ['method' => 'PUT', 'action' => ['ProductController@update', $product->id], 'files' => true]); ?>

            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo Form::file('imgProfilo'); ?>

                </div>        
                <div class="form-group">
                    <?php echo e(Form::select('seller_id', $shops, null, ['class' => 'form-control', 'placeholder' => 'Seleziona un negozio...'])); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('titolo', 'Titolo'); ?>

                    <?php echo Form::text('titolo', null, ['class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('categoria', 'Categoria'); ?>

                    <?php echo Form::text('categoria', null, ['class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('marchio', 'Marchio'); ?>

                    <?php echo Form::text('marchio', null, ['class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('provenienza', 'Provenienza'); ?>

                    <?php echo Form::text('provenienza', null, ['class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('prezzo', 'Prezzo'); ?>

                    <?php echo Form::text('prezzo', null, ['class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('QuantUnita', 'Unita'); ?>

                    <?php echo Form::text('QuantUnita', null, ['class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('disponibilita', 'Disponibilita'); ?>

                    <?php echo Form::text('disponibilita', null, ['class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('presente', 'Attivo'); ?>

                    <?php echo Form::checkbox('presente', 'presente'); ?>

                </div>            
                <div class="form-group">
                    <?php echo Form::submit('Modifica', ['class' => 'btn btn-primary']); ?>

                </div>
            </div>
        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.backend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>