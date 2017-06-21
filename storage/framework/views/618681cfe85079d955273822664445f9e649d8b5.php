<!DOCTYPE html>
<html lang="en">

<?php echo $__env->make('layout.backend.partials.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            
            <?php echo $__env->make('layout.backend.partials.topnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo $__env->make('layout.backend.partials.sidenav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <?php echo $__env->make('layout.backend.partials.alerts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->yieldContent('heading'); ?>

                <?php echo $__env->yieldContent('content'); ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php echo $__env->make('layout.backend.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>

</html>
