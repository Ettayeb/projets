@extends('layouts.master')

@section('content')

@foreach ($produit as $p)
{!! Form::open([
    'route' => 'produit.modifier',
	'method' => 'POST'
]) !!}

<div class="form-group">
    {!! Form::label('l1', 'Nom de produit :', ['class' => 'control-label']) !!}
    {!! Form::text('nom', $p->nom, ['class' => 'form-control']) !!}

    {!! Form::hidden('id', $p->id, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('l2', 'Code de produit :', ['class' => 'control-label']) !!}
    {!! Form::text('code', $p->code, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', $p->description, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('l4', 'Prix unitaire de produit :', ['class' => 'control-label']) !!}
    {!! Form::text('prix_unitaire', $p->prix_unitaire, ['class' => 'form-control']) !!}
</div>
@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
{!! Form::submit('Modifier la produit', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@endforeach
@stop
