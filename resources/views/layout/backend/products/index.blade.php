@extends('layout.backend.master')

@section('heading')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Gestione dei negozi
            </h1>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('content')
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
                        @if (count($products) > 0)
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product['id'] }}</td>
                                    <td>
                                        @if(isset($product['imgProfilo']))
                                            <img src="{{ asset('storage/'.$product['imgProfilo']) }}" style="width: 50px; height: auto;">
                                        @endif
                                    </td>
                                    <td>{{ $product['titolo'] }}</td>
                                    <td>{{ $product['categoria'] }}</td>
                                    <td>{{ $product['marchio'] }}</td>
                                    <td>{{ $product['provenienza'] }}</td>
                                    <td>{{ $product['disponibilita'] }}</td>
                                    <td>€ {{ $product['prezzo'] }}</td>
                                    <td>{{ $product['nomeNegozio'] }}</td>
                                    <td>{{ ($product['presente'] === 1)?'Si':'No' }}</td>
                                    <td><a class="btn btn-small btn-info" href="{{ action('ProductController@edit', $product['id']) }}">Modifica</a></td>
                                    <td>
                                        {{ Form::open(['action' => ['ProductController@delete', $product['id']]]) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::submit('Cancella', array('class' => 'btn btn-small btn-danger')) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td>Nessun record presente.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection