@extends('layouts.master')

@section('content')

{!! Form::open([
    'route' => 'add'
	'method' => 'GET'
]) !!}

<div class="form-group">
    {!! Form::label('l1', 'Nom de produit :', ['class' => 'control-label']) !!}
    {!! Form::text('nom', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('l2', 'Code de produit :', ['class' => 'control-label']) !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('l3', 'Quantité :', ['class' => 'control-label']) !!}
    {!! Form::text('quantite', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('l4', 'Prix unitaire de produit :', ['class' => 'control-label']) !!}
    {!! Form::text('prix_unitaire', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Ajouter une produit', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop
