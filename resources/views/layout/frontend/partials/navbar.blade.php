@extends('layout/frontend/layout')

@section('pagestyle')

  <style>
    .mappa { 
      position: relative;     
      height: 500px;
      left: 25%;      
    }
  </style>

  @yield('subpagestyle')
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
<link href="http://getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css" 
        rel="stylesheet">

<!-- Custom styles for this template 
    <link href="http://getbootstrap.com/examples/justified-nav/justified-nav.css" 
        rel="stylesheet"> -->
@stop

@section('navbar')

 <!-- <div class="masthead">
        <h3 class="text-muted text-center">Fast and fruits</h3>
        <nav>
          <ul class="nav nav-justified">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Projects</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Downloads</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </nav>
      </div>  -->
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
 <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>-->
      <a class="navbar-brand" href="./home" style="color:red;">F & F</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
 <!--  <li class="active">--><li><a href="/products/index">Prodotti <span class="sr-only">(current)</span></a></li>
 <li><a href="/shops/makers"> Mappa Rivenditori <span class="sr-only">(current)</span></a></li>
        <li><a href="#"></a></li>
  <!--  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>-->
      </ul>
<!--  <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> -->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/users/cart">Carrello</a></li>
      </ul>
    </div>
  </div>
</nav>
  

<div class="container">
      @yield('content')
</div>  

<div class="mappa">
 @yield('content2')
</div>

@stop