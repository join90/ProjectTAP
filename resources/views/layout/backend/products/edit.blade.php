@extends('layout.backend.master')

@section('heading')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Modifica <i></i>
            </h1>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('content')
    @if(count($errors) > 0)
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger" role="alert">
                    {!! Html::ul($errors->all()) !!}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        {!! Form::model($product, ['method' => 'PUT', 'action' => ['ProductController@update', $product->id], 'files' => true]) !!}
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::file('imgProfilo') !!}
                </div>        
                <div class="form-group">
                    {{ Form::select('seller_id', $shops, null, ['class' => 'form-control', 'placeholder' => 'Seleziona un negozio...']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('titolo', 'Titolo') !!}
                    {!! Form::text('titolo', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('categoria', 'Categoria') !!}
                    {!! Form::text('categoria', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('marchio', 'Marchio') !!}
                    {!! Form::text('marchio', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('provenienza', 'Provenienza') !!}
                    {!! Form::text('provenienza', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('prezzo', 'Prezzo') !!}
                    {!! Form::text('prezzo', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('QuantUnita', 'Unita') !!}
                    {!! Form::text('QuantUnita', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('disponibilita', 'Disponibilita') !!}
                    {!! Form::text('disponibilita', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('presente', 'Attivo') !!}
                    {!! Form::checkbox('presente', 'presente') !!}
                </div>            
                <div class="form-group">
                    {!! Form::submit('Modifica', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection