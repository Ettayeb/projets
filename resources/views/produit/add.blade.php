@extends('layouts.master')

@section('content')

<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->
{!! Form::open([
    'route' => 'produit.add',
	'method' => 'POST'
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
@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
{!! Form::submit('Ajouter une produit', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop
