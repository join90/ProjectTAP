<!DOCTYPE html>
<html lang="en">

@include('layout.backend.partials.head')

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            
            @include('layout.backend.partials.topnav')

            @include('layout.backend.partials.sidenav')

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                @include('layout.backend.partials.alerts')

                @yield('heading')

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    @include('layout.backend.partials.footer')

</body>

</html>
