<?php $__env->startSection('pagestyle'); ?>

<style>
    .centered-form .panel{
      background: rgba(255, 255, 255, 0.8);
      box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
      color: #4e5d6c;
    }

    .centered-form{
      margin-top: 60px;
    }
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content_base'); ?>

<div class="row centered-form">
  <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Accesso utente</h3>
      </div>
      <div class="panel-body">
        <?php echo e(Form::open(['action' => 'Auth\LoginController@login', 'method' => 'post'])); ?>

          <div class="row">
      <!--  <div class="col-xs-6 col-sm-6 col-md-6"> -->
              <div class="form-group">
                <?php echo e($usr = Form::text('user', null, array('class'=>'form-control input-sm','placeholder'=>'Username'))); ?>

              </div>
      <!--  </div> -->
          
          </div>

          

          <div class="row">
      <!--  <div class="col-xs-6 col-sm-6 col-md-6">   -->
              <div class="form-group">
                <?php echo e($pwd = Form::password('password', array('class'=>'form-control input-sm','placeholder'=>'Password'))); ?>

              </div>
      <!--  </div>   -->
            
          </div>

          <?php echo e(Form::submit('Login', array('class'=>'btn btn-info btn-block'))); ?>


        <?php echo e(Form::close()); ?>

      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout/frontend/layout_login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>