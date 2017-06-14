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
                            <th>Avatar</th>
                            <th>Nome</th>
                            <th>Descrizione</th>
                            <th>P.Iva</th>
                            <th>Giorni apertura</th>
                            <th>Orari apertura</th>
                            <th>Attivo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($shops) > 0)
                            @foreach ($shops as $shop)
                                <tr>
                                    <td>{{ $shop->id }}</td>
                                    <td>
                                        @if(isset($shop->imgProfilo))
                                            <img src="{{ asset('storage/'.$shop->imgProfilo) }}" style="width: 50px; height: auto;">
                                        @endif
                                    </td>
                                    <td>{{ $shop->nomeNegozio }}</td>
                                    <td>{{ $shop->descrizione }}</td>
                                    <td>{{ $shop->piva }}</td>
                                    <td>{{ $shop->GiorniApertura }}</td>
                                    <td>{{ $shop->OrariApertura }}</td>
                                    <td>{{ ($shop->presente === 1)?'Si':'No' }}</td>
                                    <td><a class="btn btn-small btn-info" href="{{ action('SellerController@edit', $shop->id) }}">Modifica</a></td>
                                    <td>
                                        {{ Form::open(['action' => ['SellerController@delete', $shop->id]]) }}
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