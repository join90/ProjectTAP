@extends('layout/frontend/partials/navbar')

@section('content')


@foreach($products as $product)
	<h5> {{ $product->id }},  {{ $product->nomefile }}</h5>
@endforeach



@stop