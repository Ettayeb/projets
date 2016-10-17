@extends('layouts.master')

@section('content')

{!! Form::open([

    	'route' => 'statics.index',
	'method' => 'POST',
	'class'  => 'formu'

]) !!}

{!! Form::select('month', ['nothing'=>'choisir un mois' , '01' => 'janvier' , '02' => 'février' ,'03' => 'mars' ,'04' => 'avril' , '05' => 'mai'  , '06' => 'juin' , '07' => 'juillet' , '08' => 'août' , '09' => 'septembre' , '10' => 'octobre' , '11' => 'novembre' , '12' => 'décembre'  ] , 'nothing' ) !!}

Année :
<input type="number" size="4" name="year" min="2000" max="{!! date('Y') !!}" value='{!! date("Y") !!}' >

Option :
{!! Form::select('type', ['nothing'=>'choisir une option' , 'retraits' => 'Retraits' , 'ajouts' => 'Ajouts' , 'retraitsetajouts' => 'Ajouts et Retraits'] , 'nothing' ) !!}

{!! Form::submit('Afficher le statistiques', ['class' => 'btn btn-primary']) !!}
{!! Form::button('Annuler', ['class' => 'btn btn-warning' , 'id' => 'annuler' ]) !!}
{!! Form::close() !!}

<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->
@if (isset($produit_data))
@if (count($produit_data))

<table class="table table-condensed">
<tr>
<td> Type  </td>
<td> Description  </td>
<td> Date  </td>
<td> Nom produit  </td>
<td> Code produit  </td>
<td> Quantité  </td>
</tr>

@for ($i=0; $i<count($produit_data);$i++)
<tr>
<td> {{ $operations[$i]->type }} </td>
<td> {{ $operations[$i]->description }} </td>
<td> {{ $operations[$i]->created_at }} </td>
<td> {{ $produit_data[$i][0] }} </td>
<td> {{ $produit_data[$i][1] }} </td>
<td> {{ $operations[$i]->qauntite }} </td>
</tr>
@endfor
<table>
@else

      <p class="alert alert-warning">Pas de statistiques pour ce type d'informations . <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>


@endif
@endif

<script>
$('#annuler').on("click", function () { $('table').css('display','none');  });
</script>


@stop
