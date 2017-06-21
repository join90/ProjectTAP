<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo">Negozi <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li>
                    <a href="{{ url('/admin/shops') }}">Mostra</a>
                </li>
                <li>
                    <a href="{{ url('/admin/shops/new') }}">Nuovo</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo2">Prodotti <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo2" class="collapse">
                <li>
                    <a href="{{ url('/admin/products') }}">Mostra</a>
                </li>
                <li>
                    <a href="{{ url('/admin/products/new') }}">Nuovo</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!-- /.navbar-collapse -->