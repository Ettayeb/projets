@extends('layouts.master')

@section('content')

<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->

@foreach ($projet as $p)

{!! Form::open([
    'route' => 'projets.modifier',
	'method' => 'POST'
]) !!}


@if (count($clients))
<div class="form-group">
    {!! Form::label('clients', 'Client :', ['class' => 'control-label']) !!} </br>
<select name="clients">
<option value=""> sélectionner un client</option>
@foreach($clients as $client)

@if ($p->id_client == $client->id)

<option selected=selected value='{{ $client->id }}'> {{ $client->name }} </option>
@else
<option value='{{ $client->id }}'> {{ $client->name }} </option>
@endif

@endforeach
</select>
</div>
@else 
<h4> pas de clients !</h4>
@endif


<div class="form-group">
    {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
    {!! Form::text('description', $p->description , ['class' => 'form-control']) !!}
    {!! Form::hidden('id', $p->id , ['class' => 'form-control']) !!}
</div>

<!-- produits -->

@if(isset($pp))
<div class="form-group">
<table class="table table-condensed">
<tr>
<td> Nom de produit utilisé </td>
<td> Quantité </td>
</tr>
@for ($i=0; $i<count($pp);$i++) 
<tr>
<td> {{ $produits_noms[$i] }} </td>
<td> {{ $pp[$i]->quantite }} </td>
</tr>
@endfor
</table>
<div class="form-group">
@endif

@if (count($produits))
<div class="form-group1">

<select name="produits[]">
<option value="" selected=selected> sélectionner une produit</option>
@foreach($produits as $produit)

<option value='{{ $produit->id }}'> {{ $produit->nom }} </option>

@endforeach
</select>
</br></br>
    {!! Form::label('l6', 'Quantité :', ['class' => 'control-label']) !!}
    <input type='number' name='retraitsquantite[]' class='form-control'>
    {!! Form::hidden('type','retraits', ['class' => 'form-control']) !!}
</div>
</br>
    {!! Form::button('Ajouter une autre produit', ['class' => 'btn btn-success ret']) !!}

</br></br>
@else 
<h4> pas de produits !</h4>
@endif

<div class="form-group">
        <div class="col-xs-5 date">
    {!! Form::label('date_debut', 'Date de debut :', ['class' => 'control-label']) !!}
            <div class="input-group input-append date" id="datePicker">
                <input type="text" value='{{$p->date_debut}}' class="form-control" name="date_debut" readonly />
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>

        <div class="col-xs-5 date">
    {!! Form::label('date_fin', 'Date de fin :', ['class' => 'control-label']) !!}
            <div class="input-group input-append date" id="datePicker">
                <input type="text" value='{{$p->date_fin}}' class="form-control" name="date_fin" readonly />
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
</div>

@endforeach

</br></br></br>
@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
</br></br></br>
{!! Form::submit('Modifier ce projet', ['class' => 'btn btn-success']) !!}
{!! Form::close() !!}
<a href ='{!! route('projets.index') !!}'  class='btn btn-primary'>Annuler</a>



<script>

$('.ret').on('click' , function() { 


$('.form-group1').append(" <select name='produits[]'><option value='' selected=selected> sélectionner une produit</option> @foreach($produits as $produit) <option value='{{ $produit->id }}'> {{ $produit->nom }} </option> @endforeach </select> <label for='retraitsquantite[]' class='control-label'>Quantité :</label> <input class='form-control' name='retraitsquantite[]' type='text' > ");


});





</script>
<script>
$(document).ready(function() {
    $('.date')
        .datepicker({
            format: 'dd-mm-yyyy'

    });
});
</script>









@stop
