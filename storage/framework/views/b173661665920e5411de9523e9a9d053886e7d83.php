<?php $__env->startSection('content'); ?>


<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<h5> <?php echo e($product->id); ?>,  <?php echo e($product->nomefile); ?></h5>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/frontend/partials/navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>