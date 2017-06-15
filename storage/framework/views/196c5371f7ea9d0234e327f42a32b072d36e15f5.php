<?php if(Session::has('message')): ?>
    <div class="alert alert-info alert-dismissable">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <?php echo e(Session::get('message')); ?>

	</div>
<?php endif; ?>